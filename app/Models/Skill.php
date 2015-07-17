<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function developers()
    {
        return $this->hasMany('App\Models\Developer');
    }
}
