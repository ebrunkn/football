<?php

namespace App\Http\Controllers\Admin;

use App\Events\AppLogReport;
use App\Events\PlayerLogReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Http\Requests\SubstitutePlayerRequest;
use App\Models\AppLog;
use App\Models\Helper\ThemeFallBack;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Testing\Constraints\ArraySubset;
use PhpParser\Builder\Class_;

class PlayerController extends Controller
{
    public function index(Request $request, $teamId=false){
        $data_bundle = [];
        $data_bundle['players'] = Player::ofTeam($teamId)->paginate(20);
        $data_bundle['allowed_players'] = Team::TOTAL_PLAYERS;
        return view(ThemeFallBack::fallBack('player.index'), compact('data_bundle'));
    }

    public function add(Request $request){
        $data_bundle = [];
        $data_bundle['teams'] = Team::active()->get();
        $data_bundle['teams'] = $data_bundle['teams']->where('total_players','<', Team::TOTAL_PLAYERS)->pluck('name','id');
        return view(ThemeFallBack::fallBack('player.add'), compact('data_bundle'));
    }

    public function edit(Request $request, $id){
        $data_bundle = [];
        $data_bundle['player'] = Player::findOrFail($id);
        $data_bundle['teams'] = Team::active()->get();
        $data_bundle['teams'] = $data_bundle['teams']->where('total_players','<', Team::TOTAL_PLAYERS)->pluck('name','id');
        return view(ThemeFallBack::fallBack('player.edit'), compact('data_bundle'));
    }

    public function save(PlayerRequest $request, $id = false)
    {
            if($request->input('team')){
                $players = Player::where('team_id',$request->input('team'))->get();
                $totalPlayers = $players->count();
                $typePlayers = $players->where('type', $request->input('type'))->count();
                
                if($request->input('type') == 1){
                    $typeMaxCount = Team::MAIN_PLAYERS;
                }else{
                    $typeMaxCount = Team::SUB_PLAYERS;
                }
                if($totalPlayers >= Team::TOTAL_PLAYERS || $typePlayers >= $typeMaxCount){
                    return response()->json([
                        'code' => 406,
                        'status' => 'OK',
                        'message' => 'Maximum number of players reached',
                    ], 406);
                }
            }
            

            $player = Player::updateOrCreate(
                ['id' => $id],
                [
                    'team_id' => $request->input('team'),
                    'name' => $request->input('name'),
                    'type' => $request->input('type') ?? null,
                    'active' => $request->input('status'),
                ]
            );
            
            event(new PlayerLogReport($player, $id ? 'edit' : 'create'));

            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Saved',
            ], 200);
    
    }

    public function delete(Request $request, $id){
        $player = Player::findOrFail($id);
        Player::destroy($id);
        event(new PlayerLogReport($player, 'delete'));
        return redirect()->back()->with('item-delete', true);
    }

    public function substitute(Request $request, $playerId){
        $data_bundle['player'] = Player::where('type', Player::MAIN_PLAYER)->findOrFail($playerId);
        $data_bundle['sub_players']  = Player::where('team_id', $data_bundle['player']->team['id'])->subPlayers()->pluck('name','id');
        return view(ThemeFallBack::fallBack('player.substitute'), compact('data_bundle'));
    }

    public function substituteSave(SubstitutePlayerRequest $request){

        $validated = $request->validated();
        $main_player = Player::findOrFail($validated['main_player']);
        $sub_player  = Player::findOrFail($validated['sub_player']);

        $main_player->type = Player::SUB_PLAYER;
        $main_player->save();

        $sub_player->type = Player::MAIN_PLAYER;
        $sub_player->save();

        event(new PlayerLogReport($main_player, 'move to substitute'));
        event(new PlayerLogReport($sub_player, 'move to main'));

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'Player changed',
        ], 200);
    }
    
}
