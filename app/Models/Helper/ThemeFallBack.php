<?php

namespace App\Models\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

class ThemeFallBack extends Model
{
    public static function fallBack($bladeName)
    {
        $blade = config('app.admin_theme') . '/' . $bladeName;
        if (!View::exists($blade)) {
            return $blade = 'admin.' . $bladeName;
        }
        return $blade;
    }
}
