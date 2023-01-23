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
        Schema::create('roas', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('business_profile_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('advertisement_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->string('revenue_campaign');
            $table->string('roas_score');
            $table->string('conclusion');
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
        Schema::dropIfExists('roas');
    }
};