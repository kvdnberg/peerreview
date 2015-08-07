<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['skill'];
    public function developers()
    {
        return $this->belongsToMany('App\Models\Developer');
    }


}
