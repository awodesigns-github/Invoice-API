<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan("create");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required"],
            "type" => ["required", Rule::in(['B','I','b','i'])],
            "email" => ["required", "email"],
            "address" => ["required"],
            "city" => ["required"],
            "state" => ["required"],
            "postalCode" => ["required"],
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            "postal_code" => $this->postalCode
        ]);
    }
}
