<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkDayRequest extends FormRequest
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
                'user_id' => ['required', 'integer'],
                'date' => [
                    'required',
                    'date',
                    Rule::unique('work_days')->where(function ($query) {
                        return $query->where('date', $this->date)
                            ->where('user_id', $this->user_id);
                    }),
                ],
            ];
        }
        else {
            return [
                'user_id' => ['sometimes', 'required', 'integer'],
                'date' => [
                    'sometimes',
                    'required',
                    'date',
                    Rule::unique('work_days')->where(function ($query) {
                        return $query->where('date', $this->date)
                            ->where('user_id', $this->user_id);
                    }),
                ],
            ];
        }
    }
}
