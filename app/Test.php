<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }


    //Зв'язок через модель Тестів з Відповідями через Питання
    public function answers()
    {
        return $this->hasOneThrough(Answer::class, Question::class);
    }

    //public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
    ];
}
