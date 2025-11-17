<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_path',    // uploaded pdf path
        'status',           // pending, approved, rejected
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
