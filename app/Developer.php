<?php

namespace PeerReview;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['firstName', 'middleName', 'lastName', 'gitHubHandle'];

    public function developerType()
    {
        return $this->hasOne('PeerReview\DeveloperType');
    }

    public function getFullNameAttribute()
    {
        return implode(' ', [$this->firstName, $this->middleName, $this->lastName]);
    }
}
