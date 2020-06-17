<?php

namespace App\Http\Controllers\API;

use App\Events\PlayerLogReport;
use App\Events\TeamLogReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRequest;
use App\Http\Resources\TeamResource;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request, $teamId=false){
        $teams = TeamResource::collection(Team::get());
        return $teams;
    }

    public function assignSave(AssignRequest $request){

        $validated = $request->validated();

        $player = Player::unassigned()->where('id', $validated['player'])->first();
        $team = Team::where('id', $validated['team'])->first();

        if($team && $player){
            $player->team_id = $team->id;
            $player->save();

            event(new TeamLogReport($team, 'assign (API call)'));
            event(new PlayerLogReport($player, 'assign  (API call)'));

            return response()->json([
                'status' => 'OK',
                'message' => 'Player assigned',
            ], 200);

        }else{
            return response()->json([
                'status' => 'Error',
                'message' => 'Data conflict',
            ], 400);
        }
        
    }
}
