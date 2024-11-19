<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdmissionRequest;
use App\Http\Requests\UpdateAdmissionRequest;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('candidate_id')) {
            $builder->where('candidate_id', $request->candidate_id);
        }

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        if ($request->has('course_id')) {
            $builder->where('course_id', $request->course_id);
        }

        if ($request->has('section_id')) {
            $builder->where('section_id', $request->section_id);
        }

        if ($request->has('is_new_student')) {
            $builder->where('is_new_student', $request->is_new_student);
        }

        if ($request->has('enrollment_status')) {
            $builder->where('enrollment_status', $request->enrollment_status);
        }

        $builder->with('candidate.information', 'schoolYear', 'course', 'section');

        $admissions = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($admissions);
    }

    public function store(StoreAdmissionRequest $request)
    {
        $admission = Admission::firstOrCreate($request->validated());

        $admission->load(
            'candidate.student.user',
            'schoolYear',
            'course',
        );

        return JsonResource::make($admission)->additional([
            'message' => 'Admission created successfully.',
        ]);
    }

    public function show(Admission $admission)
    {
        $admission->load(
            'candidate.student.user',
            'schoolYear',
            'course',
        );

        return JsonResource::make($admission);
    }

    public function update(UpdateAdmissionRequest $request, Admission $admission)
    {
        $admission->update($request->validated());

        $admission->load(
            'candidate.student.user',
            'schoolYear',
            'course',
        );

        return JsonResource::make($admission)->additional([
            'message' => 'Admission updated successfully.',
        ]);
    }

    public function destroy(Admission $admission)
    {
        $admission->delete();

        return JsonResource::make($admission)->additional([
            'message' => 'Admission deleted successfully.',
        ]);
    }
}
