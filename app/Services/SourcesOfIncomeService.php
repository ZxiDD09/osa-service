<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SourcesOfIncomeService
{
    public function getSourcesOfIncomes(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->get();

        $incomeSources = $admissions->groupBy('candidate.source_of_family_income')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->candidate->source_of_family_income,
                'y' => $admissions->count(),
            ];
        })->values()->toArray();

        return JsonResource::make($incomeSources);
    }

    public function summary(Collection $admissions)
    {
        return $admissions->groupBy('candidate.source_of_family_income')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->candidate->source_of_family_income,
                'y' => $admissions->count(),
            ];
        })->values()->toArray();
    }
}
