<?php

namespace App\Models;

use App\Traits\UuidPrimaryKeyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SchoolYear extends Model
{
    use HasFactory, Searchable, UuidPrimaryKeyable;

    protected $fillable = ['name', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class, 'school_year_id', 'id');
    }
}
