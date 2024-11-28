<?php

namespace App\Services;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateGadgetService
{
    public function getCandidateGadgets(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->with('candidate')->get();

        $gadgets = [
            'has_mobile_phone',
            'has_laptop',
            'has_tablet',
            'has_desktop',
        ];

        $candidateGadgets = collect($gadgets)->map(function ($gadget) use ($admissions) {
            return [
                'x' => $gadget,
                'y' => $admissions->filter(function ($admission) use ($gadget) {
                    return $admission->candidate->{$gadget};
                })->count(),
            ];
        })->sortByDesc('y');

        $otherGadgets = $admissions->groupBy('candidate.other_gadgets')->map(function ($admissions) {
            return [
                'x' => $admissions->first()->candidate->other_gadgets,
                'y' => $admissions->count(),
            ];
        })->values()->toArray();

        $candidateGadgets->push(...$otherGadgets);

        return JsonResource::make($candidateGadgets->sortByDesc('y'));

    }
}
