<?php

namespace App\Services;

use App\Models\SubmoduleProgress;

class SubmoduleProgressService
{
    public function markDone(int $userId, int $submoduleId)
    {
        return SubmoduleProgress::updateOrCreate(
            [
                'user_id' => $userId,
                'submodule_id' => $submoduleId
            ],
            [
                'status' => 'done'
            ]
        );
    }
}
