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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('emp_name')->nullable();
            $table->dateTime('joining_date')->nullable();
            $table->float('emp_code')->nullable();
            $table->float('emp_salary')->nullable();
            $table->enum('department', [1,2,3,4,5,6])->default(3)->comment("1 for Admin, 2 for employees, 3 for freelancer, 4 for manager, 5 for super admin and 6 for supervisor");
            $table->string('employee_national_number', 14)->nullable(); // Change column to string with 14 characters
            $table->string('emp_surname')->nullable();
            $table->string('emp_photo_file')->nullable();
            $table->boolean('is_company')->default(false);
            $table->string('birthday')->date();
            $table->string('address')->nullable();
            $table->float('hour')->nullable();
            $table->integer('contact1')->nullable();
            $table->string('remarks')->nullable();
            $table->dateTime('create_date')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamp('timestamp')->useCurrent()->nullable();
            $table->string('random')->default('0');
            $table->integer('postal_code')->nullable();
            $table->integer('age')->nullable();
            $table->string('major', 50)->nullable();
            $table->string('other_major', 50)->nullable();
            $table->text('skills')->nullable();
            $table->string('certificate')->nullable();
            $table->integer('login_fail_count')->default(0);
            $table->integer('login_fail_time')->default('0');
            $table->boolean('privacy_check')->default(false);
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
