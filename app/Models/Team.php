<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['team_id', 'name', 'active'];

    public function players(){
        return $this->hasMany('App\Player','team_id','id');
    }
}
