<?php

namespace App\Listeners;

use App\Events\TeamLogReport;
use App\Models\AppLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TeamLogReportListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AppLogReport  $event
     * @return void
     */
    public function handle(TeamLogReport $event)
    {
        AppLog::create([
            'admin_id' => auth()->guard('admin')->user()->id ?? auth()->guard('adminapi')->user()->id ?? null,
            'model' => 'Team',
            'action' => collect($event)['action'] ?? null,
            'log' => collect($event),
        ]);
        // Log::info(collect($event));
    }
}
