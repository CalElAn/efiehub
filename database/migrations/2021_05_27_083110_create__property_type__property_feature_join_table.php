<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTypePropertyFeatureJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PropertyType_PropertyFeature_join', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('feature');
            $table->timestamps();

            $table->unique(['type', 'feature'], 'PropertyType_PropertyFeature_unique');

            $table->foreign('type')
                    ->references('type')
                    ->on('property_type')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');  

            $table->foreign('feature')
                    ->references('feature')
                    ->on('property_feature')
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
        Schema::dropIfExists('PropertyType_PropertyFeature_join');
    }
}
