<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";

defineProps({
    projects: {
        type: Object,
    },
});

const form = useForm({
    name: "",
    description: "",
});

const updateForm = useForm({
    id: null,
    name: "",
    description: "",
});

const toggleStatus = ref(false);
const toggleEditStatus = ref(false);

const toggleAdd = (newVal) => {
    toggleStatus.value = newVal;
    toggleEditStatus.value = false;
};

const toggleEdit = (newVal, data) => {
    toggleEditStatus.value = newVal;
    toggleStatus.value = false;

    updateForm.id = data.id;
    updateForm.name = data.name;
    updateForm.description = data.description;
};

const submit = () => {
    form.post(route("projects.store"));
    toggleStatus.value = false;
};
const edit = () => {
    router.patch(`/projects/${updateForm.id}`, updateForm);

    if (updateForm.hasErrors) {
        toggleEditStatus.value = false;
    }
};
const destroy = (id) => {
    router.delete(`/projects/${id}`);
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Sample Laravel App > Projects
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div v-if="toggleStatus" class="p-10">
                        <form @submit.prevent="submit">
                            <h3 class="text-xl font-bold">
                                Create a New Project
                            </h3>
                            <div class="flex flex-col">
                                <label for="name">Name:</label>
                                <input
                                    type="text"
                                    id="name"
                                    v-model="form.name"
                                />
                                <p v-if="form.errors.name" class="text-red-500">
                                    {{ form.errors.name }}
                                </p>
                            </div>

                            <div class="flex flex-col">
                                <label for="description">Description:</label>
                                <input
                                    type="text"
                                    id="description"
                                    v-model="form.description"
                                />
                                <p
                                    v-if="form.errors.description"
                                    class="text-red-500"
                                >
                                    {{ form.errors.description }}
                                </p>
                            </div>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 my-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Add Project
                            </button>
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 mx-1 my-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                @click="toggleAdd(false)"
                            >
                                Cancel
                            </button>
                        </form>
                    </div>

                    <div v-if="toggleEditStatus" class="p-10">
                        <form @submit.prevent="edit()">
                            <h3 class="text-xl font-bold">Update Project</h3>
                            <div class="flex flex-col">
                                <label for="name">Name:</label>
                                <input
                                    type="text"
                                    id="name"
                                    v-model="updateForm.name"
                                />
                                <p
                                    v-if="updateForm.errors.name"
                                    class="text-red-500"
                                >
                                    {{ updateForm.errors.name }}
                                </p>
                            </div>

                            <div class="flex flex-col">
                                <label for="description">Description:</label>
                                <input
                                    type="text"
                                    id="description"
                                    v-model="updateForm.description"
                                />
                                <p
                                    v-if="updateForm.errors.description"
                                    class="text-red-500"
                                >
                                    {{ updateForm.errors.description }}
                                </p>
                            </div>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 my-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Update Project
                            </button>
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 mx-1 my-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                @click="toggleEdit(false)"
                            >
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
                <div
                    class="flex flex-col justify-center p-5 overflow-hidden bg-white shadow-sm align-center sm:rounded-lg"
                >
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md w-100 hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        @click="toggleAdd(true)"
                    >
                        Create New Project
                    </button>
                    <table class="w-full border-collapse border-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th
                                    class="px-4 py-2 text-center border border-gray-200"
                                >
                                    ID
                                </th>
                                <th
                                    class="px-4 py-2 text-center border border-gray-200"
                                >
                                    Project
                                </th>
                                <th
                                    class="px-4 py-2 text-center border border-gray-200"
                                >
                                    Description
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr
                                v-for="project in projects"
                                class="border-b border-gray-200 hover:bg-gray-100"
                            >
                                <td
                                    class="px-4 py-2 text-center border border-gray-200"
                                >
                                    {{ project.id }}
                                </td>
                                <td
                                    class="px-4 py-2 text-left border border-gray-200"
                                >
                                    {{ project.name }}
                                </td>
                                <td
                                    class="px-4 py-2 text-left border border-gray-200"
                                >
                                    {{ project.description }}
                                </td>
                                <td class="flex px-4 py-2 border-gray-200">
                                    <button
                                        type="submit"
                                        class="inline-flex items-center px-4 py-2 mx-1 my-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        @click="toggleEdit(true, project)"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        type="submit"
                                        class="inline-flex items-center px-4 py-2 mx-1 my-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        @click="destroy(project.id)"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
