<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortProductsRequest extends FormRequest
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
            'sort_by' => 'string|in:name,price,rating',
            'sort_direction' => 'string|in:asc,desc',
        ];
    }
}
