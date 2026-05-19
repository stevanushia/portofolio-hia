<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Skills/Index', [
            'skills' => Skill::orderBy('category')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Skills/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'proficiency' => 'nullable|integer|min:0|max:100',
        ]);

        Skill::create($validated);

        return redirect()->route('skills.index')->with('message', 'Skill added successfully.');
    }

    public function edit(Skill $skill)
    {
        return Inertia::render('Admin/Skills/Edit', [
            'skill' => $skill,
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'proficiency' => 'nullable|integer|min:0|max:100',
        ]);

        $skill->update($validated);

        return redirect()->route('skills.index')->with('message', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index')->with('message', 'Skill removed successfully.');
    }
}
