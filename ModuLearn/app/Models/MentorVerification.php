<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MentorVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_path',
        'status', // pending, approved, rejected
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
