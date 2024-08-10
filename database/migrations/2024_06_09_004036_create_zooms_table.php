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
        Schema::create('zooms', function (Blueprint $table) {
            $table->id();
            $table->string('host_email');
            $table->string('topic');
            $table->string('start_time');
            $table->integer('duration');
            $table->string('timezone');
            $table->string('start_url',5000);
            $table->string('join_url',5000);
            $table->string('password',1000)->nullable();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->enum('status', [0,1])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zooms');
    }
};






