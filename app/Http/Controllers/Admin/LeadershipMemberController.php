<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadershipMemberController extends Controller
{
    public function index()
    {
        $leaders = LeadershipMember::ordered()->get();
        return view('admin.leadership.index', compact('leaders'));
    }

    public function create()
    {
        return view('admin.leadership.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'quote' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'icon' => 'nullable|string|max:100',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('leadership', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $request->icon ?? 'fas fa-user-tie';
        $validated['order'] = $request->order ?? 0;

        LeadershipMember::create($validated);

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Leadership member created successfully.');
    }

    public function edit(LeadershipMember $leadership)
    {
        return view('admin.leadership.edit', compact('leadership'));
    }

    public function update(Request $request, LeadershipMember $leadership)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'quote' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'icon' => 'nullable|string|max:100',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($leadership->photo) {
                Storage::disk('public')->delete($leadership->photo);
            }
            $validated['photo'] = $request->file('photo')->store('leadership', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $request->icon ?? $leadership->icon;
        $validated['order'] = $request->order ?? $leadership->order;

        $leadership->update($validated);

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Leadership member updated successfully.');
    }

    public function destroy(LeadershipMember $leadership)
    {
        if ($leadership->photo) {
            Storage::disk('public')->delete($leadership->photo);
        }
        
        $leadership->delete();

        return redirect()->route('admin.leadership.index')
            ->with('success', 'Leadership member deleted successfully.');
    }
}
