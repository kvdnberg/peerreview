<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function developers()
    {
        return $this->hasMany('App\Developer');
    }
}
