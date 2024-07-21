<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //追記　07/10　八木雄太
        DB::table('Users')->insert([
            [
                'username' => '山田一郎',
                'mail' => 'yamada1@Atlas.com',
                'password' => Hash::make('yamada1')
            ]
        ]);
    }
}
