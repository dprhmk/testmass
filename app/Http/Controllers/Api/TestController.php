<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Test;

//Модель

use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function getAllTests()
    {
        //$tests  = Test::all();

        //$tests->load('questions');

        $tests = Test::with('questions.answers')->get(); //Показ вже створених опитувальників з питаннями і відповідями

        return response()->json($tests, 200);
    }

    public function getSector()
    {
        $tests_count = Test::all()->count(); //Кіл-ть всіх опитувальників

        $tests_answers_count = Test::whereHas('questions.answers', function ($q) {
            $q->where('id', '!=', null);
        })->count(); //Кіл-ть всіх опитувальників з відповідями

        return response()->json(['Count of all tests' => $tests_count, 'Count of all tests with answers' => $tests_answers_count], 200);
    }
}
