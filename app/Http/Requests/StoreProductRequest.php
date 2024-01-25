<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'vendor_id' => ['required', Rule::exists(Vendor::class, 'id')],
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
            'brand_id' => ['required', Rule::exists(Brand::class, 'id')],
            'title_fa' => 'required|string|max:100',
            'title_en' => 'nullable|string|max:100',
            'product_title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'rating' => 'required|decimal:0,1',
            'stock' => 'required|integer',
        ];
    }
}
