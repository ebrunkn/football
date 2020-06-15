<?php

namespace App\Models;

use App\Scopes\DescendOrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    const ACTIVE = 1;
    const BLOCK = 0;

    use SoftDeletes;

    protected $fillable = ['team_id', 'name', 'active'];

    protected static function booted()
    {
        static::addGlobalScope(new DescendOrderScope);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeOfTeam($query, $teamId){
        if($teamId){
           return $query->where('team_id', $teamId); 
        }
    }

    public function getTotalTeamsAttribute(){
        return $this->teams()->count();
    }

    public function getStatusLabelAttribute(){
        $label = 'Block';
        if($this->active == Self::ACTIVE){
            $label = 'Active';
        }
        return $label;
    }

    public function team(){
        return $this->belongsTo('App\Models\Team','team_id','id');
    }
}
