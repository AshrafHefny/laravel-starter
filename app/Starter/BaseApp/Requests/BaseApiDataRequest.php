<?php

namespace App\Starter\BaseApp\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiDataRequest extends BaseApiRequest
{
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
