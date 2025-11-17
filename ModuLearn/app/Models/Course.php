<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'created_by',
    ];

    // Auto generate slug if empty
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->name);
            }
        });
    }

    /**
     * Relasi: Course memiliki banyak Module
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    /**
     * Relasi: Course dibuat oleh Admin (optional)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
