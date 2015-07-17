<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function developers()
    {
        return $this->hasMany('App\Models\Developer');
    }

    public function peerReview()
    {
        return $this->hasOne('App\Models\PeerReview');
    }
}
