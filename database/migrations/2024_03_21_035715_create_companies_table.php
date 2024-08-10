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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_website')->nullable();
            $table->string('company_address')->nullable();
            $table->integer('telephone1')->nullable();
            $table->string('company_currencysymbol')->nullable();
            $table->dateTime('date_format')->nullable();

            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            $table->string('zip')->nullable();
            $table->string('logo')->nullable();
            $table->string('timezone')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->integer('currently_allowed_employee')->nullable();

            $table->enum('daily_report', [1,0])->default(0)->comment("1 for send email , 0 dont send");
            $table->enum('weekly_report', [1,0])->default(0)->comment("1 for send email , 0 dont send");
            $table->enum('monthly_report', [1,0])->default(0)->comment("1 for send email , 0 dont send");
            $table->enum('is_valid', [1,0])->default(0)->comment("1 for send email , 0 dont send");

            $table->tinyInteger('status')->nullable();

            $table->timestamp('timestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
