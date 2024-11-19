<?php

namespace App\Http\Requests\Hotel;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|min:1|max:50',
            'adress' => 'required|min:4|max:50',
            'phoneNumber' => 'required|min:3|max:9',
            'email' => 'required|min:4|max:50',
            'website' => 'required|min:4|max:50',
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if($this->expectsJson()){
            $response = new Response($validator->errors(), 422);
            throw new ValidationException($validator, $response);
        }
    }
}
