<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class, 'mentor_id');
    }

    public function mentorVerification()
    {
        return $this->hasOne(MentorVerification::class);
    }

    public function likes()
    {
        return $this->hasMany(ModuleLike::class);
    }

    public function progress()
    {
        return $this->hasMany(ModuleProgress::class);
    }
}
