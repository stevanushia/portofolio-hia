<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Projects/Index', [
            'projects' => Project::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Projects/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tech_stack' => 'required|string', // Will be converted to array
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        // Convert comma-separated string to array
        $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));

        Project::create($validated);

        return redirect()->route('projects.index')->with('message', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        // Convert array back to comma-separated string for the form
        $project->tech_stack_string = implode(', ', $project->tech_stack);

        return Inertia::render('Admin/Projects/Edit', [
            'project' => $project,
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'tech_stack' => 'required|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image_url) {
                $oldPath = str_replace('/storage/', '', $project->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('projects', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));

        $project->update($validated);

        return redirect()->route('projects.index')->with('message', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image_url) {
            $oldPath = str_replace('/storage/', '', $project->image_url);
            Storage::disk('public')->delete($oldPath);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('message', 'Project deleted successfully.');
    }
}
