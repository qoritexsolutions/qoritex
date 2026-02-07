<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\TeamMember;
use App\Models\LeadershipMember;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->take(6)->get();
        $projects = Project::active()->featured()->take(6)->get();
        $teamMembers = TeamMember::active()->ordered()->take(4)->get();
        $testimonials = Testimonial::active()->take(6)->get();
        $courses = Course::where('is_active', true)->orderBy('order')->take(3)->get();

        return view('home', compact('services', 'projects', 'teamMembers', 'testimonials', 'courses'));
    }

    public function about()
    {
        $teamMembers = TeamMember::active()->ordered()->get();
        $leaders = LeadershipMember::active()->ordered()->get();
        return view('about', compact('teamMembers', 'leaders'));
    }

    public function services()
    {
        $services = Service::active()->ordered()->get();
        return view('services', compact('services'));
    }

    public function serviceDetail($id)
    {
        $service = Service::findOrFail($id);
        $otherServices = Service::active()
            ->where('id', '!=', $id)
            ->ordered()
            ->take(3)
            ->get();
        return view('service-detail', compact('service', 'otherServices'));
    }

    public function projects()
    {
        $projects = Project::active()->latest()->paginate(12);
        $categories = Project::active()->distinct()->pluck('category')->filter();
        return view('projects', compact('projects', 'categories'));
    }

    public function projectDetail($id)
    {
        $project = Project::findOrFail($id);
        $otherProjects = Project::active()
            ->where('id', '!=', $id)
            ->where('category', $project->category)
            ->take(3)
            ->get();
        return view('project-detail', compact('project', 'otherProjects'));
    }

    public function team()
    {
        $teamMembers = TeamMember::active()->ordered()->get();
        $leaders = LeadershipMember::active()->ordered()->get();
        return view('team', compact('teamMembers', 'leaders'));
    }

    public function contact()
    {
        return view('contact');
    }
}
