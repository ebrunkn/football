<?php

namespace App\Imports;

use App\Models\Team;
use Carbon\Carbon;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class TeamImport implements OnEachRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function onRow(Row $row)
    {
        // dd($row);

        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        
        $status_label = ['block'=>0, 'active'=>1];
        
        if(isset($row[0]) && $rowIndex > 0 && $row[0] != 'Team Name'){
            // dd($rowIndex);
            Team::create([
                'name' => $row[0],
                'active' => $status_label[trim(strtolower($row[1])) ?? 'block'] ?? 0,
            ]);
        }
    }
}
