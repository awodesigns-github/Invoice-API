<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan("update");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method === "PUT") {
            return [
                "name" => ["required"],
                "type" => ["required", Rule::in(['B','I','b','i'])],
                "email" => ["required", "email"],
                "address" => ["required"],
                "city" => ["required"],
                "state" => ["required"],
                "postalCode" => ["required"],
            ];
        } else { // PATCH request
            return [
                "name" => ["sometimes","required"],
                "type" => ["sometimes", "required", Rule::in(['B','I','b','i'])],
                "email" => ["sometimes", "required", "email"],
                "address" => ["sometimes", "required"],
                "city" => ["sometimes", "required"],
                "state" => ["sometimes", "required"],
                "postalCode" => ["sometimes", "required"],
            ];
        }
    }

    protected function prepareForValidation(){
        if($this->postalCode){
            $this->merge([
                "postal_code" => $this->postalCode
            ]);
        }
    }
}
