<?php

namespace App\Starter\Users\Requests;

use Carbon\Carbon;
use App\Starter\Users\User;
use Illuminate\Validation\Rule;
use App\Starter\Users\UserEnums;
use Illuminate\Support\Facades\Auth;
use App\Starter\BaseApp\Requests\BaseAppRequest;

class CreateUserRequest extends BaseAppRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Edit some user data before validation
     * @return void
     */
    protected function prepareForValidation()
    {

    }
}
