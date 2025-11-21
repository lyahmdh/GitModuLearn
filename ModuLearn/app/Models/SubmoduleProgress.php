<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmoduleProgress extends Model
{
    use HasFactory;

    protected $table = 'submodule_progress';

    protected $fillable = [
        'user_id',
        'submodule_id',
        'status', // 'done' per ERD; you can change to boolean if preferred
    ];

    protected $casts = [
        // if you use boolean instead of enum, adjust accordingly
    ];

    /* -------------------------
     | Relationships
     |------------------------- */

    /**
     * Progress belongs to a Submodule.
     */
    public function submodule()
    {
        return $this->belongsTo(Submodule::class);
    }

    /**
     * Progress belongs to a User (mentee).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* -------------------------
     | Helper methods (optional)
     |------------------------- */

    /**
     * Mark (or toggle) submodule as done for a user.
     * Use updateOrCreate so repeated marks won't duplicate rows.
     *
     * @param int $userId
     * @param int $submoduleId
     * @return \App\Models\SubmoduleProgress
     */
    public static function markDone(int $userId, int $submoduleId): self
    {
        return self::updateOrCreate(
            ['user_id' => $userId, 'submodule_id' => $submoduleId],
            ['status' => 'done']
        );
    }
}
