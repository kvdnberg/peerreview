<?php

namespace PeerReview;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['firstName', 'middleName', 'lastName', 'gitHubHandle', 'developer_type_id'];

    public function developerType()
    {
        return $this->belongsTo('PeerReview\DeveloperType');
    }

    public function getFullNameAttribute()
    {
        return implode(' ', [$this->firstName, $this->middleName, $this->lastName]);
    }
}
