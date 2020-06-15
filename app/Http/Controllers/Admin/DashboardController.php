<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helper\ThemeFallBack;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data_bundle = [];
        return view(ThemeFallBack::fallBack('dashboard.index'), compact('data_bundle'));
    }

    public function ajaxData(Request $request)
    {
        $data = [];

        $players = Player::get();
        $teams = Team::get();


        $data['players']['total'] = $players->count(); 
        $data['players']['active'] = $players->where('active',1)->count(); 
        $data['players']['inactive'] = $players->where('active',0)->count(); 
        $data['players']['on_team'] = $players->where('team_id',null)->count(); 
        $data['players']['not_in_team'] = $players->where('team_id','!=',null)->count(); 

        $data['teams']['total'] = $teams->count(); 
        $data['teams']['active'] = $teams->where('active',1)->count(); 
        $data['teams']['inactive'] = $teams->where('active',0)->count(); 

        return response()->json([
            'data' => $data,
        ], 200);
    }
}
