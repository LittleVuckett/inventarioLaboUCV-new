<?php

namespace App\Http\Requests\Product;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
public function rules(): array
{
    return [
        'product_image' => 'image|file|max:2048',
        'product_name' => 'required|string',
        'category_id' => 'required|integer',
        'unit_id' => 'required|integer',
        'stock' => 'required|integer',
        'buying_price' => 'required|integer',
        'selling_price' => 'required|integer',
        // Add new validation rules for the new fields
        'serial_number' => 'nullable|string|max:255',
        'make_or_brand' => 'nullable|string|max:255',
        'ram' => 'nullable|integer',
        'storage_capacity' => 'nullable|integer',
        'gpu' => 'nullable|string|max:255',
        'is_obsolete' => 'required|boolean',
        'is_written_off' => 'required|boolean',
        'comments' => 'nullable|string|max:1000',
	'codInventarioUCV' => 'nullable|string|max:255',
    ];
}

    protected function prepareForValidation()
    {
        $this->merge([
            'product_code' => IdGenerator::generate([
                'table' => 'products',
                'field' => 'product_code',
                'length' => 4,
                'prefix' => 'TR'
            ])
        ]);

    }
}
