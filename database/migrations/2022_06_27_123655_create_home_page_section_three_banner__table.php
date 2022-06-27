<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageSectionThreeBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_section_three_banner', function (Blueprint $table) {
            $table->id();
            $table->string('picture',256);
            $table->string('home_page_section_banner_text_three_heading',256);
            $table->string('home_page_section_banner_text_three',256);
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
        Schema::dropIfExists('home_page_section_three_banner');
    }
}
