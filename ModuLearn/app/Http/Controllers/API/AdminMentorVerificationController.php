<?php

namespace App\Http\API\Controllers;

use App\Models\MentorVerification;
use Illuminate\Http\Request;
use App\Services\MentorVerificationService;

class AdminMentorVerificationController extends Controller
{
    protected $service;

    public function __construct(MentorVerificationService $service)
    {
        $this->service = $service;
    }

    /**
     * Admin melihat semua request verifikasi mentor
     */
    public function index()
    {
        return MentorVerification::with('user')->get();
    }

    /**
     * Admin menyetujui verifikasi mentor
     */
    public function approve($id)
    {
        $verification = MentorVerification::findOrFail($id);

        $this->service->approveVerification($verification);

        return response()->json([
            'message' => 'Verifikasi mentor disetujui.',
            'data' => $verification
        ]);
    }

    /**
     * Admin menolak verifikasi mentor
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'nullable|string|max:255'
        ]);

        $verification = MentorVerification::findOrFail($id);

        $this->service->rejectVerification($verification, $request->reason);

        return response()->json([
            'message' => 'Verifikasi mentor ditolak.',
            'data' => $verification
        ]);
    }
}
