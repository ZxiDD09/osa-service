<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum TypeOfSchoolGraduateFromEnum: string
{
    use InvokableCases, Values;

    case PUBLIC = 'Public';
    case PRIVATE = 'Private';

}
