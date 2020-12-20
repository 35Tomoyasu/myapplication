<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 質問事項
        foreach (range(1, 3) as $num) {
            DB::table('tasks')->insert([
                'name' => "サンプルタスク {$num}",
                'contents' => "サンプル内容",
                'finish_date' => Carbon::now()->addDay($num),
                'status' => $num,
                'created_by' => '',
                'updated_by' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'folder_id' => 1,
                'category_id' => 1,
            ]);
        }
    }
}
