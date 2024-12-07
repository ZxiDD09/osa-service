<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Candidate;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $builder = Student::latest();

        if ($request->section_id) {
            $builder->where('section_id', $request->section_id);
        }

        $builder->withCount('admissions')
            ->with(['section.course.department', 'candidate.information', 'user']);

        $students = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($students);
    }

    public function store(StoreStudentRequest $request)
    {
        $candidate = Candidate::with('information')->findOrFail($request->candidate_id);

        $password = Str::password();

        $user = User::create([
            'email' => $request->email,
            'name' => $candidate->information->full_name,
            'password' => bcrypt($password),
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'password_string' => $password,
            'student_id' => Str::uuid(),
            ...$request->validated(),
        ]);

        $student->load(['section.course.department', 'candidate.information', 'user', 'admissions']);

        return JsonResource::make($student)->additional([
            'message' => 'Student created successfully',
        ]);
    }

    public function show(Student $student)
    {
        $student->load(['section.course.department', 'candidate.information', 'user', 'admissions']);

        return JsonResource::make($student);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        $student->load(['section', 'candidate.information', 'user', 'admissions']);

        return JsonResource::make($student)->additional([
            'message' => 'Student updated successfully',
        ]);
    }

    public function destroy(Student $student)
    {
        $student->user->delete();

        $student->admissions()->delete();

        return JsonResource::make($student)->additional([
            'message' => 'Student deleted successfully',
        ]);
    }
}
