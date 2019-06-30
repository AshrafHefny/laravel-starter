<?php

namespace App\Starter\BaseApp\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class BaseApiTokenDataRequest extends BaseApiRequest
{

    protected function prepareForValidation()
    {
        $token = JWTAuth::getToken();
        $user = null;
        if (!$token) {
            throw new HttpResponseException(response()->json([
                'status' => 403,
                'title' => 'Unauthorized action',
                'detail' => 'Unauthorized action. Please Use Authorized Token'
            ], 403));
        }
    }

    protected function validationData()
    {
        $data = $this->json()->all();
        if (!isset($data['data']['attributes'])) {
            throw new HttpResponseException(response()->json([
                'status' => 422,
                'title' => 'attributes not found',
                'detail' => 'attributes not found'
            ], 422));

        }
        return $data['data']['attributes'];
    }
}