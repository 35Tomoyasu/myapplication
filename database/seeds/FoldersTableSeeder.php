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
        $names = ['プログラミング','趣味','就活'];

        foreach ($names as $name) {
            DB::table('folders')->insert([
                'name' => $name,
                // 'created_by' => 不明
                // 'updated_by' => 不明
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
