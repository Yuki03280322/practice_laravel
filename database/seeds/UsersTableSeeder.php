<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder //ダミーデータはテーブルごとに作成する
{
    /**
     * Run the database seeds.(データベース初期値設定の実行)
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // 'name' => Str::random(10),
            // 'email' => Str::random(10).'@gmail.com',
            // 'password' => Hash::make('password'),
            [
            'name' => 'あああ',
            'email' => 'test@test.com',
            'password' => Hash::make('password1234'),
            ],
            [
            'name' => 'いいい',
            'email' => 'sample@sample.com',
            'password' => Hash::make('password5678'),
            ],
            [
            'name' => 'ううう',
            'email' => 'test2@test2.com',
            'password' => Hash::make('password123'),
            ]
        ]);
    }
}

//大量のダミーデータを登録するためにlaravelが持つシーダ(初期設定)クラスを使用,artisan make:seederで作成
//シーダークラスを新たにかきあげたら,Composerのオートローダを再生成するためにdump-autoloadコマンドを実行