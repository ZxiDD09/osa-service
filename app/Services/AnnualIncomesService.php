<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnualIncomesService
{
    public function getIncomes(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->with('candidate')->get();

        $incomes = $admissions->groupBy('candidate.annual_income_amount')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->candidate->annual_income_amount,
                'y' => $admissions->count(),
            ];
        })->sortByDesc('y');

        return JsonResource::make($incomes);
    }
}
