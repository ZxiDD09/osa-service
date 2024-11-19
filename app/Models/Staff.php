<?php

namespace App\Models;

use App\Traits\UuidPrimaryKeyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Staff extends Model
{
    use HasFactory, Searchable, UuidPrimaryKeyable;

    protected $fillable = [
        'title',
        'position',
        'information_id',
        'user_id',
    ];

    public function information()
    {
        return $this->belongsTo(Information::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
