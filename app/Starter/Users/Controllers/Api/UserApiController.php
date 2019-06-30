<?php

namespace App\Starter\Users\Controllers\Api;

use Exception;
use App\Starter\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Swis\JsonApi\Client\Interfaces\ParserInterface;
use App\Starter\BaseApp\Controllers\BaseApiController;
use App\Starter\Users\Requests\Api\ChangePasswordRequest;
use App\Starter\Users\Requests\Api\UpdateLanguageRequest;

class UserApiController extends BaseApiController
{
    public $parserInterface;
    protected $user;

    public function __construct(ParserInterface $parserInterface)
    {
        $this->parserInterface = $parserInterface;
        $this->middleware('auth:api');
        $this->user = Auth::guard('api')->user();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            //parse data from jsonapi request body
            $data = $request->getContent();
            $data = $this->parserInterface->deserialize($data);
            $data = $data->getData();

            if (Hash::check($data->old_password, $this->user->password)) {
                //Change the password
                $this->user->update(['password' => $data->password]);

                return $this->successResponse([
                    'meta'  => [
                        'message' => trans('api.Password changed successfully.')
                    ]
                ]);
            }

            return $this->errorResponse(trans('api.Old password doesnt match authenticated user password.'));
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

    public function updateLanguage(UpdateLanguageRequest $request)
    {
        try {
            //parse data from jsonapi request body
            $data = $request->getContent();
            $data = $this->parserInterface->deserialize($data);
            $data = $data->getData();

            $this->user->update([
                    'language' => $data->language,
                ]);

            return $this->successResponse([
                    'meta'  => [
                        'message' => trans('api.Language updated successfully.'),
                        'language'  => $this->user->language ?? config('app.locale')
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
}
