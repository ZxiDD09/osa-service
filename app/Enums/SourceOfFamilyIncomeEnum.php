<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum SourceOfFamilyIncomeEnum: string
{
    use InvokableCases, Values;

    case SALARY = 'salary';
    case WAGE = 'wage';
    case INCOME_FROM_BUSINESS = 'income from business';
    case OTHER = 'OTHER';
}
