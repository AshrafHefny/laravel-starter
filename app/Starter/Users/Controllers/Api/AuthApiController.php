<?php

namespace App\Starter\Users\Controllers\Api;

use App\Starter\BaseApp\Controllers\BaseApiController;
use App\Starter\BaseApp\Controllers\Enums\ResourceTypes;
use App\Starter\BaseApp\Requests\BaseApiTokenRequest;
use App\Starter\Users\Requests\Api\LoginRequest;
use App\Starter\Users\Transformers\UserAuthTransformer;
use App\Starter\Users\User;
use App\Starter\Users\UserEnums;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Swis\JsonApi\Client\Interfaces\ParserInterface;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends BaseApiController
{
    public $parserInterface;

    public function __construct(ParserInterface $parserInterface)
    {
        $this->parserInterface = $parserInterface;
    }

    public function login(LoginRequest $request)
    {
        try {
            //parse data from jsonapi request body
            $data = $request->getContent();
            $data = $this->parserInterface->deserialize($data);
            $data = $data->getData();
            $errorArray = [];
            $row = User::where('mobile_number', $data->mobile_number)->first();

            if (!$row) {
                $errorArray[] = [
                    'status' => 422,
                    'title' => trans('api.login_failed'),
                    'detail' => trans("api.data did not match any records"),
                ];
                throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
            }
            if (!$row->confirmed) {
                $errorArray[] = [
                    'status' => 422,
                    'title' => trans('api.login_failed'),
                    'detail' => trans("api.This account is not confirmed"),
                ];
            }
            if (!$row->is_active) {
                $errorArray[] = [
                    'status' => 422,
                    'title' => trans('api.login_failed'),
                    'detail' => trans("api.This account is banned"),
                ];
            }
            if (!Hash::check(trim($data->password), $row->password)) {
                $errorArray[] = [
                    'status' => 422,
                    'title' => trans('api.login_failed'),
                    'detail' => trans("api.Password Invalid"),
                ];
            }
            if ($errorArray) {
                throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
            } else {
                if ($token = auth()->attempt([
                    'mobile_number' => $data->mobile_number,
                    'password' => $data->password
                ])) {
                    if ($data->location_id && $row->citizen) {
                        $row->citizen->update(['location_id' => $data->location_id]);
                    }

                    $include = '';
                    $meta = [
                        'token' => JWTAuth::fromUser($row),
                        'language' => (string) ($row->language ?? config('app.locale')),
                    ];
                    //send data to transformer
                    return $this->transformDataModInclude($row, '', new UserAuthTransformer(), ResourceTypes::USER, $meta);
                } else {
                    $errorArray[] = [
                        'status' => 422,
                        'title' => trans('api.login_failed'),
                        'detail' => trans("api.something went wrong, please try again"),
                    ];
                    throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
                }
            }
        } catch (JWTException $e) {
            return response()->json(
                [
                    'status' => $e->getCode(),
                    'title' => $e->getMessage(),
                    'detail' => $e->getTrace()
                ],
                500
            );
        }
    }

    public function logout(BaseApiTokenRequest $request)
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
            return response()->json(
                [
                    "meta" => [
                        'message' => trans('api.Successfully Logged Out')
                    ]
                ]
            );
        } catch (JWTException $e) {
            return response()->json(
                [
                    'status' => $e->getCode(),
                    'title' => $e->getMessage(),
                    'detail' => $e->getTrace()
                ],
                500
            );
        }
    }
}
