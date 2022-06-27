<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageSectionTwoBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_section_two__banner', function (Blueprint $table) {
            $table->id();
            $table->string('picture',256);
            $table->string('home_page_section_banner_text_top_heading',256);
            $table->string('home_page_section_banner_tex_heading',256);
            $table->string('home_page_section_banner_text_two',256);
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
        Schema::dropIfExists('home_page_section_two__banner');
    }
}
