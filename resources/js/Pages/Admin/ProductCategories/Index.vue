<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
});

const destroyCategory = (id) => {
    if (confirm('Xóa danh mục sản phẩm này?')) {
        router.delete(route('admin.product-categories.destroy', id));
    }
};
</script>

<template>
    <Head title="Danh mục sản phẩm" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Danh mục sản phẩm</h2>
                <Link :href="route('admin.product-categories.create')" class="rounded bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Thêm danh mục</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tên</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Slug</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Thứ tự</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <tr v-for="category in categories" :key="category.id">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img v-if="category.image" :src="category.image" :alt="category.name" class="h-12 w-16 rounded object-cover">
                                        <span class="font-medium text-gray-900">{{ category.name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ category.slug }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ category.products_count }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ category.order }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span :class="category.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ category.is_active ? 'Hiển thị' : 'Ẩn' }}
                                    </span>
                                </td>
                                <td class="space-x-3 px-6 py-4 text-right text-sm">
                                    <Link :href="route('admin.product-categories.edit', category.id)" class="text-indigo-600 hover:text-indigo-900">Sửa</Link>
                                    <button type="button" @click="destroyCategory(category.id)" class="text-red-600 hover:text-red-800">Xóa</button>
                                </td>
                            </tr>
                            <tr v-if="categories.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">Chưa có danh mục sản phẩm.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
