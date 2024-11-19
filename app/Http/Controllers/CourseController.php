<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $builder = Course::latest();

        if ($request->has('department_id')) {
            $builder->whereDepartmentId($request->department_id);
        }

        if ($request->has('school_year_id')) {
            $builder->whereSchoolYearId($request->school_year_id);
        }

        $builder->with([
            'department',
            'sections' => function ($query) {
                $query->withCount('students');
            },

        ]);

        $courses = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($courses);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());

        $course->load([
            'department',
            'sections.students',
        ]);

        return JsonResource::make($course)
            ->additional([
                'message' => 'Course created successfully',
                'status' => 201,
                'success' => true,
            ]);
    }

    public function show(Course $course)
    {
        $course->load([
            'department',
            'sections.students',
        ]);

        return JsonResource::make($course);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        $course->load([
            'department',
            'sections.students',
        ]);

        return JsonResource::make($course)
            ->additional([
                'message' => 'Course updated successfully',
                'status' => 200,
                'success' => true,
            ]);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return JsonResource::make($course)
            ->additional([
                'message' => 'Course deleted successfully',
                'status' => 200,
                'success' => true,
            ]);
    }
}
