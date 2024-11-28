<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TuitionFinancialSourcesService
{
    public function getFinancialSources(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->with('candidate')->get();

        $sources = [
            'source_is_uni_fast',
            'source_is_other_scholarships',
            'source_is_self_financed',
            'source_is_parent',
        ];

        $financialSources = collect($sources)->map(function ($source) use ($admissions) {
            return [
                'x' => $source,
                'y' => $admissions->filter(function ($admission) use ($source) {
                    return $admission->candidate->{$source};
                })->count(),
            ];
        })->sortByDesc('y');

        collect($sources)->each(function ($source) use (&$financialSources) {
            $financialSources->push([
                'x' => $source,
                'y' => 0,
            ]);
        });

        return JsonResource::make($financialSources);
    }
}
