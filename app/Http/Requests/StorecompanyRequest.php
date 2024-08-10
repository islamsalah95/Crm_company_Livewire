<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecompanyRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'max:255'],
            'company_website' => ['required', 'string', 'max:255'],
            'company_email' => ['required', 'string', 'email', 'max:255','unique:companies,company_email'],
            'company_address' => ['required', 'string', 'max:255'],
            'telephone1' => ['required', 'numeric'],

            'company_currencysymbol' => ['required', 'exists:currencies,id'],
            'country' => ['required', 'exists:countries,id'],
            'state' =>['required', 'exists:states,id'],
            'city' => ['required', 'exists:cities,id'],
            'timezone' => ['required', 'exists:timezones,id'],

            'zip' => ['required', 'string', 'max:255'],
            // 'currently_allowed_employee' => ['required', 'numeric'],
        ];
    }
}
