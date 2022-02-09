<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id('property_id');
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->nullable();
            $table->integer('unit_number')->default(1);
            $table->string('region');
            $table->string('city');
            $table->string('town');
            $table->text('address');
            $table->string('gps_location')->unique()->nullable();
            $table->string('type')->nullable(); //nullable because of the foreign key relationship (on delete set null)
            $table->json('other_features')->nullable();
            $table->decimal('price');
            $table->boolean('is_rent_negotiable')->default(0);
            $table->integer('advance')->nullable();
            $table->boolean('is_advance_negotiable')->default(0);
            $table->string('contact_phone_number');
            $table->string('contact_email');
            $table->boolean('is_property_available')->default(1);
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('type')
                    ->references('type')
                    ->on('property_types')
                    ->onUpdate('cascade')
                    ->onDelete('set null');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
