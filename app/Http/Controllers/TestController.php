<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Test;

use Illuminate\Support\Facades\DB; // クエリビルダを使用するためのDBファサードであり、最終的な結果をgetで取得する
// ファサード:入り口。アクセスするための場所を1つにしておいてそこにアクセスすることで中の様々なシステムを利用できるようにしたもの
// ファサードのファイルはvender/laravel/framework/src/Facadesに全て格納されている

class TestController extends Controller
{
    //
    public function index()
    {
        $values = Test::all();
        $tests = DB::table('tests')// Test::all()より取得する情報量は少ない（必要なものだけ取得している）
        ->select('id')
        ->get();
        dd($tests);
        // dd(die+var_dump)コマンド,処理を止めて変数の中身を表示する,DBからデータ取得時はコレクション型になる
        // クエリビルダ:SQLに近い構文をPHPで書けるようにしたものでありSQLインジェクション攻撃から守るためにPDOパラメーターによるバインディングを使用
        // 細かい条件指定でDBから情報を得たいときにはクエリビルダを使用する
        // getの前にメソッドチェーンを組むことで簡単に見やすく取得することが可能
        
        // chunkメソッド:コレクションを指定したサイズで複数の小さなコレクションに分割
        // $collection = collect([1, 2, 3, 4, 5, 6, 7]);
        // $chunks = $collection->chunk(4);
        // $chunks->toArray();
        // dd($chunks);

        return view('tests.test', compact('values'));// compact関数＋変数で複数の変数でもまとめて渡すことができる
    }
}
