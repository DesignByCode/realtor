<?php

namespace DesignByCode\Realtor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LVR\Phone\Phone;

class ProfileNumbersRequest extends FormRequest
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
            'type' => 'required',
            'phone' =>  ['required', new Phone, 'unique:phones,phone']
        ];
    }
}
