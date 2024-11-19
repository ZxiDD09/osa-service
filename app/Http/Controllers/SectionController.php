<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $builder = Section::latest();

        if ($request->has('department_id')) {
            $builder->whereDepartmentId($request->department_id);
        }

        if ($request->has('school_year_id')) {
            $builder->whereSchoolYearId($request->school_year_id);
        }

        if ($request->has('course_id')) {
            $builder->whereCourseId($request->course_id);
        }

        $builder->with([
            'course',
            'department',
            'schoolYear',
        ])
            ->withCount('students');

        $sections = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($sections);
    }

    public function store(StoreSectionRequest $request)
    {
        $section = Section::create($request->validated());

        $section->load([
            'course',
            'department',
            'schoolYear',
            'students',
        ]);

        return JsonResource::make($section)
            ->additional([
                'message' => 'Section created successfully',
                'status' => 201,
                'success' => true,
            ]);
    }

    public function show(Section $section)
    {
        $section->load([
            'course',
            'department',
            'schoolYear',
            'students',
        ]);

        return JsonResource::make($section);
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->validated());

        $section->load([
            'course',
            'department',
            'schoolYear',
            'students',
        ]);

        return JsonResource::make($section)
            ->additional([
                'message' => 'Section updated successfully',
                'status' => 200,
                'success' => true,
            ]);
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return JsonResource::make($section)
            ->additional([
                'message' => 'Section deleted successfully',
                'status' => 200,
                'success' => true,
            ]);
    }
}
