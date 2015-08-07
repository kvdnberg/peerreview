<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function developers()
    {
        return $this->hasMany('App\Models\Developer');
    }

    public function peerReviews()
    {
        return $this->hasMany('App\Models\PeerReview');
    }

}
