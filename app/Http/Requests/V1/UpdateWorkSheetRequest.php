<?php

namespace App\Http\Requests\V1;


class UpdateWorkSheetRequest extends WorkSheetRequest
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
            'work_day_id' => ['required', 'integer'],
            'arrived_at' => ['required', 'date_format:H:i:s'],
            'leave_at' => ['required', 'date_format:H:i:s']
        ];
    }
}
