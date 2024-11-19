<?php

namespace App\Http\Requests\Guest;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
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
            'surname' => 'required|min:1|max:50',
            'passportID' => 'required|min:9|max:9',
            'checkinDate' => 'required|date',
            'checkoutDate' => 'required|date',
            'room_id' => 'required|integer',
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
