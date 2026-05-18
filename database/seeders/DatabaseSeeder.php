<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Projects
        Project::create([
            'title' => 'E-commerce Platform',
            'description' => 'A high-performance e-commerce solution built with Laravel and Vue 3. Featuring real-time inventory and AI-driven recommendations.',
            'tech_stack' => ['Laravel', 'Vue.js', 'PostgreSQL', 'Tailwind CSS'],
            'is_featured' => true,
        ]);

        Project::create([
            'title' => 'AI Prompt Optimizer',
            'description' => 'A tool that leverages LLMs to refine and optimize engineering prompts for better code generation results.',
            'tech_stack' => ['React', 'Node.js', 'OpenAI API', 'TypeScript'],
            'is_featured' => true,
        ]);

        // Seed Skills
        $skills = [
            ['name' => 'Laravel', 'category' => 'backend', 'proficiency' => 95],
            ['name' => 'PHP', 'category' => 'backend', 'proficiency' => 90],
            ['name' => 'PostgreSQL', 'category' => 'backend', 'proficiency' => 85],
            ['name' => 'Vue.js', 'category' => 'frontend', 'proficiency' => 90],
            ['name' => 'React', 'category' => 'frontend', 'proficiency' => 85],
            ['name' => 'Tailwind CSS', 'category' => 'frontend', 'proficiency' => 95],
            ['name' => 'AI Prompting', 'category' => 'AI', 'proficiency' => 90],
            ['name' => 'Github', 'category' => 'tools', 'proficiency' => 95],
            ['name' => 'Docker', 'category' => 'tools', 'proficiency' => 80],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
