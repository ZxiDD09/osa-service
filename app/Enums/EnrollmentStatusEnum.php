<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum EnrollmentStatusEnum: string
{
    use InvokableCases, Values;

    case New = 'new';
    case Transferee = 'transferee';
    case Returnee = 'returnee';
    case Continuing = 'continuing';

}
