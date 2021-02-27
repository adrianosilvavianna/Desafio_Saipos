<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public function Candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_technology');
    }
}
