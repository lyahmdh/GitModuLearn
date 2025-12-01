<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Like;

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
        return $this->hasMany(\App\Models\Like::class, 'module_id', 'id');
    }
    
    // Relasi ke User (pemilik/creator modul)
    public function user()
    {
        return $this->belongsTo(User::class, 'mentor_id'); // sesuaikan foreign key
    }

    public function submoduleProgress()
    {
        return $this->hasMany(SubmoduleProgress::class);
    }

}
