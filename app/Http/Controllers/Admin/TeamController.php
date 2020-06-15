<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Models\AppLog;
use App\Models\Helper\ThemeFallBack;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
}
