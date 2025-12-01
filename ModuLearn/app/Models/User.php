<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'institution',
        'interest_field',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return Storage::url($this->profile_photo_path);
        }
    
        return asset('assets/default-profile.png');
    }
    

    public function modules()
    {
        return $this->hasMany(Module::class, 'mentor_id');
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function submoduleProgress()
    {
        return $this->hasMany(SubmoduleProgress::class);
    }
    
    use Notifiable;

    // relasi ke mentor verifications
    public function mentorVerifications()
    {
        return $this->hasMany(MentorVerification::class, 'user_id');
    }
        
}
