<?php

namespace app\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWorkSheetRequest;
use App\Http\Requests\V1\UpdateWorkSheetRequest;
use App\Http\Resources\V1\WorkSheetCollection;
use App\Http\Resources\V1\WorkSheetResource;
use App\Models\WorkDay;
use App\Models\WorkSheet;

class WorkSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new WorkSheetCollection(WorkSheet::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkSheetRequest $request)
    {
        return new WorkSheetResource(WorkSheet::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkSheet $worksheet)
    {
        return new WorkSheetResource($worksheet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkSheetRequest $request, WorkSheet $worksheet)
    {
        $worksheet->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $worksheet = WorkSheet::withTrashed()->find($id);

        if (!$worksheet || $worksheet->trashed()) {
            return response()->json(['message' => 'Work sheet not found'], 404);
        }

        $workDayId = $worksheet->work_day_id;

        // Get all work sheets associated with work day
        $workSheets = WorkSheet::where('work_day_id', $workDayId)->get();

        // Check if the work sheet is the last one for the work day
        if (count($workSheets) == 1) {
            // If it is the last worksheet, delete the work day as well
            $workDay = WorkDay::find($workDayId);
            if ($workDay) {
                $workDay->delete(); // Delete the work day if it exists and has no more worksheets associated with it
            }
        }

        $worksheet->delete();

        return response()->json(['message' => 'Work sheet deleted successfully'], 200);
    }
}
