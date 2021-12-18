<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_media', function (Blueprint $table) {
            $table->id('property_media_id');
            $table->unsignedBigInteger('property_id');
            $table->string('path');
            $table->string('mime_type'); 
            $table->string('extension'); 
            $table->string('size_in_bytes'); 
            $table->string('formatted_size'); 
            $table->timestamps();

            $table->foreign('property_id')
                    ->references('property_id')
                    ->on('property')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_media');
    }
}
