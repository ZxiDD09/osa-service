<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PassedVsFailedService
{
    public function getPassedVsFailed(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->with('candidate')->get();

        $passedVsFailed = $admissions->groupBy('candidate.is_passed')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->candidate->is_passed ? 'Passed' : 'Failed',
                'y' => $admissions->count(),
            ];
        })->sortByDesc('y');

        return JsonResource::make($passedVsFailed);
    }
}
