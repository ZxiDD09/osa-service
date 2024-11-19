<?php

namespace App\Models;

use App\Traits\UuidPrimaryKeyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Course extends Model
{
    use HasFactory, Searchable, UuidPrimaryKeyable;

    protected $fillable = [
        'name',
        'department_id',
        'school_year_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'course_id', 'id');
    }
}
