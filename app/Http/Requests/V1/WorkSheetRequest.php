<?php

namespace App\Http\Requests\V1;

use App\Models\WorkSheet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

abstract class WorkSheetRequest extends FormRequest
{
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (!$this->checkWorkSheetOverlap()) {
                $validator->errors()->add('work_sheet_overlap', 'The work sheet overlaps with another work sheet in the same work day.');
            }
        });
    }

    /**
     * Check if the work sheet overlaps with another work sheet.
     *
     * @return bool
     */
    protected function checkWorkSheetOverlap(): bool
    {
        $workDayId = $this->input('work_day_id');
        $newArrivedAt = $this->input('arrived_at');
        $newLeaveAt = $this->input('leave_at');

        $workSheets = WorkSheet::where('work_day_id', $workDayId)
            ->where('id', '!=', $this->route('workSheet')) // Assuming 'workSheet' is the route parameter name for the worksheet ID
            ->get();

        foreach ($workSheets as $workSheet) {
            if ($newArrivedAt < $workSheet->leave_at && $newLeaveAt > $workSheet->arrived_at) {
                // Found an overlap
                return false;
            }
        }

        if ($newArrivedAt > $newLeaveAt) {
            return false;
        }

        return true; // No overlap found
    }
}
