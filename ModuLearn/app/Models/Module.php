<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'category_id',
        'title',
        'description',
    ];

    /**
     * Relasi: Module dimiliki oleh 1 Mentor (User)
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * Relasi: Module dimiliki oleh 1 Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: Module memiliki banyak Submodule
     */
    public function submodules()
    {
        return $this->hasMany(Submodule::class);
    }

    /**
     * Relasi: Module memiliki banyak Likes
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
