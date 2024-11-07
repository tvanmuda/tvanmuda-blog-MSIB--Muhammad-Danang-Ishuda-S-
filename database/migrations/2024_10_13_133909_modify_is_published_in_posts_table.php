<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIsPublishedInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Mengubah kolom is_published menjadi boolean dengan default false
            $table->boolean('is_published')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Mengubah kembali kolom is_published menjadi tinyInteger (jika sebelumnya)
            $table->tinyInteger('is_published')->default(0)->change();
        });
    }
}
