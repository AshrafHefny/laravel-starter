<?php

namespace App\Starter\Users\Controllers\Api;

use App\Starter\BaseApp\Controllers\BaseApiController;
use App\Starter\BaseApp\Controllers\Enums\ResourceTypes;
use App\Starter\Users\Requests\Api\RegisterRequest;
use App\Starter\Users\Transformers\UserAuthTransformer;
use App\Starter\Users\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Laravel\Socialite\Facades\Socialite;
use Swis\JsonApi\Client\Interfaces\ParserInterface;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterApiController extends BaseApiController
{
    public $parserInterface;

    public function __construct(ParserInterface $parserInterface)
    {
        $this->parserInterface = $parserInterface;
    }

    public function register(RegisterRequest $request)
    {
        try {
            //parse data from jsonapi request body
            $data = $request->getContent();
            $data = $this->parserInterface->deserialize($data);
            $data = $data->getData();

            User::create($data->toArray());
            return $this->successResponse([

                'meta' => [
                    'message' => trans('app.Thanks confirmation sms has been sent to your mobile')
                ]
            ]);
        } catch (Exception $e) {
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

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $providerUser = Socialite::driver('facebook')
                ->fields(['name', 'first_name', 'last_name', 'email', 'gender', 'verified', 'link'])
                ->stateless()
                ->user();

            // check if user exists
            $user = User::where('email', $providerUser->getEmail())->first();

            // register the user if it doesnt exists
            if (is_null($user)) {
                User::create([
                    'name' => $providerUser->user['first_name'] . ' ' . $providerUser->user['last_name'],
                    'email' => $providerUser->getEmail(),
                    'confirmed' => true,
                    'is_active' => true,
                ]);
            }

            $errorArray = [];

            if (!$user->confirmed) {
                $errorArray[] = [
                    'status' => 422,
                    'title' => trans('api.login_failed'),
                    'detail' => trans("api.This account is not confirmed"),
                ];
            }

            if (!$user->is_active) {
                $errorArray[] = [
                    'status' => 422,
                    'title' => trans('api.login_failed'),
                    'detail' => trans("api.This account is banned"),
                ];
            }

            if ($errorArray) {
                throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
            } else {
                $meta = [
                    'message' => trans('app.Thanks please start adding your mobile number'),
                    'token' => JWTAuth::fromUser($user)
                ];

                //send data to transformer
                return $this->transformDataModInclude($user, '', new UserAuthTransformer(), ResourceTypes::USER,
                    $meta);
                throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
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
}
