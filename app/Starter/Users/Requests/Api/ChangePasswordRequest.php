<?php

namespace App\Starter\Users\Requests\Api;

use App\Starter\BaseApp\Requests\BaseApiTokenDataRequest;

class ChangePasswordRequest extends BaseApiTokenDataRequest
{
    public function rules()
    {
        return [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
