<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\AppLog;
use App\Models\Helper\ThemeFallBack;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class PlayerController extends Controller
{
    public function index(Request $request, $teamId=false){
        $data_bundle = [];
        $data_bundle['players'] = Player::ofTeam($teamId)->paginate(20);
        return view(ThemeFallBack::fallBack('player.index'), compact('data_bundle'));
    }

    public function add(Request $request){
        $data_bundle = [];
        $data_bundle['teams'] = Team::pluck('name','id');
        return view(ThemeFallBack::fallBack('player.add'), compact('data_bundle'));
    }

    public function edit(Request $request, $id){
        $data_bundle = [];
        $data_bundle['player'] = Player::findOrFail($id);
        $data_bundle['teams'] = Team::pluck('name','id');
        return view(ThemeFallBack::fallBack('player.edit'), compact('data_bundle'));
    }

    public function save(PlayerRequest $request, $id = false)
    {
            // $validated = $request->validated();
            // dd($request->input('team'));
            $player = Player::updateOrCreate(
                ['id' => $id],
                [
                    'team_id' => $request->input('team'),
                    'name' => $request->input('name'),
                    'active' => $request->input('status'),
                ]
            );
            AppLog::create(array(
                'admin_id' => auth()->guard('admin')->user()->id,
                'model' => 'Player',
                'action' => $id ? 'Edit' : 'Create',
                'log' => $player,
            ));
            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Saved',
            ], 200);
    
    }

    public function delete(Request $request, $id){
        Player::destroy($id);
        return redirect()->back()->with('item-delete', true);
    }
    
}
