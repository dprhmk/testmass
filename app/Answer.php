<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    //public $timestamps = false;

    protected $fillable = [
        'question_id',
        'body',
    ];
}
