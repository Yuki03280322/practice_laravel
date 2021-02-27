<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Test;

class TestController extends Controller
{
    //
    public function index()
    {
        $values = Test::all();
        // dd(die+var_dump)コマンド,処理を止めて変数の中身を表示する
        // dd($value);

        return view('tests.test', compact('values'));// compact関数＋変数で複数の変数でもまとめて渡すことができる
    }
}
