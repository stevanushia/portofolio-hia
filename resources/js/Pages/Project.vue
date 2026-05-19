<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    project: Object,
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head :title="project.title + ' - Project Details'" />

    <div class="min-h-screen bg-[#fafafa] text-[#1a1a1a] dark:bg-[#0a0a0a] dark:text-[#f0f0f0] transition-colors duration-300">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 bg-[#fafafa]/80 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-b border-[#e5e5e5] dark:border-[#1a1a1a]">
            <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
                <Link href="/" class="text-lg font-bold tracking-tighter">STEVANUS<span class="text-gray-500">HIA</span></Link>
                <Link href="/#projects" class="text-sm font-medium hover:text-gray-500 transition-colors">Back to Projects</Link>
            </div>
        </nav>

        <main class="pt-32 pb-20 px-6">
            <div class="max-w-4xl mx-auto">
                <Link href="/#projects" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-600 mb-8 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Works
                </Link>

                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter leading-tight mb-8">
                    {{ project.title }}
                </h1>

                <div class="flex flex-wrap gap-2 mb-12">
                    <span v-for="tech in project.tech_stack" :key="tech" class="px-4 py-1.5 text-sm font-medium bg-gray-100 dark:bg-zinc-900 rounded-full">
                        {{ tech }}
                    </span>
                </div>

                <div class="aspect-video mb-12 overflow-hidden rounded-3xl bg-gray-100 dark:bg-zinc-900 border border-[#e5e5e5] dark:border-[#1a1a1a]">
                    <img v-if="project.image_url" :src="project.image_url" :alt="project.title" class="w-full h-full object-cover" />
                    <div v-else class="w-full h-full flex items-center justify-center text-gray-300 dark:text-zinc-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-12">
                    <div class="md:col-span-2">
                        <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-6">About the project</h2>
                        <div class="text-xl leading-relaxed text-gray-600 dark:text-gray-400 whitespace-pre-wrap">
                            {{ project.description }}
                        </div>
                    </div>
                    <div class="space-y-10">
                        <div>
                            <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-4">Role</h2>
                            <p class="text-lg font-medium">Full Stack Developer</p>
                        </div>
                        <div v-if="project.github_url || project.live_url">
                            <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-4">Links</h2>
                            <div class="flex flex-col gap-4">
                                <a v-if="project.github_url" :href="project.github_url" target="_blank" class="flex items-center gap-2 font-bold hover:text-gray-500 transition-colors">
                                    Source Code
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                                <a v-if="project.live_url" :href="project.live_url" target="_blank" class="flex items-center gap-2 font-bold hover:text-gray-500 transition-colors">
                                    Live Preview
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="py-12 px-6 border-t border-[#e5e5e5] dark:border-[#1a1a1a]">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-gray-400 font-medium">
                <p>&copy; 2026 Stevanus Hia. Built with Laravel 11, Vue 3, and Inertia.js.</p>
                <Link href="/" class="hover:text-gray-600">Home</Link>
            </div>
        </footer>
    </div>
</template>

<style>
html {
    scroll-behavior: smooth;
}
</style>
