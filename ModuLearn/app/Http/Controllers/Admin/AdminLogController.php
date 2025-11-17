<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;

class AdminLogController extends Controller
{
    public function index()
    {
        $logs = AdminLog::with('admin')->orderBy('created_at', 'desc')->get();
        return view('admin.logs.index', compact('logs'));
    }
}
