<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTypesPropertyFeaturesJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PropertyTypes_PropertyFeatures_join', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('feature');
            $table->timestamps();

            $table->unique(['type', 'feature'], 'PropertyType_PropertyFeature_unique');

            $table->foreign('type')
                    ->references('type')
                    ->on('property_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');  

            $table->foreign('feature')
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
        Schema::dropIfExists('PropertyTypes_PropertyFeatures_join');
    }
}
