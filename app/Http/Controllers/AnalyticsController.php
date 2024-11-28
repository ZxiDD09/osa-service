<?php

namespace App\Http\Controllers;

use App\Services\AnnualIncomesService;
use App\Services\CoursesOverviewService;
use App\Services\PassedVsFailedService;
use App\Services\TuitionFinancialSourcesService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __construct(
        private readonly AnnualIncomesService $annualIncomesService,
        private readonly PassedVsFailedService $passedVsFailedService,
        private readonly CoursesOverviewService $coursesOverviewService,
        private readonly TuitionFinancialSourcesService $tuitionFinancialSourcesService
    ) {}

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
}
