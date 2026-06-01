<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    category: Object,
});

const isEditing = Boolean(props.category);
const previewImage = ref(props.category?.image || '');

const form = useForm({
    name: props.category?.name || '',
    description: props.category?.description || '',
    image: props.category?.image || '',
    image_upload: null,
    order: props.category?.order || 0,
    is_active: props.category ? props.category.is_active : true,
});

const selectImage = (event) => {
    const file = event.target.files?.[0] || null;
    form.image_upload = file;

    if (file) {
        previewImage.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    const options = { forceFormData: true };

    if (isEditing) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.product-categories.update', props.category.id), options);
        return;
    }

    form.post(route('admin.product-categories.store'), options);
};
</script>

<template>
    <Head :title="isEditing ? 'Sửa danh mục sản phẩm' : 'Thêm danh mục sản phẩm'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ isEditing ? 'Sửa danh mục sản phẩm' : 'Thêm danh mục sản phẩm' }}</h2>
                <Link :href="route('admin.product-categories.index')" class="text-sm text-gray-600 hover:text-gray-900">Quay lại</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tên danh mục</label>
                        <input v-model="form.name" required type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <div v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mô tả</label>
                        <textarea v-model="form.description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ảnh danh mục</label>
                        <input type="file" accept="image/*" @change="selectImage" class="mt-1 block w-full text-sm text-gray-700">
                        <input v-model="form.image" type="hidden">
                        <img v-if="previewImage || form.image" :src="previewImage || form.image" class="mt-3 h-36 w-full rounded object-cover">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Thứ tự</label>
                        <input v-model="form.order" type="number" min="0" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        Hiển thị
                    </label>

                    <button type="submit" :disabled="form.processing" class="rounded bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-700 disabled:opacity-60">
                        {{ isEditing ? 'Lưu thay đổi' : 'Thêm danh mục' }}
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
