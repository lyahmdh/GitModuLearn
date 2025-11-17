<?php

namespace App\Traits;

use App\Models\AdminLog;

trait AdminActivityLogger
{
    public function logAdminAction($action, $targetType = null, $targetId = null, $description = null)
    {
        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => $action,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'description' => $description,
        ]);
    }
}
