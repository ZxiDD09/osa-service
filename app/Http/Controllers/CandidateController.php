<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        $builder = Candidate::latest();

        $builder->withCount('admissions')
            ->with(['information', 'student']);

        $candidates = $builder->paginate($request->input('per_page', 20));

        return JsonResource::collection($candidates);
    }

    public function store(StoreCandidateRequest $request)
    {
        $candidate = Candidate::create($request->validated());

        $candidate->load(['information', 'student', 'admissions']);

        return JsonResource::make($candidate)->additional([
            'message' => 'Candidate created successfully',
        ]);
    }

    public function show(Candidate $candidate)
    {
        $candidate->load(['information', 'student', 'admissions']);

        return JSonResource::make($candidate);
    }

    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        $candidate->update($request->validated());

        $candidate->load(['information', 'student', 'admissions']);

        return JsonResource::make($candidate)->additional([
            'message' => 'Candidate updated successfully',
        ]);
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return JsonResource::make($candidate)->additional([
            'message' => 'Candidate deleted successfully',
        ]);
    }
}
