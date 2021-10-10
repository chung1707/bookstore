<?php

namespace App\Http\Requests;

use App\Rules\NotNullRule;
use App\Rules\ValidEmailRule;
use App\Rules\ValidPhoneRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfosRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|string',
            'email' => ['required','email','max:255', new ValidEmailRule()],
            'address' => 'required|max:255',
            'phone' => ['required', 'max:255', 'min:9', 'regex:/[0-9]/', new ValidPhoneRule() ],
            'province_id' => ['required', new NotNullRule(),'exists:provinces,id'],
            'district_id' => ['required', new NotNullRule(),'exists:districts,id'],
            'ward_id' => ['required', new NotNullRule(),'exists:wards,id'],
        ];
    }
}
