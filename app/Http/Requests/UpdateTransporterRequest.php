<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTransporterRequest extends FormRequest
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
            //
            'name' => ['required','max:255', Rule::unique('transporters','name')->ignore($this->transporter)],
            'email' => ['required','max:255', Rule::unique('transporters','email')->ignore($this->transporter)],
            'phone' => ['required', 'max:255','regex:/[0-9]/', Rule::unique('transporters','phone')->ignore($this->transporter)],
            'postage' => ['required', 'max:255', 'regex:/[0-9]/','min:9'],
        ];
    }
}
