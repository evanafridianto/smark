<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_profile_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('media');
            $table->string('cost');
            $table->text('description');
            $table->enum('status', ['achieved', 'process', 'unachieved']);
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
        Schema::dropIfExists('advertisements');
    }
};