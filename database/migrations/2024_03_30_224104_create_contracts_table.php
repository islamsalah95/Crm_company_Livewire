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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');



            $table->bigInteger('EstLaborOfficeId')->nullable()->comment("//ادخل رقم التعريف الخاص بوزارة العمل");
            $table->bigInteger('EstSequenceNumber')->nullable()->comment("//دخل الرقم التلسلي في وزارة العمل");

            $table->enum('is_molTWC', [1,0])->default(0)->comment("هل يتبع لخدمة العمل عن بعد");

            $table->integer('working_hours');
            $table->integer('working_hours_per_day');
            $table->integer('working_hours_per_week');
            $table->integer('hourly_rate');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('gosi_job_title_id')->nullable();
            $table->string('job_title')->nullable();


            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
         
            $table->timestamp('created_on')->useCurrent();

            $table->enum('status', [1,0])->default(0);

            $table->string('reference_number', 25)->nullable();

            $table->string('message', 255)->nullable();

            $table->enum('status_id', [1,0])->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
