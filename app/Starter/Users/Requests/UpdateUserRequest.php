<?php


namespace App\Starter\Users\Requests;
use App\Starter\BaseApp\Requests\BaseAppRequest;

class UpdateUserRequest extends BaseAppRequest
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
