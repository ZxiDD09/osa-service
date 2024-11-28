<?php

namespace App\Http\Requests;

use App\Enums\CandidateStatusEnum;
use App\Enums\TypeOfSchoolGraduateFromEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCandidateRequest extends FormRequest
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
            'type_of_school_graduated_from' => ['nullable', Rule::in(TypeOfSchoolGraduateFromEnum::values())],
            'senior_highschool_strand' => ['nullable', 'string'],
            'is_first_generation_group' => ['nullable', 'boolean'],
            'is_indigenous_people_group' => ['nullable', 'boolean'],
            'is_person_with_disability_group' => ['nullable', 'boolean'],
            'is_solo_parent_group' => ['nullable', 'boolean'],
            'is_person_with_special_needs_group' => ['nullable', 'boolean'],
            'annual_income_amount' => ['nullable'],
            'source_of_family_income' => ['nullable', 'string'],
            'source_is_uni_fast' => ['nullable', 'boolean'],
            'source_is_other_scholarships' => ['nullable', 'boolean'],
            'source_is_self_financed' => ['nullable', 'boolean'],
            'source_is_parent' => ['nullable', 'boolean'],
            'has_mobile_phone' => ['nullable', 'boolean'],
            'has_laptop' => ['nullable', 'boolean'],
            'has_tablet' => ['nullable', 'boolean'],
            'has_desktop' => ['nullable', 'boolean'],
            'other_gadgets' => ['nullable', 'string'],
            'candidate_status' => ['nullable', Rule::in(CandidateStatusEnum::values())],
            'is_passed' => ['nullable', 'boolean'],
        ];
    }
}
