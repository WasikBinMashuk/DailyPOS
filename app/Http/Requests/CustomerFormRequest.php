<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'name' => 'required|string|min:1|max:30',
            'email' => 'required|string|email|min:1|max:100|unique:customers',
            'mobile' => 'required|numeric|digits:11',
            // 'status' => 'required|in:0,1',
            'address' => 'required|string|min:1|max:255'
        ];
    }
}
