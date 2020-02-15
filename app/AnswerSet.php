<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerSet extends Model
{
    protected $guarded = [];

    function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
