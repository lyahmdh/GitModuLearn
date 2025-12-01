<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * 1 Category memiliki banyak Modules
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
