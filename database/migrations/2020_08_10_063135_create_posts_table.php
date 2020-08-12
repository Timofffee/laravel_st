<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');  # Заголовок
            $table->text('message');    # Текст комментария
            $table->unsignedBigInteger('user_id');  # Где
            $table->unsignedBigInteger('owner');    # Владелец комментария
            $table->boolean('deleted')->default(false); # Удалён ли комментарий? (Только для родителей)
            $table->unsignedBigInteger('parent_id')->nullable(); # Родительский комментарий
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
