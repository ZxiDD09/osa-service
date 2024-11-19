<?php

namespace App\Models;

use App\Traits\UuidPrimaryKeyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Information extends Model
{
    use HasFactory, Searchable, UuidPrimaryKeyable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'zip_code',
        'zone',
        'barangay',
        'municipality',
        'province',
        'date_of_birth',
        'place_of_birth',
        'sex',
        'civil_status',
        'religion',
        'nationality',
        'phone',

        // for students nullable
        'father_last_name',
        'father_first_name',
        'father_middle_name',
        'father_suffix',
        'father_occupation',

        'mother_last_name',
        'mother_first_name',
        'mother_middle_name',
        'mother_suffix',
        'mother_occupation',

        'guardian_full_name',
        'guardian_address',
        'guardian_phone',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    protected $appends = [
        'full_name',
        'reversed_name',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name} {$this->suffix}";
    }

    public function getReversedNameAttribute()
    {
        return "{$this->last_name}, {$this->first_name} {$this->middle_name} {$this->suffix}";
    }
}
