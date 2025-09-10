<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'
import { Undo2 } from 'lucide-vue-next';
import { Link, router } from '@inertiajs/vue3'



const form = useForm({
    name: '',
    description: '',
    image: '',
    status: 'false',
})

const submit = () => {
    form.post('/sliders')
}


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create-Slider',
        href: '/sliders/create',
    },
];
</script>

<template>

    <Head title="Slider – Create" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1>Create A New Slider</h1>

            <form @submit.prevent="submit" class="space-y-5 bg-white p-4 shadow-xl rounded-2xl">
                <!-- Name -->
                <div class="mb-5">
                    <label for="large-input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input v-model="form.name" type="text"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <p v-if="form.errors.name">{{ form.errors.name }}</p>

                <!-- Description -->
                <div class="mb-5">
                    <label for="base-input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea
                        class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        v-model="form.description" rows="4"></textarea>
                </div>
                <p v-if="form.errors.description">{{ form.errors.description }}</p>

                <!-- Image URL -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image URL</label>
                    <input v-model="form.image" placeholder="https://example.com/image.jpg" type="text"
                        class="block w-full p-6 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <p v-if="form.errors.image">{{ form.errors.image }}</p>

                <!-- Status -->
                <div class="flex items-center gap-2">
                    <input v-model="form.status" type="checkbox" id="status" />
                    <label for="status" class="text-sm text-gray-700">Active</label>
                </div>

                <!-- Submit -->
                <div class="flex items-center gap-2 ">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-1 rounded hover:bg-blue-700"
                        :disabled="form.processing">
                        Save
                    </button>
                    <Link href="/sliders"
                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-md transition">
                    <Undo2 class="w-4 h-4 mr-1" /> Back</Link>
                </div>

            </form>

        </div>
    </AppLayout>
</template>
