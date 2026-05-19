<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

const props = defineProps({
    projects: Array,
});

const searchField = ref('title');
const searchValue = ref('');

const headers = [
    { text: "TITLE", value: "title", sortable: true },
    { text: "TECH STACK", value: "tech_stack" },
    { text: "FEATURED", value: "is_featured", sortable: true },
    { text: "ACTIONS", value: "actions", width: 150 },
];

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
                <div class="mb-6 flex gap-4">
                    <input
                        v-model="searchValue"
                        type="text"
                        placeholder="Search projects..."
                        class="block w-full md:w-80 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                    />
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <Vue3EasyDataTable
                            :headers="headers"
                            :items="projects"
                            :search-field="searchField"
                            :search-value="searchValue"
                            show-index
                            theme-color="#4f46e5"
                            table-class-name="customize-table"
                            buttons-pagination
                        >
                            <template #item-tech_stack="{ tech_stack }">
                                <div class="flex flex-wrap gap-1">
                                    <span v-for="tech in tech_stack" :key="tech" class="rounded bg-gray-100 px-2 py-0.5 text-[10px] font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                        {{ tech }}
                                    </span>
                                </div>
                            </template>
                            <template #item-is_featured="{ is_featured }">
                                <span v-if="is_featured" class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                    Featured
                                </span>
                                <span v-else class="text-gray-400 text-xs uppercase tracking-wider">No</span>
                            </template>
                            <template #item-actions="{ id }">
                                <div class="flex gap-4 justify-end">
                                    <Link :href="route('projects.edit', id)" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold transition-colors">Edit</Link>
                                    <button @click="deleteProject(id)" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-semibold transition-colors">Delete</button>
                                </div>
                            </template>
                        </Vue3EasyDataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.customize-table {
  --easy-table-border: 1px solid #f3f4f6;
  --easy-table-row-border: 1px solid #f3f4f6;
  
  --easy-table-header-font-size: 13px;
  --easy-table-header-height: 50px;
  --easy-table-header-font-color: #374151;
  --easy-table-header-background-color: #f9fafb;
  
  --easy-table-header-item-padding: 12px 15px;
  
  --easy-table-body-empty-padding: 32px;
  --easy-table-body-empty-font-color: #9ca3af;
  
  --easy-table-body-row-height: 60px;
  --easy-table-body-row-font-size: 14px;
  --easy-table-body-row-font-color: #4b5563;
  --easy-table-body-row-background-color: #ffffff;
  
  --easy-table-body-row-hover-font-color: #111827;
  --easy-table-body-row-hover-background-color: #f9fafb;
  
  --easy-table-body-item-padding: 12px 15px;

  --easy-table-footer-background-color: #ffffff;
  --easy-table-footer-font-color: #6b7280;
  --easy-table-footer-font-size: 13px;
  --easy-table-footer-padding: 15px;
  --easy-table-footer-height: 50px;

  --easy-table-scrollbar-track-color: transparent;
  --easy-table-scrollbar-color: #e5e7eb;
  --easy-table-scrollbar-thumb-color: #d1d5db;
}

.dark .customize-table {
  --easy-table-border: 1px solid #374151;
  --easy-table-row-border: 1px solid #374151;

  --easy-table-header-font-color: #e5e7eb;
  --easy-table-header-background-color: #111827;
  
  --easy-table-body-row-font-color: #d1d5db;
  --easy-table-body-row-background-color: #1f2937;
  
  --easy-table-body-row-hover-font-color: #ffffff;
  --easy-table-body-row-hover-background-color: #111827;

  --easy-table-footer-background-color: #1f2937;
  --easy-table-footer-font-color: #9ca3af;

  --easy-table-scrollbar-color: #374151;
  --easy-table-scrollbar-thumb-color: #4b5563;
}
</style>
