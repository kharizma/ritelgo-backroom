<?php

namespace App\Http\Requests\Master\PackageSubscriptionDetail;

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
            'package_subscription_id'   => 'required|integer',
            'custom_name'               => 'nullable|string|max:255',
            'value'                     => 'nullable|string|max:255',
            'order'                     => 'nullable|integer|min:1',
        ];
    }
}
