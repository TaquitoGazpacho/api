<?php

use Illuminate\Database\Seeder;

class UserApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usersApi')->insert([
            'name' => 'api',
            'email' =>'api@api.com',
            'token' => base64_encode('api@api.com')
        ]);
    }
}
