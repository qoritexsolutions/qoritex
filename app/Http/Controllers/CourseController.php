<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)->orderBy('order')->get();
        return view('courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('courses.show', compact('course'));
    }

    public function register($slug = null)
    {
        $selectedCourse = null;
        if ($slug) {
            $selectedCourse = Course::where('slug', $slug)->first();
        }
        $courses = Course::where('is_active', true)->get();
        return view('courses.register', compact('courses', 'selectedCourse'));
    }

    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'cnic' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp_number' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'required|string',
            'education' => 'required|string|max:255',
            'skill_level' => 'required|in:Beginner,Intermediate,Advanced',
            'has_laptop' => 'required|boolean',
            'class_type' => 'required|in:Online,Physical',
            'course_fee' => 'required|numeric',
            'deposit_amount' => 'required|numeric',
            'deposit_method' => 'required|in:Full,Installment',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_relationship' => 'required|string|max:100',
            'emergency_phone' => 'required|string|max:20',
            'emergency_whatsapp' => 'required|string|max:20',
            'message' => 'nullable|string'
        ]);

        $validated['student_signature_date'] = now();

        CourseRegistration::create($validated);

        return redirect()->back()->with('success', 'Your registration has been submitted successfully! We will contact you soon for the next steps.');
    }

    public function presentation($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('courses.presentation', compact('course'));
    }
}
