<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformationRequest;
use App\Http\Requests\UpdateInformationRequest;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $builder = Information::latest();

        $builder->has('candidate.student.section')->with(['candidate.student']);

        $information = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($information);
    }

    public function search(Request $request)
    {
        $builder = Information::search($request->keyword);

        $information = $builder->paginate($request->per_page ?? 20);

        $information->transform(function ($info) {
            $info->load(['candidate.student']);

            return $info;
        });

        $information = $information->filter(function ($info) {
            return (bool) $info?->candidate?->student?->section;
        });

        return JsonResource::collection($information);
    }

    public function store(StoreInformationRequest $request)
    {
        $information = Information::create($request->validated());

        $information->load(['candidate.student']);

        return JSONResource::make($information)->additional([
            'message' => 'Information created successfully',
        ]);
    }

    public function show(Information $information)
    {
        $information->load([

            'candidate.student.section',
            'candidate.admissions',
        ]);

        return JSONResource::make($information);
    }

    public function update(UpdateInformationRequest $request, Information $information)
    {
        $information->update($request->validated());

        $information->load([

            'candidate.student.section',
            'candidate.admissions',
        ]);

        return JSONResource::make($information)->additional([
            'message' => 'Information updated successfully',
        ]);
    }

    public function destroy(Information $information)
    {
        $information->delete();

        return JSONResource::make($information)->additional([
            'message' => 'Information deleted successfully',
        ]);
    }
}
