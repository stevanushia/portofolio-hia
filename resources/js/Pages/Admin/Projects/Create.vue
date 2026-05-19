<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    image: null,
    tech_stack: '',
    github_url: '',
    live_url: '',
    is_featured: false,
});

const submit = () => {
    form.post(route('projects.store'));
};
</script>

<template>
    <Head title="Add Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Add New Project
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel for="title" value="Project Title" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Description" />
                                <textarea
                                    id="description"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                    v-model="form.description"
                                    rows="4"
                                    required
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div>
                                <InputLabel for="image" value="Project Image" />
                                <input
                                    id="image"
                                    type="file"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300"
                                    @input="form.image = $event.target.files[0]"
                                />
                                <InputError class="mt-2" :message="form.errors.image" />
                            </div>

                            <div>
                                <InputLabel for="tech_stack" value="Tech Stack (comma separated)" />
                                <TextInput
                                    id="tech_stack"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.tech_stack"
                                    placeholder="Laravel, Vue.js, Tailwind CSS"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.tech_stack" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="github_url" value="GitHub URL" />
                                    <TextInput
                                        id="github_url"
                                        type="url"
                                        class="mt-1 block w-full"
                                        v-model="form.github_url"
                                    />
                                    <InputError class="mt-2" :message="form.errors.github_url" />
                                </div>

                                <div>
                                    <InputLabel for="live_url" value="Live Demo URL" />
                                    <TextInput
                                        id="live_url"
                                        type="url"
                                        class="mt-1 block w-full"
                                        v-model="form.live_url"
                                    />
                                    <InputError class="mt-2" :message="form.errors.live_url" />
                                </div>
                            </div>

                            <div class="flex items-center">
                                <label class="flex items-center">
                                    <input
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900"
                                        v-model="form.is_featured"
                                    />
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Featured Project</span>
                                </label>
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save Project</PrimaryButton>
                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                                </Transition>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
