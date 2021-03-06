<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'name'=> 'required| max:255',
            'book_code' => 'required| min:7| max: 255',
            'author' => 'required| max:255',
            'description' => 'required',
            'price' => 'required| numeric',
            'quantity' => 'required| numeric',
        ];
    }
}
