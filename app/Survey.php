<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    function questions()
    {
        return $this->hasMany(Question::class);
    }

    function answer_sets()
    {
        return $this->hasMany(AnswerSet::class);
    }
}
