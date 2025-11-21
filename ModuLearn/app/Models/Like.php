<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'user_id',
        'module_id',
    ];

    public $timestamps = true; // karena tabel memiliki created_at

    // 1 like dimiliki oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 like mengarah ke 1 module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
