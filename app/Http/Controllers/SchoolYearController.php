<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolYearRequest;
use App\Models\SchoolYear;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;

class SchoolYearController extends Controller
{
    public function index(Request $request)
    {
        $schoolYears = SchoolYear::with(['departments.courses' => function ($query) {
            $query->withCount('sections');
        }])
            ->latest()
            ->paginate($request?->per_page ?? 20);

        return JsonResource::collection($schoolYears);
    }

    public function store(StoreSchoolYearRequest $request)
    {
        $schoolYear = SchoolYear::create($request->validated());

        $schoolYear->load(['departments.courses' => function ($query) {
            $query->withCount('sections');
        }]);

        return JsonResource::make($schoolYear)
            ->additional([
                'message' => 'School year created successfully',
                'status' => 201,
                'success' => true,
            ]);
    }

    public function destroy(SchoolYear $schoolYear)
    {
        $schoolYear->delete();

        return JsonResource::make($schoolYear)
            ->additional([
                'message' => 'School year deleted successfully',
                'status' => 200,
                'success' => true,
            ]);
    }
}
