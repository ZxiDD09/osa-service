<?php

namespace App\Http\Controllers;

use App\Services\AnnualIncomesService;
use App\Services\CoursesOverviewService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __construct(
        private readonly AnnualIncomesService $annualIncomesService,
        private readonly CoursesOverviewService $coursesOverviewService
    ) {}

    public function coursesOverview(Request $request)
    {
        return $this->coursesOverviewService->getOverview($request);
    }

    public function annualIncomes(Request $request)
    {
        return $this->annualIncomesService->getIncomes($request);
    }
}
