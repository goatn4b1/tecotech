<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    products: {
        type: Array,
        default: () => [],
    },
});

const destroyProduct = (id) => {
    if (confirm('Xóa sản phẩm này?')) {
        router.delete(route('admin.products.destroy', id));
    }
};
</script>

<template>
    <Head title="Sản phẩm" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Sản phẩm</h2>
                <Link :href="route('admin.products.create')" class="rounded bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Thêm sản phẩm</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Danh mục</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Thứ tự</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <tr v-for="product in products" :key="product.id">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img v-if="product.image" :src="product.image" :alt="product.name" class="h-14 w-20 rounded object-cover">
                                        <div>
                                            <div class="font-medium text-gray-900">{{ product.name }}</div>
                                            <div class="text-xs text-gray-500">{{ product.slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ product.category?.name || 'Chưa chọn' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ product.order }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span :class="product.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="rounded-full px-2 py-1 text-xs font-semibold">
                                        {{ product.is_active ? 'Hiển thị' : 'Ẩn' }}
                                    </span>
                                </td>
                                <td class="space-x-3 px-6 py-4 text-right text-sm">
                                    <Link :href="route('admin.products.edit', product.id)" class="text-indigo-600 hover:text-indigo-900">Sửa</Link>
                                    <button type="button" @click="destroyProduct(product.id)" class="text-red-600 hover:text-red-800">Xóa</button>
                                </td>
                            </tr>
                            <tr v-if="products.length === 0">
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">Chưa có sản phẩm.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
