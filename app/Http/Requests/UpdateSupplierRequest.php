<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'name' => ['required','max:255', Rule::unique('suppliers','name')->ignore($this->supplier)],
            'address' => ['required','max:255', Rule::unique('suppliers','address')->ignore($this->supplier)],
            'email' => ['required','max:255', Rule::unique('suppliers','email')->ignore($this->supplier)],
            'address' => ['required','max:255', Rule::unique('suppliers','email')->ignore($this->supplier)],
            'phone' => ['required', 'max:255','regex:/[0-9]/', Rule::unique('suppliers','phone')->ignore($this->supplier)],
            'supplier_fax' => ['required', 'max:255', 'regex:/[0-9]/', Rule::unique('suppliers','supplier_fax')->ignore($this->supplier)],
        ];
    }
}
