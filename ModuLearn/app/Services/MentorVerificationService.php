<?php

namespace App\Services;

use App\Models\MentorVerification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MentorVerificationService
{
    /**
     * User mengirim request untuk jadi mentor
     */
    public function submitRequest(User $user, array $data)
    {
        return MentorVerification::create([
            'user_id' => $user->id,
            'document_url' => $data['document_url'],
            'status' => 'pending',
        ]);
    }

    /**
     * Admin menyetujui permintaan
     */
    public function approveVerification(MentorVerification $verification)
    {
        return DB::transaction(function () use ($verification) {
            $verification->update([
                'status' => 'approved',
            ]);

            // Update role user menjadi mentor
            $verification->user->update([
                'role' => 'mentor',
            ]);

            return $verification;
        });
    }

    /**
     * Admin menolak permintaan
     */
    public function rejectVerification(MentorVerification $verification, string $reason = null)
    {
        return $verification->update([
            'status' => 'rejected',
            'reject_reason' => $reason,
        ]);
    }
}
