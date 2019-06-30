<?php

namespace App\Starter\BaseApp\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BaseApiRequest extends BaseAppRequest
{
    //format all error messages to jsonapi error object format
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        foreach ($errors as $name => $error) {

            $errorArray[] = [
                'status' => 422,
                'title' =>  $name,
                'detail' =>  $error[0],
            ];
        }
        throw new HttpResponseException(response()->json(["errors" => $errorArray], 422));
    }
}