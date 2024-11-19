<?php

namespace App\Http\Requests;

use App\Enums\CandidateStatusEnum;
use App\Enums\TypeOfSchoolGraduateFromEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCandidateRequest extends FormRequest
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
            'information_id' => ['required', 'uuid'],
            'type_of_school_graduated_from' => ['required', Rule::in(TypeOfSchoolGraduateFromEnum::values())],
            'senior_highschool_strand' => ['required', 'string'],
            'is_first_generation_group' => ['required', 'boolean'],
            'is_indigenous_people_group' => ['required', 'boolean'],
            'is_person_with_disability_group' => ['required', 'boolean'],
            'is_solo_parent_group' => ['required', 'boolean'],
            'is_person_with_special_needs_group' => ['required', 'boolean'],
            'annual_income_amount' => ['required'],
            'source_of_family_income' => ['required', 'string'],
            'source_is_uni_fast' => ['required', 'boolean'],
            'source_is_other_scholarships' => ['required', 'boolean'],
            'source_is_self_financed' => ['required', 'boolean'],
            'source_is_parent' => ['required', 'boolean'],
            'has_mobile_phone' => ['required', 'boolean'],
            'has_laptop' => ['required', 'boolean'],
            'has_tablet' => ['required', 'boolean'],
            'has_desktop' => ['required', 'boolean'],
            'other_gadgets' => ['required', 'string'],
            'candidate_status' => ['required', Rule::in(CandidateStatusEnum::values())],
        ];
    }
}
