<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PushLog;
use App\Models\PushToken;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalTokens' => PushToken::where('ativo', true)->count(),
            'totalPush' => PushLog::count(),
            'ultimoPush' => PushLog::orderByDesc('id')->first(),
        ]);
    }
}