<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Skill;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class PortfolioController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'projects' => Project::orderBy('is_featured', 'desc')->get(),
            'skills' => Skill::all()->groupBy('category'),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function show(Project $project)
    {
        return Inertia::render('Project', [
            'project' => $project,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
