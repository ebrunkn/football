<?php

namespace App\Models;

use App\Scopes\DescendOrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;

class Team extends Model
{
    const ACTIVE = 1;
    const BLOCK = 0;
    const TOTAL_PLAYERS = 18;
    const MAIN_PLAYERS = 11;
    const SUB_PLAYERS = 7;

    use SoftDeletes;

    protected $fillable = ['name', 'active'];

    protected static function booted()
    {
        static::addGlobalScope(new DescendOrderScope);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function getTotalPlayersAttribute()
    {
        return $this->players()->count();
    }

    public function getStatusLabelAttribute()
    {
        $label = 'Block';
        if ($this->active == Self::ACTIVE) {
            $label = 'Active';
        }
        return $label;
    }

    public function players()
    {
        return $this->hasMany('App\Models\Player', 'team_id', 'id');
    }
}
