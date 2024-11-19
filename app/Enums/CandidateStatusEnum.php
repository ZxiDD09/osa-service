<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum CandidateStatusEnum: string
{
    use InvokableCases, Values;

    case APPLICANT = 'applicant';
    case STUDENT = 'student';

}
