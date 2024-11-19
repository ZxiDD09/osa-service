<?php

namespace App\Http\Requests;

use App\Enums\EnrollmentStatusEnum;
use App\Enums\SemesterEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdmissionRequest extends FormRequest
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
            'semester' => ['required', Rule::in(SemesterEnum::values())],
            'candidate_id' => ['required', 'exists:candidates,id'],
            'school_year_id' => ['required', 'exists:school_years,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'is_new_student' => ['required', 'boolean'],
            'enrollment_status' => ['required', Rule::in(EnrollmentStatusEnum::values())],
            'gpa' => ['required', 'numeric'],
        ];
    }
}
