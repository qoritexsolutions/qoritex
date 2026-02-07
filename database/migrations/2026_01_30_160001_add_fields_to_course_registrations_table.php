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
        Schema::table('course_registrations', function (Blueprint $table) {
            $table->string('father_name')->nullable()->after('student_name');
            $table->string('gender')->nullable()->after('father_name');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->string('cnic')->nullable()->after('date_of_birth');
            $table->string('whatsapp_number')->nullable()->after('phone');
            $table->string('city')->nullable()->after('whatsapp_number');
            $table->text('address')->nullable()->after('city');
            $table->string('education')->nullable()->after('address');
            $table->string('skill_level')->nullable()->after('education');
            $table->boolean('has_laptop')->default(false)->after('skill_level');
            $table->string('class_type')->nullable()->after('has_laptop');
            
            // Course Details
            $table->decimal('course_fee', 10, 2)->nullable()->after('class_type');
            $table->decimal('deposit_amount', 10, 2)->nullable()->after('course_fee');
            $table->string('deposit_method')->nullable()->after('deposit_amount'); // Full/Installment
            
            // Emergency Contact
            $table->string('emergency_contact_name')->nullable()->after('deposit_method');
            $table->string('emergency_relationship')->nullable()->after('emergency_contact_name');
            $table->string('emergency_phone')->nullable()->after('emergency_relationship');
            $table->string('emergency_whatsapp')->nullable()->after('emergency_phone');
            
            // Signatures & Dates
            $table->date('student_signature_date')->nullable()->after('emergency_whatsapp');
            $table->date('office_date')->nullable()->after('student_signature_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_registrations', function (Blueprint $table) {
            //
        });
    }
};
