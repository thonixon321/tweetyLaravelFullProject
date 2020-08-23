<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //same as the other way where you use references users and cascade on delete
            $table->foreignId('tweet_id')->constrained()->onDelete('cascade');
            $table->boolean('liked'); //0 - dislike, 1 - like
            $table->timestamps();
        });
        //can only have one record where a user likes or dislikes a particular tweet (can't have a record where the user likes the tweet and then another where the user dislikes the same tweet)
        $table->unique(['user_id', 'tweet_id']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
