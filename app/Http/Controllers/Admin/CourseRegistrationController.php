<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;

class CourseRegistrationController extends Controller
{
    public function index()
    {
        $registrations = CourseRegistration::with('course')->latest()->paginate(20);
        return view('admin.courses.registrations', compact('registrations'));
    }

    public function updateStatus(Request $request, CourseRegistration $registration)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,cancelled'
        ]);

        $registration->update($validated);

        return redirect()->back()->with('success', 'Registration status updated successfully.');
    }

    public function destroy(CourseRegistration $registration)
    {
        $registration->delete();
        return redirect()->back()->with('success', 'Registration deleted successfully.');
    }
}
