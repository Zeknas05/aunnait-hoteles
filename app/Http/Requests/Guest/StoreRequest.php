<?php

namespace App\Http\Requests\Guest;

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
            'surname' => 'required|min:1|max:50',
            'passportID' => 'required|min:9|max:9',
            'checkinDate' => 'required|date',
            'checkoutDate' => 'required|date',
            'room_id' => 'required|integer',
        ];
    }
}
