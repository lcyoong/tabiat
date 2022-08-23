<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
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
            'id' => ['required', 'exists:users,id'],
            'email' => ['required', 'email', 'max:225', Rule::unique('users', 'email')->ignore($this->input('id'), 'id')],
            'user_name' => ['required', 'max:225', Rule::unique('users', 'user_name')->ignore($this->input('id'), 'id')],
            'name' => ['required', 'max:225'],
        ];
    }
}
