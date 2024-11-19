<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $builder = Department::latest();

        if ($request->has('school_year_id')) {
            $builder->whereSchoolYearId($request->school_year_id);
        }

        $builder->with([
            'schoolYear',
            'courses' => function ($query) {
                $query->withCount('sections');
            },

        ]);

        $departments = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($departments);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        $department->load([
            'schoolYear',
            'courses.sections' => function ($query) {
                $query->withCount('students');
            },
        ]);

        return new JsonResource($department);
    }

    public function show(Department $department)
    {
        $department->load([
            'schoolYear',
            'courses.sections' => function ($query) {
                $query->withCount('students');
            },
        ]);

        return JsonResource::make($department);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        $department->load([
            'schoolYear',
            'courses.sections' => function ($query) {
                $query->withCount('students');
            },
        ]);

        return JsonResource::make($department)
            ->additional([
                'message' => 'Department updated successfully',
                'status' => 200,
                'success' => true,
            ]);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return JsonResource::make($department)
            ->additional([
                'message' => 'Department deleted successfully',
                'status' => 200,
                'success' => true,
            ]);
    }
}
