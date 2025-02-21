<?php

namespace App\Models;

use App\Traits\UuidPrimaryKeyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Student extends Model
{
    use HasFactory, Searchable, UuidPrimaryKeyable;

    protected $fillable = [
        'user_id',
        'password_string',
        'student_id',
        'candidate_id',
        'section_id',
    ];

    protected $with = [
        'section',
        'candidate.information',
    ];

    protected $appends = [
        'average_grade',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            $student->student_id = Str::uuid();
        });
    }

    public function getAverageGradeAttribute()
    {
        return $this->admissions->avg('gpa') ?? 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'id', 'candidate_id');
    }

    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'section_id');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'candidate_id', 'candidate_id');
    }
}
