<?php

namespace App\Http\Requests\AdminRequest\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'small_description'=> 'nullable|string|max:500',
            'original_price'   => 'nullable|numeric|min:0',
            'selling_price'    => 'nullable|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'sku'              => 'nullable|string|max:50',
            'status'           => 'boolean',
            'flash_sales'      => 'boolean',
            'best_sell'        => 'boolean',
            'category_id'      => 'nullable|exists:categories,id',
            'brand_id'         => 'nullable|exists:brands,id',

            // ✅ Update এ thumbnail optional থাকবে
            'image'        => 'url|required',
        ];
    }
}
