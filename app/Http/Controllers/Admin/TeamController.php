<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRequest;
use App\Http\Requests\TeamRequest;
use App\Models\AppLog;
use App\Models\Helper\ThemeFallBack;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeamImport;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function index(Request $request){
        $data_bundle = [];
        $data_bundle['teams'] = Team::paginate(20);
        return view(ThemeFallBack::fallBack('team.index'), compact('data_bundle'));
    }

    public function add(Request $request){
        return view(ThemeFallBack::fallBack('team.add'));
    }

    public function edit(Request $request, $id){
        $data_bundle = [];
        $data_bundle['team'] = Team::findOrFail($id);
        return view(ThemeFallBack::fallBack('team.edit'), compact('data_bundle'));
    }

    public function save(TeamRequest $request, $id = false)
    {
            // $validated = $request->validated();
            $team = Team::updateOrCreate(
                ['id' => $id],
                ['name' => $request->input('name'), 'active' => $request->input('status'),]
            );
            AppLog::create(array(
                'admin_id' => auth()->guard('admin')->user()->id,
                'model' => 'Team',
                'action' => $id ? 'Edit' : 'Create',
                'log' => $team,
            ));
            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Saved',
            ], 200);
    
    }

    public function delete(Request $request, $id){
        Team::destroy($id);
        return redirect()->back()->with('item-delete', true);
    }

    public function assign(Request $request, $teamId=false){
        $data_bundle = [];
        if($teamId){
            $data_bundle['team']  = Team::findOrFail($teamId);
        }else{
            $data_bundle['teams']  = Team::pluck('name','id');
        }
        $data_bundle['players']  = Player::unassigned()->pluck('name','id');

        return view(ThemeFallBack::fallBack('team.assign'), compact('data_bundle'));
        // return redirect()->back()->with('item-delete', true);
    }

    public function assignSave(AssignRequest $request){

        $validated = $request->validated();

        $player = Player::unassigned()->where('id', $validated['player'])->first();
        $team = Team::where('id', $validated['team'])->first();

        if($team && $player){
            $player->team_id = $team->id;
            $player->save();

            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Saved',
            ], 200);

        }else{
            return response()->json([
                'code' => 403,
                'status' => 'Error',
                'message' => 'Data conflict',
            ], 403);
        }
        
        
    }
    public function import() 
    {
        return view(ThemeFallBack::fallBack('import.file-upload'));
    }
    public function downloadSample() 
    {
        $sample = storage_path('app\public\teams-sample.xlsx');
        return response()->download($sample, 'Team Excel Template.xlsx');
    }
    public function importToDB(Request $request) 
    {
        Excel::import(new TeamImport, $request->file('data_file'));
        return redirect()->back()->with('success', 'All good!')->with('form-save', true);
    }
    

}
