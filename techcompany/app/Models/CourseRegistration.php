<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    protected $fillable = [
        'course_id',
        'student_name',
        'father_name',
        'gender',
        'date_of_birth',
        'cnic',
        'email',
        'phone',
        'whatsapp_number',
        'city',
        'address',
        'education',
        'skill_level',
        'has_laptop',
        'class_type',
        'course_fee',
        'deposit_amount',
        'deposit_method',
        'emergency_contact_name',
        'emergency_relationship',
        'emergency_phone',
        'emergency_whatsapp',
        'student_signature_date',
        'office_date',
        'message',
        'status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
