<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    use HasFactory;

    protected $table = 'submodules';

    protected $fillable = [
        'module_id',
        'title',
        'content_type',
        'content_url',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /* -------------------------
     | Relationships
     |------------------------- */

    /**
     * Submodule belongs to one Module.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * A submodule has many progress records (one per user who marks it).
     */
    public function progress()
    {
        return $this->hasMany(SubmoduleProgress::class);
    }

    /* -------------------------
     | Helper methods (optional)
     |------------------------- */

    /**
     * Check if a given user has marked this submodule as done.
     *
     * @param \App\Models\User|int $user
     * @return bool
     */
    public function isDoneBy($user): bool
    {
        $userId = $user instanceof \App\Models\User ? $user->id : $user;
        return $this->progress()->where('user_id', $userId)->exists();
    }
}
