<?php

namespace App\Models;

use App\Scopes\DescendOrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;

class Player extends Model
{
    const ACTIVE = 1;
    const BLOCK = 0;

    const MAIN_PLAYER = 1;
    const SUB_PLAYER = 2;

    use SoftDeletes;

    protected $fillable = ['team_id', 'name', 'type', 'active'];

    protected static function booted()
    {
        static::addGlobalScope(new DescendOrderScope);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeUnassigned($query){
        return $query->whereNull('team_id'); 
    }

    public function scopeMainPlayers($query){
        return $query->where('type', Self::MAIN_PLAYER); 
    }

    public function scopeSubPlayers($query){
        return $query->where('type', Self::SUB_PLAYER); 
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

    public function getPlayerTypeLabelAttribute(){
        $label = 'NA';
        if($this->type == Self::MAIN_PLAYER){
            $label = 'Main';
        }elseif($this->type == Self::SUB_PLAYER){
            $label = 'Sub';
        }
        return $label;
    }

    public function team(){
        return $this->belongsTo('App\Models\Team','team_id','id');
    }
}
