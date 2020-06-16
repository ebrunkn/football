<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeamImport;
use App\Imports\PlayerImport;
use App\Models\Helper\ThemeFallBack;
use Illuminate\Http\Request;

class DataImportController extends Controller
{
    public function import(Request $request, $type) 
    {
        return view(ThemeFallBack::fallBack('import.file-upload'));
    }
    public function downloadSample(Request $request, $type) 
    {
        if($type == 'players'){
            $sample = storage_path('app\public\players-sample.xlsx');
            return response()->download($sample, 'Players Excel Template.xlsx');
        }else{
            $sample = storage_path('app\public\teams-sample.xlsx');
            return response()->download($sample, 'Team Excel Template.xlsx');
        }
    }
    public function importToDB(FileImportRequest $request, $type) 
    {
        if($type == 'players'){
            Excel::import(new PlayerImport, $request->file('data_file'));
        }else {
            Excel::import(new TeamImport, $request->file('data_file'));
        }
        return redirect()->back()->with('form-save', true);
    }
}
