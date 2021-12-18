<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyPropertyFeatureJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Property_PropertyFeature_join', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('feature');
            $table->integer('number')->nullable();
            $table->timestamps();

            $table->unique(['property_id', 'feature'], 'PropertyID_Feature_unique');

            $table->foreign('property_id')
                    ->references('property_id')
                    ->on('property')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');  

            $table->foreign('feature', 'PropertyFeature_PropertyPropertyFeatureJoin')
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
        Schema::dropIfExists('Property_PropertyFeature_join');
    }
}
