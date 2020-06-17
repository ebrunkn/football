<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'model', 'action', 'log',
    ];

    public function admin(){
        return $this->belongsTo('App\Models\Admin','admin_id','id');
    }
}
