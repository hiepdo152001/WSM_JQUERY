<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name' => 'required|max:255',
                'email' => 'unique:users,email|required|',
                'password' => 'required|min:6',
        ];
        // regex:/^([a-z0-9\+_.\-]{4,65}+)(\.[a-z0-9\+_\-]{4,65}+)*@([a-z0-9\-]{2,65}+\.)+[a-z]{2,6}$/ix',
    }
   
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
