<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum SeniorHighSchoolStrandEnum: string
{
    use InvokableCases, Values;

    case STEM = 'STEM';
    case ABM = 'ABM';
    case HUMSS = 'HUMSS';
    case GASS = 'GASS';
    case TVL = 'TVL';
    case OTHER = 'OTHER';
}
