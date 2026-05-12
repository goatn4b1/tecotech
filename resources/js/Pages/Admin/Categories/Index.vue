<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    categories: Array,
});

const destroyCategory = (id) => {
    if (confirm('Xoa danh muc nay?')) {
        router.delete(route('admin.categories.destroy', id));
    }
};
</script>

<template>
    <Head title="Danh muc bai viet" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Danh muc bai viet</h2>
                <Link :href="route('admin.categories.create')" class="rounded bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Them danh muc</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Ten</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Thu tu</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Trang thai</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Thao tac</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <tr v-for="category in categories" :key="category.id">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ category.name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ category.slug }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ category.order }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span :class="category.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ category.is_active ? 'Hien thi' : 'An' }}
                                    </span>
                                </td>
                                <td class="space-x-3 px-6 py-4 text-right text-sm">
                                    <Link :href="route('admin.categories.edit', category.id)" class="text-indigo-600 hover:text-indigo-900">Sua</Link>
                                    <button type="button" @click="destroyCategory(category.id)" class="text-red-600 hover:text-red-800">Xoa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
