<?php

namespace App\Services;

use App\Models\Admission;
use App\Models\Candidate;
use App\Models\SchoolYear;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionVsCandidatesService
{
    public function getAdmissionVsCandidates(Request $request)
    {
        $builder = Candidate::query();

        if ($request->has('school_year_id')) {
            $schoolYear = SchoolYear::findOrFail($request->school_year_id);
            $years = explode('-', $schoolYear->name);

            $builder->whereBetween('created_at', [
                $years[0].'-01-01',
                $years[1].'-12-31',
            ]);
        }

        $candidates = $builder->where('created_at', '>=', now()->subDays(30))->get();

        $dates = new Collection;
        for ($i = 0; $i < 30; $i++) {
            $dates->put(Carbon::now()->subDays($i)->format('Y-m-d'), 0);
        }

        $groupedCandidates = $candidates->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $thirtyDaysCandidates = $dates->map(function ($count, $date) use ($groupedCandidates) {
            return [
                'y' => $date,
                'x' => $groupedCandidates->get($date)?->count() ?? 0,
            ];
        })->sortBy(
            function ($data) {
                return Carbon::parse($data['y']);
            },
        )->values()->toArray();

        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->get();

        $groupedAdmissions = $admissions->groupBy(function ($admission) {
            return Carbon::parse($admission->created_at)->format('Y-m-d');
        });

        $thirtyDaysAdmissions = $dates->map(function ($count, $date) use ($groupedAdmissions) {
            return [
                'y' => $date,
                'x' => $groupedAdmissions->get($date)?->count() ?? 0,
            ];
        })->sortBy(
            function ($data) {
                return Carbon::parse($data['y']);
            },
        )->values()->toArray();

        $resource = [
            'admissions' => $thirtyDaysAdmissions,
            'candidates' => $thirtyDaysCandidates,
        ];

        return JsonResource::make($resource);
    }

    public function summary(Request $request, Collection $admissions)
    {
        $builder = Candidate::query();

        if ($request->has('school_year_id')) {
            $schoolYear = SchoolYear::findOrFail($request->school_year_id);
            $years = explode('-', $schoolYear->name);

            $builder->whereBetween('created_at', [
                $years[0].'-01-01',
                $years[1].'-12-31',
            ]);
        }

        $candidates = $builder->where('created_at', '>=', now()->subDays(30))->get();

        $dates = new Collection;
        for ($i = 0; $i < 30; $i++) {
            $dates->put(Carbon::now()->subDays($i)->format('Y-m-d'), 0);
        }

        $groupedCandidates = $candidates->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $thirtyDaysCandidates = $dates->map(function ($count, $date) use ($groupedCandidates) {
            return [
                'y' => $date,
                'x' => $groupedCandidates->get($date)?->count() ?? 0,
            ];
        })->sortBy(
            function ($data) {
                return Carbon::parse($data['y']);
            },
        )->values()->toArray();

        $groupedAdmissions = $admissions->groupBy(function ($admission) {
            return Carbon::parse($admission->created_at)->format('Y-m-d');
        });

        $thirtyDaysAdmissions = $dates->map(function ($count, $date) use ($groupedAdmissions) {
            return [
                'y' => $date,
                'x' => $groupedAdmissions->get($date)?->count() ?? 0,
            ];
        })->sortBy(
            function ($data) {
                return Carbon::parse($data['y']);
            },
        )->values()->toArray();

        return [
            'admissions' => $thirtyDaysAdmissions,
            'candidates' => $thirtyDaysCandidates,
        ];
    }
}
