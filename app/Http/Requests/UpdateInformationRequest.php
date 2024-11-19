<?php

namespace App\Http\Requests;

use App\Enums\CivilStatusEnum;
use App\Enums\SexEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInformationRequest extends FormRequest
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
            'first_name' => ['nullable', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'suffix' => ['nullable', 'string'],
            'zip_code' => ['nullable', 'string'],
            'zone' => ['nullable', 'string'],
            'barangay' => ['nullable', 'string'],
            'municipality' => ['nullable', 'string'],
            'province' => ['nullable', 'string'],
            'date_of_birth' => ['nullable', 'date'],
            'place_of_birth' => ['nullable', 'string'],
            'sex' => ['nullable', Rule::in(SexEnum::values())],
            'civil_status' => ['nullable', Rule::in(CivilStatusEnum::values())],
            'religion' => ['nullable', 'string'],
            'nationality' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],

            // for students nullable
            'father_last_name' => ['nullable', 'string'],
            'father_first_name' => ['nullable', 'string'],
            'father_middle_name' => ['nullable', 'string'],
            'father_suffix' => ['nullable', 'string'],
            'father_occupation' => ['nullable', 'string'],

            'mother_last_name' => ['nullable', 'string'],
            'mother_first_name' => ['nullable', 'string'],
            'mother_middle_name' => ['nullable', 'string'],
            'mother_suffix' => ['nullable', 'string'],
            'mother_occupation' => ['nullable', 'string'],

            'guardian_full_name' => ['nullable', 'string'],
            'guardian_address' => ['nullable', 'string'],
            'guardian_phone' => ['nullable', 'string'],
        ];
    }
}
