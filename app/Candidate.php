<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['name', 'email', 'age', 'url_linkedin'];

    public function Technologies()
    {
        return $this->belongsToMany(Technology::class, 'candidate_technology');
    }

    public function getTechnologiesAttribute()
    {
        return $this->Technologies;
    }


}
