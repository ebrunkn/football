<?php

namespace App\Listeners;

use App\Events\LoginLogReport;
use App\Models\AppLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginLogReportListner
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
     * @param  LoginLogReport  $event
     * @return void
     */
    public function handle(LoginLogReport $event)
    {
        AppLog::create([
            'admin_id' => auth()->guard('admin')->user()->id ?? null,
            'model' => 'Admin',
            'action' => collect($event)['action'] ?? null,
            'log' => collect($event),
        ]);
    }
}
