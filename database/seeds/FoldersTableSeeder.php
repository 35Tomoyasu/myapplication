<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first();

        $names = ['プログラミング','趣味','就活'];

        foreach ($names as $name) {
            DB::table('folders')->insert([
                'name' => $name,
                'created_by' => '',
                'updated_by' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                // user_idとフォルダを紐付ける
                'user_id' => $user->id,
            ]);
        }
    }
}
