<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { richEditorConfig } from '@/ckeditorUpload';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
    categories: {
        type: Array,
        default: () => [],
    },
});

const isEditing = Boolean(props.product);
const previewImage = ref(props.product?.image || '');

const form = useForm({
    product_category_id: props.product?.product_category_id || '',
    name: props.product?.name || '',
    image: props.product?.image || '',
    image_upload: null,
    excerpt: props.product?.excerpt || '',
    content: props.product?.content || '',
    order: props.product?.order || 0,
    is_active: props.product ? props.product.is_active : true,
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
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.products.update', props.product.id), options);
        return;
    }

    form.post(route('admin.products.store'), options);
};
</script>

<template>
    <Head :title="isEditing ? 'Sửa sản phẩm' : 'Thêm sản phẩm'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ isEditing ? 'Sửa sản phẩm' : 'Thêm sản phẩm' }}</h2>
                <Link :href="route('admin.products.index')" class="text-sm text-gray-600 hover:text-gray-900">Quay lại</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <div class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                            <input v-model="form.name" required type="text" class="mt-1 block w-full rounded-md border-gray-300 text-lg font-semibold shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <div v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mô tả ngắn</label>
                            <textarea v-model="form.excerpt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Nội dung chi tiết</label>
                            <ckeditor :editor="ClassicEditor" v-model="form.content" :config="richEditorConfig" />
                        </div>
                    </div>

                    <div class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg">
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            Hiển thị sản phẩm
                        </label>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Danh mục sản phẩm</label>
                            <select v-model="form.product_category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Không chọn</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ảnh sản phẩm</label>
                            <input type="file" accept="image/*" @change="selectImage" class="mt-1 block w-full text-sm text-gray-700">
                            <input v-model="form.image" type="hidden">
                            <img v-if="previewImage || form.image" :src="previewImage || form.image" class="mt-3 h-40 w-full rounded object-cover">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Thứ tự</label>
                            <input v-model="form.order" type="number" min="0" class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <button type="submit" :disabled="form.processing" class="w-full rounded bg-gray-900 px-4 py-3 text-sm font-semibold text-white hover:bg-gray-700 disabled:opacity-60">
                            {{ isEditing ? 'Lưu thay đổi' : 'Thêm sản phẩm' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.ck-editor__editable_inline {
    min-height: 360px;
}
</style>
