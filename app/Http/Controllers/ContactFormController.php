<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;//ContactFormモデルを呼び出し保存する為、クラス名でありファイル名でもある
use Illuminate\Support\Facades\DB;// クエリビルダを使用するためのファサード表記

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // エロクワント　ORマッパー
        // $contacts = ContactForm::all();
        // これだと必要無いデータも一括で取得してしまう

        // クエリビルダ
        $contacts = DB::table('contact_forms')
        ->select('id', 'your_name', 'title', 'created_at')
        ->orderby('created_at', 'desc')
        ->get();
        return view('contact.index', compact('contacts'));
        // compactでビューへ変数を渡す
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//Requestクラスを使ってデータを持ってくる(RequestはRequestクラスをインスタンス化したもの)＝(DI:依存性の注入)
    //Requestは5行目で生成したクラスのインスタンスであり,引数にして呼び出している
    {
        $contact = new ContactForm;// 保存するモデルのインスタンスを作成
        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();//保存
        return redirect('contact/index');

        // dd($your_name, $title, $email, $url, $gender, $age, $contact);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = ContactForm::find($id);
        if($contact->gender === 0){
            $gender = '男性';
        }
        if($contact->gender === 1){
            $gender = '女性';
        }
        if($contact->age === 1){
            $age = '~19歳';
        }
        if($contact->age === 2){
            $age = '20~29歳';
        }
        if($contact->age === 3){
            $age = '30~39歳';
        }
        if($contact->age === 4){
            $age = '40~49歳';
        }
        if($contact->age === 5){
            $age = '50~59歳';
        }
        if($contact->age === 6){
            $age = '60歳~';
        }

        return view('contact.show', compact('contact', 'gender', 'age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = ContactForm::find($id);
        return view('contact.edit', compact('contact'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
