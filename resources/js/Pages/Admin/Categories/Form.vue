<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
});

const isEditing = Boolean(props.category);
const form = useForm({
    name: props.category?.name || '',
    description: props.category?.description || '',
    order: props.category?.order || 0,
    is_active: props.category ? props.category.is_active : true,
});

const submit = () => {
    if (isEditing) {
        form.put(route('admin.categories.update', props.category.id));
        return;
    }

    form.post(route('admin.categories.store'));
};
</script>

<template>
    <Head :title="isEditing ? 'Sua danh muc' : 'Them danh muc'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ isEditing ? 'Sua danh muc' : 'Them danh muc' }}</h2>
                <Link :href="route('admin.categories.index')" class="text-sm text-gray-600 hover:text-gray-900">Quay lai</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ten danh muc</label>
                        <input v-model="form.name" required type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mo ta</label>
                        <textarea v-model="form.description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Thu tu</label>
                        <input v-model="form.order" type="number" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                        Hien thi
                    </label>
                    <button type="submit" :disabled="form.processing" class="rounded bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700 disabled:opacity-60">Luu danh muc</button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
