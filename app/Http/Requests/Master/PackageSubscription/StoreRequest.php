<?php

namespace App\Http\Requests\Master\PackageSubscription;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'price'         => 'required|integer|min:0',
            'price_annual'  => 'required|integer|min:0',
            'is_show'       => 'nullable|string|max:3',
            'is_active'     => 'nullable|string|max:3',
        ];
    }
}
