<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['string','max:20'],
            'email'    => ['required','email','unique:users'],
            'password' => ['required','string','min:6']
        ];
    }


    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Registoed Validation errors',
            'data'      => $validator->errors(),
            'status'    => 400

        ]));

    }
}
