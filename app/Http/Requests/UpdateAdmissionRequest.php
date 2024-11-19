<?php

namespace App\Http\Requests;

use App\Enums\EnrollmentStatusEnum;
use App\Enums\SemesterEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'semester' => ['nullable', Rule::in(SemesterEnum::values())],
            'candidate_id' => ['nullable', 'exists:candidates,id'],
            'school_year_id' => ['nullable', 'exists:school_years,id'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'section_id' => ['nullable', 'exists:sections,id'],
            'is_new_student' => ['nullable', 'boolean'],
            'enrollment_status' => ['nullable', Rule::in(EnrollmentStatusEnum::values())],
            'gpa' => ['nullable', 'numeric'],
        ];
    }
}
