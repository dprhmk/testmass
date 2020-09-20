<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Test; //Модель

use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function getAllTests()
    {

        //$tests  = Test::all();

        //$tests->load('questions');


        $tests  = Test::with('questions.answers')->get(); //Показ вже створених опитувальників з витаннями і відповідями


        return response()->json($tests, 200);
    }
}
