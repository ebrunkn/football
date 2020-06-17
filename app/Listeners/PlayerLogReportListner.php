<?php

namespace App\Listeners;

use App\Events\PlayerLogReport;
use App\Models\AppLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PlayerLogReportListner
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
     * @param  PlayerLogReport  $event
     * @return void
     */
    public function handle(PlayerLogReport $event)
    {
        AppLog::create([
            'admin_id' => auth()->guard('admin')->user()->id ?? auth()->guard('adminapi')->user()->id ?? null,
            'model' => 'Player',
            'action' => collect($event)['action'] ?? null,
            'log' => collect($event),
        ]);
    }
}
