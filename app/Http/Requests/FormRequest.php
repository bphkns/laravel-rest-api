<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new JsonResponse([
            'data' => $validator->errors()
        ], 422));

        parent::failedValidation($validator);
    }
}