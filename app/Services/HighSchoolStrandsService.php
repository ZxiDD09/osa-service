<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HighSchoolStrandsService
{
    public function getStrands(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->with('candidate')->get();

        $strands = $admissions->groupBy('candidate.senior_highschool_strand')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->candidate->senior_highschool_strand,
                'y' => $admissions->count(),
            ];
        })->sortByDesc('y')
            ->values()
            ->toArray();

        return JsonResource::make($strands);
    }
}
