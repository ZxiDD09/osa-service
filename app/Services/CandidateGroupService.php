<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateGroupService
{
    public function getCandidateGroups(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->with('candidate')->get();

        $groups = [
            'is_first_generation_group',
            'is_indigenous_people_group',
            'is_person_with_disability_group',
            'is_solo_parent_group',
            'is_person_with_special_needs_group',
        ];

        $candidateGroups = collect($groups)->map(function ($group) use ($admissions) {
            return [
                'x' => $group,
                'y' => $admissions->filter(function ($admission) use ($group) {
                    return $admission->candidate->{$group};
                })->count(),
            ];
        })->sortByDesc('y');

        collect($groups)->each(function ($group) use (&$candidateGroups) {
            $candidateGroups->push([
                'x' => $group,
                'y' => 0,
            ]);
        });

        return JsonResource::make($candidateGroups);
    }
}
