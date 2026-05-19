<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    project: Object,
});

const form = useForm({
    _method: 'PUT',
    title: props.project.title,
    description: props.project.description,
    images: [], // This will hold NEWLY uploaded files
    tech_stack: props.project.tech_stack_string,
    github_url: props.project.github_url || '',
    live_url: props.project.live_url || '',
    is_featured: props.project.is_featured,
});

const handleImageUpload = (event) => {
    const files = Array.from(event.target.files);
    form.images = [...form.images, ...files];
    event.target.value = '';
};

const removeQueuedImage = (index) => {
    form.images.splice(index, 1);
};

const submit = () => {
    // We use post with _method: 'PUT' for file uploads in Laravel/Inertia
    form.post(route('projects.update', props.project.id));
};
</script>

<template>
    <Head title="Edit Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Edit Project: {{ project.title }}
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
                                <InputLabel for="images" value="Add Project Images (optional)" />
                                <div v-if="project.images && project.images.length" class="flex flex-wrap gap-2 mb-4">
                                    <div v-for="(img, index) in project.images" :key="index" class="relative group">
                                        <img :src="img" class="h-20 w-auto rounded-lg shadow-sm" alt="Project image" />
                                    </div>
                                </div>

                                <input
                                    id="images"
                                    type="file"
                                    multiple
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:text-gray-400 dark:file:bg-gray-700 dark:file:text-gray-300"
                                    @change="handleImageUpload"
                                />
                                <InputError class="mt-2" :message="form.errors.images" />

                                <div v-if="form.images.length > 0" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div v-for="(file, index) in form.images" :key="index" class="relative group aspect-square rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <button @click.prevent="removeQueuedImage(index)" class="text-white bg-red-600 rounded-full p-1 hover:bg-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="w-full h-full flex items-center justify-center bg-gray-50 dark:bg-gray-900 text-[10px] text-gray-500 p-2 text-center break-all">
                                            {{ file.name }}
                                        </div>
                                    </div>
                                </div>
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
                                <PrimaryButton :disabled="form.processing">Update Project</PrimaryButton>
                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Updated.</p>
                                </Transition>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
