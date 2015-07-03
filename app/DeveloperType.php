<?php

namespace PeerReview;

use Illuminate\Database\Eloquent\Model;

class DeveloperType extends Model
{
    public function developers()
    {
        return $this->hasMany('PeerReview\Developers');
    }
}
