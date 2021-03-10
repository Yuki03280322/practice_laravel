<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);//複数のシーダーファイルはこのDatabasaSeederから引っ張ってくるのでこのファイルと紐付ける必要あり
        $this->call(ContactFormSeeder::class);

        // $this->call({
        //     UserTableSeeder::class,
        //     ContactFormSeeder::class,
        // });
    }
}
