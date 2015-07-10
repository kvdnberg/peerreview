<?php

namespace PeerReview;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function developers()
    {
        return $this->hasMany('PeerReview\Developer');
    }
}
