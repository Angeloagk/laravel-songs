<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

    Schema::create('albums', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('year',4)->nullable();
    $table->integer('times_sold')->nullable();
    $table->unsignedBigInteger('band_id')->nullable()->default(null);


    $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');
    $table->timestamps();
});
    }


    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
