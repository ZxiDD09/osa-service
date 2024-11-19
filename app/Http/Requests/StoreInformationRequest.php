<?php

namespace App\Http\Requests;

use App\Enums\CivilStatusEnum;
use App\Enums\SexEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInformationRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['required', 'string'],
            'suffix' => ['nullable', 'string'],
            'zip_code' => ['required', 'string'],
            'zone' => ['required', 'string'],
            'barangay' => ['required', 'string'],
            'municipality' => ['required', 'string'],
            'province' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'place_of_birth' => ['required', 'string'],
            'sex' => ['required', Rule::in(SexEnum::values())],
            'civil_status' => ['required', Rule::in(CivilStatusEnum::values())],
            'religion' => ['required', 'string'],
            'nationality' => ['required', 'string'],
            'phone' => ['required', 'string'],

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
