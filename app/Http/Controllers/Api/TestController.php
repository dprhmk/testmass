<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Test;
use Ulid\Ulid;

class TestController extends Controller
{
    public function getTestByCode($code)
    {
        $test = Test::with('questions')->where('code', '=', $code)->get();

        if (is_null($test)) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }

        return response()->json($test, 200);
    }

    public function createTest(Request $request)
    {
        $ulid = Ulid::generate();
        $code = (string) $ulid;

        $rules = [
            'name' => 'required',
            'body' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $test = Test::create(['name' => $request->input('name'), 'code' => $code]);
        $questions_arr = [];
        foreach ($request->only('body') as $question) {
            $questions_arr['body'] = $question;
        }
        $questions = Test::latest()->first()->questions()->create($questions_arr);
        return response()->json([$test, $questions], 201);
    }

    public function getAllTests()
    {
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

    public function getBar()
    {
        $tests = Test::all();
        $tests_arr = [];
        foreach ($tests as $test) {
            $tests_arr[$test->name] = $test->answers()->count();
        }
        return response()->json($tests_arr, 200); //Назва тесту: кількість відповідей
    }
}
