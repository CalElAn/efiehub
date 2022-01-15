<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesPropertyFeaturesJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Properties_PropertyFeatures_join', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('feature');
            $table->integer('number')->nullable();
            $table->timestamps();

            $table->unique(['property_id', 'feature'], 'PropertyID_Feature_unique');

            $table->foreign('property_id')
                    ->references('property_id')
                    ->on('properties')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');  

            $table->foreign('feature', 'PropertyFeatures_PropertiesPropertyFeaturesJoin')
                    ->references('feature')
                    ->on('property_features')
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
        Schema::dropIfExists('Properties_PropertyFeatures_join');
    }
}
