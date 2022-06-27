<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSectionBannerTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_section_banner_text', function (Blueprint $table) {
            $table->id();
            $table->string('picture',256);
            $table->text('home_page_section_banner_text');
            $table->string('home_page_section_two_banner_image',256);
            $table->string('home_page_section_banner_text_top_heading',256);
            $table->text('home_page_section_banner_tex_heading',256);
            $table->text('home_page_section_banner_text_two');
            $table->string('home_page_section_three_banner_image',256);
            $table->text('home_page_section_banner_text_three_heading');
            $table->text('home_page_section_banner_text_three');
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
        Schema::dropIfExists('home_section_banner_text');
    }
}
