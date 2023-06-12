<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'book_title' => 'required|string',
            'book_number' => 'required|string',
            'location' => 'required|string',
            'is_input' => 'required',
            'file_path' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'utility_id' => 'required|exists:utilities,id'
        ];
    }
}