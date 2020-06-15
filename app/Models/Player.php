<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'active'];

    public function team(){
        return $this->belongsTo('App\Team','id','team_id');
    }
}
