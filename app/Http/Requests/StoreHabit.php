<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreHabit extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'hab_goal' => ['required'],
            'hab_name' => [
                'required',
                'max:255',
                Rule::unique('habits')->where(function ($query) {
                    $query->where('hab_goal', $this->input('hab_goal'));
                }),
            ],            
        ];
    }
}
