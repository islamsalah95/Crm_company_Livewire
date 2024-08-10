<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'emp_surname' => ['required', 'string', 'max:255'],
            'contact1' => ['required'],
            'birthday' => ['required', 'date'],
            'employee_national_number' => ['required', 'numeric','max:14'],
            'city_id' => ['required', 'exists:cities,id'],
            'title_id' => ['required', 'exists:titles,id'],
            'qualification_id' => ['required', 'exists:qualifications,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'emp_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max:2048 means maximum file size is 2 MB
            'department' => ['required', 'in:1,2,3,4,5,6'],
        ];
    }
}
