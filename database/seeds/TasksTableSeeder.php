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
        foreach (range(1, 3) as $num) {
            DB::table('tasks')->insert([
                'name' => "サンプルタスク {$num}",
                'contents' => "サンプル内容",
                'finish_date' => Carbon::now()->addDay($num),
                'priority' => "通常",
                'status' => $num,
                'created_by' => '',
                'updated_by' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'folder_id' => 1,
            ]);
        }
    }
}
