<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
                'work_day_id' => ['required', 'integer'],
                'description' => ['required', 'string', 'max:255'],
            ];
        }
        else {
            return [
                'work_day_id' => ['sometimes', 'required', 'integer'],
                'description' => ['sometimes', 'required', 'string', 'max:255'],
            ];
        }
    }
}
