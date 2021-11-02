<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "name" => "required",
            "thumbnail" => "required|mimes:jpeg,jpg,png",
            "category_id" => "required",
            "subcategory_id" => "required",
            "summery" => "required|max:255",
            "description" => "required",
            "color_id" => "required|array",
            "size_id" => "required|array",
            "quantity" => "required|array",
            "regular_price" => "required|array",
            "offer_price" => "required|array",
        ];
    }

    public function messages()
    {
        return [
            "color_id.required.array" => "This field is empty.",
            "size_id.required.array" => "This field is empty.",
            "quantity.required.array" => "This field is empty.",
            "regular_price.required.array" => "This field is empty.",
            "offer_price.required.array" => "This field is empty.",
        ];
    }
}
