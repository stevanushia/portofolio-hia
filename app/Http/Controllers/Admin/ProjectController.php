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
            'images' => 'nullable|array|max:5', // Limit to 5 images per project
            'images.*' => 'nullable|image|max:2048',
            'tech_stack' => 'required|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects', 'public');
                $imagePaths[] = Storage::url($path);
            }
        }
        $validated['images'] = $imagePaths;

        $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));

        Project::create($validated);

        return redirect()->route('projects.index')->with('message', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
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
            'images' => 'nullable|array|max:5', // Limit to 5 images per project
            'images.*' => 'nullable|image|max:2048',
            'tech_stack' => 'required|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'is_featured' => 'boolean',
        ]);

        $imagePaths = $project->images ?? [];
        if ($request->hasFile('images')) {
            // If new images are uploaded, we append them in this simple implementation.
            // A more advanced one might allow individual deletion.
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects', 'public');
                $imagePaths[] = Storage::url($path);
            }
        }
        $validated['images'] = $imagePaths;

        $validated['tech_stack'] = array_map('trim', explode(',', $validated['tech_stack']));

        $project->update($validated);

        return redirect()->route('projects.index')->with('message', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->images) {
            foreach ($project->images as $imageUrl) {
                $path = str_replace('/storage/', '', $imageUrl);
                Storage::disk('public')->delete($path);
            }
        }

        $project->delete();

        return redirect()->route('projects.index')->with('message', 'Project deleted successfully.');
    }
}
