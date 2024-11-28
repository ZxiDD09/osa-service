<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesOverviewService
{
    public function getOverview(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->get();

        $courses = $admissions->groupBy('course_id')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->course->name,
                'y' => $admissions->count(),
            ];
        })->values()->toArray();

        return JsonResource::make($courses);
    }

    public function summary(Collection $admissions)
    {
        return $admissions->groupBy('course_id')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->course->name,
                'y' => $admissions->count(),
            ];
        })->values()->toArray();

    }
}
