<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Services\AdmissionVsCandidatesService;
use App\Services\AnnualIncomesService;
use App\Services\CandidateGadgetService;
use App\Services\CandidateGroupService;
use App\Services\CoursesOverviewService;
use App\Services\HighSchoolStrandsService;
use App\Services\PassedVsFailedService;
use App\Services\SourcesOfIncomeService;
use App\Services\TuitionFinancialSourcesService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticsController extends Controller
{
    public function __construct(
        private readonly AnnualIncomesService $annualIncomesService,
        private readonly PassedVsFailedService $passedVsFailedService,
        private readonly CandidateGroupService $candidateGroupService,
        private readonly CoursesOverviewService $coursesOverviewService,
        private readonly CandidateGadgetService $candidateGadgetService,
        private readonly SourcesOfIncomeService $sourcesOfIncomeService,
        private readonly HighSchoolStrandsService $highSchoolStrandsService,
        private readonly AdmissionVsCandidatesService $admissionVsCandidatesService,
        private readonly TuitionFinancialSourcesService $tuitionFinancialSourcesService
    ) {}

    public function summary(Request $request)
    {
        $builder = Admission::latest();

        if ($request->has('school_year_id')) {
            $builder->where('school_year_id', $request->school_year_id);
        }

        $admissions = $builder->with('candidate')->get();

        return JsonResource::make([
            'courses_overview' => $this->coursesOverviewService->summary($admissions),
            'annual_incomes' => $this->annualIncomesService->summary($admissions),
            'passed_vs_failed' => $this->passedVsFailedService->summary($admissions),
            'tuition_financial_sources' => $this->tuitionFinancialSourcesService->summary($admissions),
            'highschool_strands' => $this->highSchoolStrandsService->summary($admissions),
            'candidate_gadgets' => $this->candidateGadgetService->summary($admissions),
            'candidate_groups' => $this->candidateGroupService->summary($admissions),
            'sources_of_incomes' => $this->sourcesOfIncomeService->summary($admissions),
            'admission_vs_candidates' => $this->admissionVsCandidatesService->summary($request, $admissions),
        ]);
    }

    public function coursesOverview(Request $request)
    {
        return $this->coursesOverviewService->getOverview($request);
    }

    public function annualIncomes(Request $request)
    {
        return $this->annualIncomesService->getIncomes($request);
    }

    public function passedVsFailed(Request $request)
    {
        return $this->passedVsFailedService->getPassedVsFailed($request);
    }

    public function tuitionFinancialSources(Request $request)
    {
        return $this->tuitionFinancialSourcesService->getFinancialSources($request);
    }

    public function highschoolStrands(Request $request)
    {
        return $this->highSchoolStrandsService->getStrands($request);
    }

    public function candidateGadgets(Request $request)
    {
        return $this->candidateGadgetService->getCandidateGadgets($request);
    }

    public function candidateGroups(Request $request)
    {
        return $this->candidateGroupService->getCandidateGroups($request);
    }

    public function sourcesOfIncomes(Request $request)
    {
        return $this->sourcesOfIncomeService->getSourcesOfIncomes($request);
    }

    public function admissionVsCandidates(Request $request)
    {
        return $this->admissionVsCandidatesService->getAdmissionVsCandidates($request);
    }
}
