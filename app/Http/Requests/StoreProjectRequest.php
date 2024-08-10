<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'project_name' => 'required|string|max:191',
            'project_type' => 'required|in:public,none',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'nullable|exists:users,id',
            'share_project_to' => 'nullable|string|max:191',
            'rating' => 'nullable|string|max:10',
            'ip_address' => 'nullable|string|max:191',
        ];
    }
}
