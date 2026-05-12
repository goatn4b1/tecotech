<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    posts: Array
});

const deletePost = (id) => {
    if (confirm('Bạn có chắc chắn muốn xóa bài viết này?')) {
        router.delete(route('admin.posts.destroy', id));
    }
};
</script>

<template>
    <Head title="Quản lý Bài viết" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý Bài viết</h2>
                <Link :href="route('admin.posts.create')" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded shadow font-bold text-sm">
                    <i class="fas fa-plus mr-1"></i> Thêm bài viết mới
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hình ảnh</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu đề</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="post in posts" :key="post.id" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img :src="post.image || 'https://via.placeholder.com/150'" class="h-12 w-20 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900 line-clamp-2">{{ post.title }}</div>
                                        <div class="text-xs text-gray-500" v-if="post.created_at">
                                            {{ new Date(post.created_at).toLocaleDateString('vi-VN') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ post.category_relation?.name || post.category || 'Không phân loại' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" :class="post.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                                            {{ post.is_active ? 'Đang hiện' : 'Đã ẩn' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('admin.posts.edit', post.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Sửa</Link>
                                        <button @click="deletePost(post.id)" class="text-red-600 hover:text-red-900">Xóa</button>
                                    </td>
                                </tr>
                                <tr v-if="posts.length === 0">
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Chưa có bài viết nào.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
