<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum SemesterEnum: string
{
    use InvokableCases, Values;

    case First = '1st';
    case Second = '2nd';
    case Third = '3rd';
    case Summer = 'Summer';
}
