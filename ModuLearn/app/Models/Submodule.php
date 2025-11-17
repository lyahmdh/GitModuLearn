<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submodule extends Model
{
    use HasFactory;
    protected $table = 'submoduls';

    protected $fillable = [
        'module_id',
        'title',
        'content_type', // pdf or video
        'content_url',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function progress()
    {
        return $this->hasMany(ModuleProgress::class);
    }
}
