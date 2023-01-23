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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->foreignId('business_profile_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->foreignId('advertisement_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->unsigned();
            $table->date('date');
            $table->string('customer')->nullable();
            $table->string('qty');
            $table->string('total');
            $table->enum('status', ['sold', 'return']);
            $table->enum('handling', ['finished', 'unfinished']);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('sales');
    }
};