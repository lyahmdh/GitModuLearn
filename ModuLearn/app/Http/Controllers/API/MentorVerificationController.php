<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MentorVerification;
use Illuminate\Support\Facades\Auth;
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
            'document' => 'required|file|max:2048'
        ]);

        // Simpan file ke storage/app/public/uploads/docs
        $path = $request->file('document')->store('uploads/docs', 'public');
        
        MentorVerification::create([
            'user_id' => Auth::id(),
            'file_path' => $path,
            'status' => 'pending',
        ]);
      

        return redirect()->back()->with('success', 'File verifikasi berhasil diupload!');
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
