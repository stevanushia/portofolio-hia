<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    projects: Array,
});

const deleteProject = (id) => {
    if (confirm('Are you sure you want to delete this project?')) {
        router.delete(route('projects.destroy', id));
    }
};
</script>

<template>
    <Head title="Manage Projects" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Manage Projects
                </h2>
                <Link
                    :href="route('projects.create')"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Add Project
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b border-gray-200 text-xs uppercase text-gray-700 dark:border-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3">Title</th>
                                        <th class="px-6 py-3">Tech Stack</th>
                                        <th class="px-6 py-3">Featured</th>
                                        <th class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="project in projects" :key="project.id" class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <td class="px-6 py-4 font-medium">{{ project.title }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">
                                                <span v-for="tech in project.tech_stack" :key="tech" class="rounded-full bg-gray-100 px-2 py-0.5 text-[10px] dark:bg-gray-700">
                                                    {{ tech }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span v-if="project.is_featured" class="text-green-500">Yes</span>
                                            <span v-else class="text-gray-400">No</span>
                                        </td>
                                        <td class="px-6 py-4 text-right space-x-3">
                                            <Link :href="route('projects.edit', project.id)" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</Link>
                                            <button @click="deleteProject(project.id)" class="text-red-600 hover:text-red-900 dark:text-red-400">Delete</button>
                                        </td>
                                    </tr>
                                    <tr v-if="projects.length === 0">
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">No projects found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
