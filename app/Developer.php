<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['firstName', 'middleName', 'lastName', 'gitHubHandle', 'type_id'];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function levels()
    {
        return $this->belongsToMany('App\Level');
    }
    public function skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public function getFullNameAttribute()
    {
        return implode(' ', [$this->firstName, $this->middleName, $this->lastName]);
    }

    public function getLevelsStringAttribute()
    {
        return implode('/', $this->levels()->lists('level'));
    }
    public function getSkillsStringAttribute()
    {
        return implode(', ', $this->skills()->lists('skill'));
    }
}
