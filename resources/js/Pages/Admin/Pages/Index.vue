<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    pages: Array,
});

const destroyPage = (id) => {
    if (confirm('Xoa trang nay?')) {
        router.delete(route('admin.pages.destroy', id));
    }
};
</script>

<template>
    <Head title="Quan ly trang" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Quan ly trang</h2>
                <Link :href="route('admin.pages.create')" class="rounded bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                    Them trang
                </Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tieu de</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">URL</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Trang thai</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Thao tac</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <tr v-for="pageItem in pages" :key="pageItem.id">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ pageItem.title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">/{{ pageItem.slug }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span :class="pageItem.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ pageItem.is_active ? 'Hien thi' : 'An' }}
                                    </span>
                                </td>
                                <td class="space-x-3 px-6 py-4 text-right text-sm">
                                    <a :href="'/' + pageItem.slug" target="_blank" class="text-gray-600 hover:text-gray-900">Xem</a>
                                    <Link :href="route('admin.pages.edit', pageItem.id)" class="text-indigo-600 hover:text-indigo-900">Sua</Link>
                                    <button type="button" @click="destroyPage(pageItem.id)" class="text-red-600 hover:text-red-800">Xoa</button>
                                </td>
                            </tr>
                            <tr v-if="pages.length === 0">
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">Chua co trang nao.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
