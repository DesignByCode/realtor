<?php

namespace DesignByCode\Realtor\Http\Requests;

use DesignByCode\Realtor\Rules\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password_current' => ['required', new CurrentPassword()],
            'password' => 'required|min:6|string|confirmed'
        ];
    }
}
