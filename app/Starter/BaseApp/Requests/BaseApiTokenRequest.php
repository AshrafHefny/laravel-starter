<?php

namespace App\Starter\BaseApp\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Tymon\JWTAuth\Facades\JWTAuth;

class BaseApiTokenRequest extends BaseApiRequest
{
    protected function prepareForValidation()
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            throw new HttpResponseException(response()->json([
                'status' => 403,
                'title' => 'Token Expired',
                'detail' => 'Unauthorized action. Please Use Token Valid'
            ], 403));

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            throw new HttpResponseException(response()->json([
                'status' => 403,
                'title' => 'Token Invalid',
                'detail' => 'Unauthorized action. Please Use Valid Token'
            ], 403));

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            throw new HttpResponseException(response()->json([
                'status' => 403,
                'title' => 'Unauthorized action',
                'detail' => 'Unauthorized action. Please Use Authorized Token'
            ], 403));
        }
//        $token = JWTAuth::getToken();
//        $user = JWTAuth::toUser($token);
//        if (!$token) {
//            throw new HttpResponseException(response()->json([
//                'status' => 403,
//                'title' => 'Unauthorized action',
//                'detail' => 'Unauthorized action. Please Use Authorized Token'
//            ], 403));
//        }
    }
}