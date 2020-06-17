<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppLog;
use App\Models\Helper\ThemeFallBack;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request){
        $data_bundle = [];
        $data_bundle['logs'] = AppLog::paginate(20);
        return view(ThemeFallBack::fallBack('logs'), compact('data_bundle'));
    }
}
