<?php

namespace app\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWorkDayRequest;
use App\Http\Requests\V1\StoreWorkSheetRequest;
use App\Http\Requests\V1\UpdateWorkDayRequest;
use App\Http\Resources\V1\WorkDayCollection;
use App\Http\Resources\V1\WorkDayResource;
use App\Http\Resources\V1\WorkSheetResource;
use App\Models\WorkDay;
use App\Models\WorkSheet;
use App\Services\V1\WorkDaysQuery;
use Illuminate\Http\Request;

class WorkDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new WorkDaysQuery();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new WorkDayCollection(WorkDay::paginate());
        }
        else {
            return new WorkDayCollection(WorkDay::where($queryItems)->paginate());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkDayRequest $request)
    {
        $newWorkDay = new WorkDayResource(WorkDay::create($request->all()));

        $currentTime = now()->format('H:i:s');

        $workSheetData = [
            'work_day_id' => $newWorkDay->id,
            'arrived_at' => $currentTime,
            'leave_at' => null
        ];

        $newWorkSheet = new WorkSheetResource(WorkSheet::create($workSheetData));

        return new WorkDayResource($newWorkDay);
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkDay $workday)
    {
        return new WorkDayResource($workday);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkDayRequest $request, WorkDay $workday)
    {
        $workday->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $workday = WorkDay::withTrashed()->find($id);

        if (!$workday || $workday->trashed()) {
            return response()->json(['message' => 'Work day not found'], 404);
        }

        $workday->delete();

        return response()->json(['message' => 'Work day deleted successfully'], 200);
    }
}
