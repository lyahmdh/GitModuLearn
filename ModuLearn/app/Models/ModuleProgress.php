<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'submodule_id',
        'status', // done or in-progress
    ];

    public function submodule()
    {
        return $this->belongsTo(Submodule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
