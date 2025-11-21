<?php

namespace App\Http\Controllers;

use App\Models\MentorVerification;
use Illuminate\Http\Request;
use App\Services\MentorVerificationService;

class MentorVerificationController extends Controller
{
    protected $service;

    public function __construct(MentorVerificationService $service)
    {
        $this->service = $service;
    }

    /**
     * User submit request verifikasi mentor
     */
    public function store(Request $request)
    {
        $request->validate([
            'document_url' => 'required|string|max:255'
        ]);

        $verification = $this->service->submitRequest(
            $request->user(),
            $request->only(['document_url'])
        );

        return response()->json([
            'message' => 'Request verifikasi mentor berhasil dikirim.',
            'data' => $verification
        ]);
    }

    /**
     * User melihat semua riwayat request verifikasi dirinya
     */
    public function index(Request $request)
    {
        $verifications = MentorVerification::where('user_id', $request->user()->id)->get();

        return response()->json($verifications);
    }
}
