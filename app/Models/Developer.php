<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['firstName', 'middleName', 'lastName', 'gitHubHandle', 'type_id'];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function levels()
    {
        return $this->belongsToMany('App\Models\Level');
    }
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill');
    }

    public function getFullNameAttribute()
    {
        return implode(' ', array_filter([$this->firstName, $this->middleName, $this->lastName]));
    }

    public function getLevelsStringAttribute()
    {
        return implode('/', $this->levels()->lists('level')->all());
    }
    public function getSkillsStringAttribute()
    {
        return implode(', ', $this->skills()->lists('skill')->all());
    }
}
