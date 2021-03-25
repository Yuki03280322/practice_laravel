<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;//ContactFormモデルを呼び出し保存する為、クラス名でありファイル名でもある
use Illuminate\Support\Facades\DB;// クエリビルダを使用するためのファサード表記
use App\Services\CheckFormData;// ファットコントローラー防止の為、別ファイルに記載したプログラムを呼び出し
use App\Http\Requests\StoreContactForm;//バリデーションを記入したファイルの呼び出し

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)//検索フォームから値を持ってくる必要があるためRequestクラスのインスタンスでデータを持ってくる
    {
        $search = $request->input('search');
        // エロクワント　ORマッパー
        // $contacts = ContactForm::all();
        // これだと必要無いデータも一括で取得してしまう

        // $contacts = DB::table('contact_forms')
        // ->select('id', 'your_name', 'title', 'created_at')
        // ->orderby('created_at', 'desc')
        // ->paginate(20);
        // return view('contact.index', compact('contacts'));
        // compactでビューへ変数を渡す

        // 検索フォーム
        $query = DB::table('contact_forms');
        // もしキーワードがあったら
        if($search !== null){
            $search_split = mb_convert_kana($search,'s');//全角スペースを半角に
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);//空白で区切る
            foreach($search_split2 as $value)
            {
                $query->where('your_name', 'like', '%'.$value.'%');//SQLの書き方
            }
        }
        $query->select('id', 'your_name', 'title', 'created_at');
        $query->orderBy('created_at', 'asc');
        $contacts = $query->paginate(20);

        return view('contact.index', compact('contacts'));
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
    public function store(StoreContactForm $request)//Requestクラスを使ってデータを持ってくる(RequestはRequestクラスをインスタンス化したもの)＝(DI:依存性の注入)
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
        $gender = CheckFormData::checkGender($contact);//CheckFormDataのcheckGenderメソッドに$contactを渡し結果を変数へ
        $age = CheckFormData::checkAge($contact);
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
        $contact = ContactForm::find($id);
        // $contact = new ContactForm;newではなく既に存在しているものを持ってくる
        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();
        return redirect('contact/index');

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
        $contact = ContactForm::find($id);
        $contact->delete();

        return redirect('contact/index');
    }
}
