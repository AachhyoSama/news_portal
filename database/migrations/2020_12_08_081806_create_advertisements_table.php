<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('homepage_header_image');
            $table->string('homepage_header_url');
            $table->string('homepage_sidebar_image');
            $table->string('homepage_sidebar_url');
            $table->string('homepage_bottom_image');
            $table->string('homepage_bottom_url');

            $table->string('singlepage_header_image');
            $table->string('singlepage_header_url');
            $table->string('singlepage_sidebar_image');
            $table->string('singlepage_sidebar_url');
            $table->string('singlepage_bottom_image');
            $table->string('singlepage_bottom_url');
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
        Schema::dropIfExists('advertisements');
    }
}
