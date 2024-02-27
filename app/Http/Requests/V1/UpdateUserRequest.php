<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['prohibited'],
                'status' => ['required', 'in:A0,A1,A2,A3'],
                'position' => ['required', 'string', 'max:255'],
                'daily_hours' => ['required', 'integer', 'min:6'],
            ];
        }
        else {
            return [
                'first_name' => ['sometimes', 'required', 'string', 'max:255'],
                'last_name' => ['sometimes', 'required', 'string', 'max:255'],
                'email' => ['sometimes', 'required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['prohibited'],
                'status' => ['sometimes', 'required', 'in:A0,A1,A2,A3'],
                'position' => ['sometimes', 'required', 'string', 'max:255'],
                'daily_hours' => ['sometimes', 'required', 'integer', 'min:6'],
            ];
        }
    }
}
