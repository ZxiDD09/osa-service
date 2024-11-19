<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum SexEnum: string
{
    use InvokableCases, Values;

    case MALE = 'male';
    case FEMALE = 'female';
}
