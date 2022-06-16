<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogoHeaderAndFooterAndImagesChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logo_header_and_footer_and_images_change', function (Blueprint $table) {
            // $table->id();
            $table->Increments('id')->primary()->unsigned();
			$table->string('index_header_logo_1', 255)->nullable();
            $table->string('index_header_logo_2', 255)->nullable();
            $table->string('index_footer_logo_1', 255)->nullable();
            $table->string('index_footer_logo_2', 255)->nullable();
            $table->text('index_section_1_text', 255)->nullable();
            $table->string('index_section_2', 255)->nullable();
            $table->string('index_section_3_image', 255)->nullable();
            $table->text('index_section_4_text', 255)->nullable();
            $table->string('index_section_5_image', 255)->nullable();
            $table->text('index_section_6_text', 255)->nullable();
            $table->text('index_section_7_text', 255)->nullable();
            $table->text('about_section_1_text', 255)->nullable();
            $table->string('about_section_2_video', 255)->nullable();
            $table->text('about_section_3_text', 255)->nullable();
            $table->text('pricing_section_1_text', 255)->nullable();
            $table->text('pricing_section_2_text', 255)->nullable();
            $table->text('pricing_section_3_text', 255)->nullable();
            $table->text('pricing_section_4_text', 255)->nullable();
            $table->string('pricing_section_5_text', 255)->nullable();
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
        Schema::dropIfExists('logo_header_and_footer_and_images_change');
    }
}
