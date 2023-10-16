<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGetSeoRankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_get_seo_rank', function (Blueprint $table) {
              $table->id();
            $table->text('url')->nullable();
            $table->integer('ranked')->nullable();
            $table->string('country_code', 255)->nullable();
            $table->string('device', 255)->nullable();
            $table->integer('search_position')->nullable();
            $table->string('search_keyword', 225)->nullable();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_get_seo_rank');
    }
}
