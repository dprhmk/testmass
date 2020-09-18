<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    //public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
    ];
}
