<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SEOForm from '@/Components/SEOForm.vue';
import { richEditorConfig } from '@/ckeditorUpload';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    post: Object,
    categories: {
        type: Array,
        default: () => [],
    },
});

const isEditing = Boolean(props.post);
const previewImage = ref(props.post?.image || '');

const form = useForm({
    title: props.post?.title || '',
    category_id: props.post?.category_id || '',
    category: props.post?.category || '',
    image: props.post?.image || '',
    featured_image: null,
    excerpt: props.post?.excerpt || '',
    content: props.post?.content || '',
    meta_title: props.post?.meta_title || '',
    meta_description: props.post?.meta_description || '',
    meta_keywords: props.post?.meta_keywords || '',
    og_image: props.post?.og_image || '',
    canonical_url: props.post?.canonical_url || '',
    is_active: props.post ? props.post.is_active : true,
});

const submit = () => {
    const options = { forceFormData: true };

    if (isEditing) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.posts.update', props.post.id), options);
        return;
    }

    form.transform((data) => data);
    form.post(route('admin.posts.store'), options);
};

const selectImage = (event) => {
    const file = event.target.files?.[0] || null;
    form.featured_image = file;

    if (file) {
        previewImage.value = URL.createObjectURL(file);
    }
};

const categoryHelp = computed(() => {
    if (props.categories.length > 0) {
        return 'Chon danh muc de quan ly va loc bai viet.';
    }

    return 'Chưa có danh mục. Có thể nhập tên danh mục tạm thời bên dưới.';
});
</script>

<template>
    <Head :title="isEditing ? 'Sửa bài viết' : 'Thêm bài viết mới'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ isEditing ? 'Sửa bài viết' : 'Thêm bài viết mới' }}
                </h2>
                <Link :href="route('admin.posts.index')" class="text-sm text-gray-600 hover:text-gray-900">Quay lại</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <div class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tiêu đề bài viết</label>
                            <input v-model="form.title" required type="text" class="mt-1 block w-full rounded-md border-gray-300 text-lg font-semibold shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <div v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Đoạn trích</label>
                            <textarea v-model="form.excerpt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Nội dung bài viết</label>
                            <ckeditor :editor="ClassicEditor" v-model="form.content" :config="richEditorConfig" />
                            <div v-if="form.errors.content" class="mt-1 text-sm text-red-600">{{ form.errors.content }}</div>
                        </div>
                    </div>

                    <div class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg">
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                            Công khai bài viết
                        </label>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Danh mục</label>
                            <select v-model="form.category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Không chọn</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">{{ categoryHelp }}</p>
                        </div>

                        <div v-if="!form.category_id">
                            <label class="block text-sm font-medium text-gray-700">Tên danh mục tạm thời</label>
                            <input v-model="form.category" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ảnh đại diện</label>
                            <input type="file" accept="image/*" @change="selectImage" class="mt-1 block w-full text-sm text-gray-700" />
                            <input v-model="form.image" type="hidden" />
                            <img v-if="previewImage || form.image" :src="previewImage || form.image" class="mt-3 h-36 w-full rounded object-cover" />
                            <div v-if="form.errors.featured_image" class="mt-1 text-sm text-red-600">{{ form.errors.featured_image }}</div>
                        </div>

                        <SEOForm 
                            :form="form" 
                            :title-source="form.title" 
                            :description-source="form.excerpt"
                        />

                        <button type="submit" :disabled="form.processing" class="w-full rounded bg-gray-900 px-4 py-3 text-sm font-semibold text-white hover:bg-gray-700 disabled:opacity-60">
                            {{ isEditing ? 'Lưu thay đổi' : 'Đăng bài viết' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.ck-editor__editable_inline {
    min-height: 420px;
}
</style>
