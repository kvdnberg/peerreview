<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function developers()
    {
        return $this->hasMany('App\Developers');
    }
}
