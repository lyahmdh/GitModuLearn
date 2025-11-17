<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'course_id',
        'mentor_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function submodules()
    {
        return $this->hasMany(Submodule::class);
    }

    public function likes()
    {
        return $this->hasMany(ModuleLike::class);
    }
}
