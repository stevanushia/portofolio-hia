<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    projects: Array,
    skills: Object,
});
</script>

<template>
    <Head title="Full Stack Developer Portfolio" />
    
    <div class="min-h-screen bg-[#fafafa] text-[#1a1a1a] dark:bg-[#0a0a0a] dark:text-[#f0f0f0] selection:bg-[#1a1a1a] selection:text-white dark:selection:bg-white dark:selection:text-black transition-colors duration-300">
        
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 bg-[#fafafa]/80 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-b border-[#e5e5e5] dark:border-[#1a1a1a]">
            <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
                <Link href="/" class="text-lg font-bold tracking-tighter">STEVANUS<span class="text-gray-500">HIA</span></Link>
                
                <div class="flex items-center gap-8">
                    <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                        <a href="#projects" class="hover:text-gray-500 transition-colors">Projects</a>
                        <a href="#skills" class="hover:text-gray-500 transition-colors">Skills</a>
                        <a href="#contact" class="hover:text-gray-500 transition-colors">Contact</a>
                    </div>
                    
                    <div v-if="canLogin" class="flex items-center gap-4">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm font-medium hover:text-gray-500">Dashboard</Link>
                        <template v-else>
                            <Link :href="route('login')" class="text-sm font-medium hover:text-gray-500">Log in</Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 px-6">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter leading-tight mb-8">
                    Full Stack Developer & <br/>
                    <span class="text-gray-400 dark:text-gray-600">AI Prompt Engineer.</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-500 dark:text-gray-400 max-w-2xl leading-relaxed mb-10">
                    Building seamless digital experiences with Laravel, Vue, and React. Focused on performance, clean code, and leveraging AI to accelerate development.
                </p>
                <div class="flex gap-4">
                    <a href="#projects" class="px-8 py-4 bg-[#1a1a1a] dark:bg-white text-white dark:text-black font-medium rounded-full hover:opacity-90 transition-opacity">
                        View Projects
                    </a>
                    <a href="#contact" class="px-8 py-4 border border-[#e5e5e5] dark:border-[#1a1a1a] font-medium rounded-full hover:bg-gray-100 dark:hover:bg-zinc-900 transition-colors">
                        Get in Touch
                    </a>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="py-20 px-6 border-t border-[#e5e5e5] dark:border-[#1a1a1a]">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-end justify-between mb-12">
                    <div>
                        <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-2">Selected Works</h2>
                        <h3 class="text-4xl font-bold tracking-tighter">Projects</h3>
                    </div>
                </div>

                <div v-if="projects.length" class="grid md:grid-cols-2 gap-8">
                    <Link v-for="project in projects" :key="project.id" :href="route('project.show', project.id)" class="group cursor-pointer">
                        <div class="aspect-video mb-6 overflow-hidden rounded-2xl bg-gray-100 dark:bg-zinc-900 border border-[#e5e5e5] dark:border-[#1a1a1a]">
                            <img v-if="project.image_url" :src="project.image_url" :alt="project.title" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div v-else class="w-full h-full flex items-center justify-center text-gray-300 dark:text-zinc-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-2xl font-bold mb-2 group-hover:underline">{{ project.title }}</h4>
                        <p class="text-gray-500 dark:text-gray-400 mb-4 line-clamp-2">{{ project.description }}</p>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="tech in project.tech_stack" :key="tech" class="px-3 py-1 text-xs font-medium bg-gray-100 dark:bg-zinc-900 rounded-full">
                                {{ tech }}
                            </span>
                        </div>
                    </Link>
                </div>
                
                <div v-else class="py-20 text-center border-2 border-dashed border-[#e5e5e5] dark:border-[#1a1a1a] rounded-3xl">
                    <p class="text-gray-500">No projects added yet. Add some via the database!</p>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section id="skills" class="py-20 px-6 bg-white dark:bg-[#0a0a0a]">
            <div class="max-w-6xl mx-auto">
                <div class="mb-16">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-2">Expertise</h2>
                    <h3 class="text-4xl font-bold tracking-tighter">Technical Stack</h3>
                </div>

                <div v-if="Object.keys(skills).length" class="grid md:grid-cols-3 gap-12">
                    <div v-for="(group, category) in skills" :key="category">
                        <h4 class="text-lg font-bold mb-6 capitalize border-b pb-2 dark:border-zinc-800">{{ category }}</h4>
                        <div class="space-y-4">
                            <div v-for="skill in group" :key="skill.id" class="flex items-center justify-between">
                                <span class="font-medium">{{ skill.name }}</span>
                                <div class="w-24 h-1 bg-gray-100 dark:bg-zinc-900 rounded-full overflow-hidden">
                                    <div class="h-full bg-black dark:bg-white" :style="{ width: skill.proficiency + '%' }"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div v-else class="grid md:grid-cols-3 gap-12">
                    <!-- Placeholder if no skills in DB -->
                    <div>
                        <h4 class="text-lg font-bold mb-6 border-b pb-2 dark:border-zinc-800">Frontend</h4>
                        <p class="text-gray-400">Vue.js, React, Tailwind CSS, TypeScript</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 border-b pb-2 dark:border-zinc-800">Backend</h4>
                        <p class="text-gray-400">Laravel, Node.js, PostgreSQL, Redis</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-6 border-b pb-2 dark:border-zinc-800">Other</h4>
                        <p class="text-gray-400">AI Prompting, Docker, GitHub Actions, AWS</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-32 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-5xl md:text-7xl font-bold tracking-tighter mb-8">Let's build something <span class="italic text-gray-400">extraordinary.</span></h2>
                <p class="text-xl text-gray-500 mb-12">Currently open for new opportunities and collaborations.</p>
                <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                    <a href="mailto:hello@example.com" class="text-2xl font-bold border-b-2 border-black dark:border-white hover:text-gray-500 transition-colors">hello@example.com</a>
                    <div class="hidden md:block w-2 h-2 bg-gray-300 rounded-full"></div>
                    <a href="https://github.com/stevanushia" class="text-2xl font-bold border-b-2 border-black dark:border-white hover:text-gray-500 transition-colors">GitHub</a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-6 border-t border-[#e5e5e5] dark:border-[#1a1a1a]">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-gray-400 font-medium">
                <p>&copy; 2026 Stevanus Hia. Built with Laravel 11, Vue 3, and Inertia.js.</p>
                <div class="flex gap-8">
                    <span>Laravel v{{ laravelVersion }}</span>
                    <span>PHP v{{ phpVersion }}</span>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
html {
    scroll-behavior: smooth;
}
</style>
