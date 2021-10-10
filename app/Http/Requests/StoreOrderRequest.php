<?php

namespace App\Http\Requests;

use App\Rules\NotNullRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'note'=> 'nullable',
            'books' => 'required',
            'dispatch' => 'required|max:255',
            'payment_methods' => 'required|',
            'totalPrice' => 'required',
            'transporter_id' => 'required',
            'discount_code_id'=> 'nullable',
            'phone_number' => ['required', 'max:255', 'min:9', 'regex:/[0-9]/'],
            'province_id' => ['required', new NotNullRule(),'exists:provinces,id'],
            'district_id' => ['required', new NotNullRule(),'exists:districts,id'],
            'ward_id' => ['required', new NotNullRule(),'exists:wards,id'],
        ];
    }
    public function messages()
    {
        return [
            'books.required' => 'Bạn chưa chọn mua sản phẩm nào!',
        ];
    }
}
