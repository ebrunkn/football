<?php

namespace App\Http\Controllers\API;

use App\Events\PlayerLogReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubstitutePlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request, $teamId=false){
        $players = PlayerResource::collection(Player::ofTeam($teamId)->get());
        return $players;
    }

    public function substituteSave(SubstitutePlayerRequest $request){

        $validated = $request->validated();
        
        $main_player = Player::where('type', Player::MAIN_PLAYER)
                        ->where('id', $validated['main_player'])
                        ->first();

        $sub_player  = Player::ofTeam($main_player->team['id'] ?? null)
                        ->where('type', Player::SUB_PLAYER)
                        ->where('id',$validated['sub_player'])
                        ->first();

        // dd($main_player->team['id']);

        if(!$main_player || !$sub_player){
            return response()->json([
                'status' => false,
                'message' => 'Bad request',
            ], 400);
        }

        $main_player->type = Player::SUB_PLAYER;
        $main_player->save();

        $sub_player->type = Player::MAIN_PLAYER;
        $sub_player->save();

        event(new PlayerLogReport($main_player, 'move to substitute (API call)'));
        event(new PlayerLogReport($sub_player, 'move to main (API call)'));

        return response()->json([
            'status' => 'OK',
            'message' => 'Player changed',
        ], 200);
    }
}
