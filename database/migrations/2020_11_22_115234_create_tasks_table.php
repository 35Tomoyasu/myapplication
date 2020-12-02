<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->string('contents');
            $table->dateTime('finish_date');
            $table->integer('status')->comment('1は完了、２は着手、３は未着手');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            // 外部キーはtimestamps();の下に書くと見やすい
            $table->unsignedBigInteger('folder_id');
            $table->foreign('folder_id')->references('id')->on('folders');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
