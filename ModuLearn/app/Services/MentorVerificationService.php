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
    public function submitRequest(User $user, string $documentUrl): MentorVerification
    {
        return MentorVerification::create([
            'user_id' => $user->id,
            'document_url' => $documentUrl,
            'status' => 'pending',
        ]);
    }

    /**
     * Admin menyetujui permintaan
     */
    public function approveVerification(MentorVerification $verification): MentorVerification
    {
        return DB::transaction(function () use ($verification) {
            $verification->update([
                'status' => 'approved',
            ]);

            // Update role user menjadi mentor
            $user = $verification->user;
            $user->update(['role' => 'mentor']);

            // refresh session jika user ini sedang login
            if (auth()->id() === $user->id) {
                auth()->user()->role = 'mentor';
                session()->put('role', 'mentor');
            }


            return $verification;
        });
    }

    /**
     * Admin menolak permintaan
     */
    public function rejectVerification(MentorVerification $verification, string $reason = null): MentorVerification
    {
        $verification->update([
            'status' => 'rejected',
            'reject_reason' => $reason,
        ]);

        return $verification;
    }

    /**
     * Ambil semua request verifikasi mentor yang statusnya pending
     */
    public function getPending()
    {
        return MentorVerification::with('user')
            ->where('status', 'pending')
            ->get();
    }
}
