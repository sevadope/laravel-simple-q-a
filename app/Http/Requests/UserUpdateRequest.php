<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:30',
            'last_name' => 'nullable|string|max:50',
            'briefly_about_myself' => 'nullable|string|max:50',
            'about_myself' => 'nullable|string|max:5000',
        ];
    }
}
