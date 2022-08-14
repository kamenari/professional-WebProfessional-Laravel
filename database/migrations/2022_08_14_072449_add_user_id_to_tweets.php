<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweets', function (Blueprint $table) {
            // user_idはusersテーブルのidのデータ型と揃える必要があるため、符号なしの整数にする、afterでidカラムの後ろにuser_idを追加する
            $table->unsignedBigInteger('user_id')->after('id');
            
            // usersテーブルのidカラムにuser_idカラムを関連付けます。
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->dropForeign('tweets_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
