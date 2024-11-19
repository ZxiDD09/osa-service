<?php

namespace App\Models;

use App\Traits\UuidPrimaryKeyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Candidate extends Model
{
    use HasFactory, Searchable, UuidPrimaryKeyable;

    protected $fillable = [
        'information_id',
        'type_of_school_graduated_from',
        'senior_highschool_strand',
        'is_first_generation_group',
        'is_indigenous_people_group',
        'is_person_with_disability_group',
        'is_solo_parent_group',
        'is_person_with_special_needs_group',
        'annual_income_amount',
        'source_of_family_income',
        'source_is_uni_fast',
        'source_is_other_scholarships',
        'source_is_self_financed',
        'source_is_parent',
        'has_mobile_phone',
        'has_laptop',
        'has_tablet',
        'has_desktop',
        'other_gadgets',
        'candidate_status',
    ];

    protected $casts = [
        'is_first_generation_group' => 'boolean',
        'is_indigenous_people_group' => 'boolean',
        'is_person_with_disability_group' => 'boolean',
        'is_solo_parent_group' => 'boolean',
        'is_person_with_special_needs_group' => 'boolean',
        'source_is_uni_fast' => 'boolean',
        'source_is_other_scholarships' => 'boolean',
        'source_is_self_financed' => 'boolean',
        'source_is_parent' => 'boolean',
        'has_mobile_phone' => 'boolean',
        'has_laptop' => 'boolean',
        'has_tablet' => 'boolean',
        'has_desktop' => 'boolean',
    ];

    public function admission()
    {
        return $this->hasMany(Admission::class, 'candidate_id', 'id');
    }

    public function information()
    {
        return $this->belongsTo(Information::class, 'information_id', 'id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'candidate_id', 'id');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'candidate_id', 'id');
    }
}
