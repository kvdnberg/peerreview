<?php

namespace PeerReview;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['firstName', 'middleName', 'lastName', 'gitHubHandle', 'type_id'];

    public function type()
    {
        return $this->belongsTo('PeerReview\Type');
    }

    public function levels()
    {
        return $this->belongsToMany('PeerReview\Level');
    }
    public function skills()
    {
        return $this->belongsToMany('PeerReview\Skill');
    }

    public function getFullNameAttribute()
    {
        return implode(' ', [$this->firstName, $this->middleName, $this->lastName]);
    }
}
