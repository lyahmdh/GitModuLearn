<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'verification_status',
        'document_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
