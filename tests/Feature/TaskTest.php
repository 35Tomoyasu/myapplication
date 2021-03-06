<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュして
    // マイグレーションを再実行する
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    /**
     * 期限が日時ではない場合はバリデーションエラー
     * @test
     */
    public function finish_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'name' => 'Sample task',
            'finish_date' => 123,
        ]);

        $response->assertSessionHasErrors([
            'finish_date' => '期限 には日時を入力してください。',
        ]);
    }

    /**
     * 期限が過去の場合はバリデーションエラー
     * @test
     */
    public function finish_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'name' => 'Sample task',
            'finish_date' => Carbon::yesterday()->format('Y/m/d'),
        ]);

        $response->assertSessionHasErrors([
            'finish_date' => '期限 には今日以降の日時を入力してください。',
        ]);
    }

    /**
     * 状態が定義された値ではない場合はバリデーションエラー
     * @test
     */
    public function status_should_be_within_defined_numbers()
    {
        $this->seed('TasksTableSeeder');

        $response = $this->post('/folders/1/tasks/1/edit', [
            'name' => 'Sample task',
            'finish_date' => Carbon::today()->format('Y/m/d'),
            'status' => 999,
        ]);

        $response->assertSessionHasErrors([
            'status' => '状態 には 未着手、着手中、完了 のいずれかを指定してください。',
        ]);
    }
}