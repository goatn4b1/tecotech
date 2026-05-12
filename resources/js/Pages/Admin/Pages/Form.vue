<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SEOForm from '@/Components/SEOForm.vue';
import { richEditorConfig } from '@/ckeditorUpload';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    pageItem: Object,
});

const isEditing = Boolean(props.pageItem);
const heroPreview = ref(props.pageItem?.hero_image || '');
const form = useForm({
    title: props.pageItem?.title || '',
    slug: props.pageItem?.slug || '',
    excerpt: props.pageItem?.excerpt || '',
    content: props.pageItem?.content || '',
    hero_image: props.pageItem?.hero_image || '',
    hero_upload: null,
    meta_title: props.pageItem?.meta_title || '',
    meta_description: props.pageItem?.meta_description || '',
    meta_keywords: props.pageItem?.meta_keywords || '',
    og_image: props.pageItem?.og_image || '',
    canonical_url: props.pageItem?.canonical_url || '',
    meta_robots: props.pageItem?.meta_robots || null,
    is_active: props.pageItem ? props.pageItem.is_active : true,
});

const submit = () => {
    if (isEditing) {
        form.transform((data) => ({ ...data, _method: 'put' })).post(route('admin.pages.update', props.pageItem.id), {
            forceFormData: true,
        });
        return;
    }

    form.transform((data) => data).post(route('admin.pages.store'), {
        forceFormData: true,
    });
};

const selectHero = (event) => {
    const file = event.target.files?.[0] || null;
    form.hero_upload = file;

    if (file) {
        heroPreview.value = URL.createObjectURL(file);
    }
};
</script>

<template>
    <Head :title="isEditing ? 'Sửa trang' : 'Thêm trang'" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ isEditing ? 'Sửa trang' : 'Thêm trang' }}</h2>
                <Link :href="route('admin.pages.index')" class="text-sm text-gray-600 hover:text-gray-900">Quay lại</Link>
            </div>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <div class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                            <input v-model="form.title" required type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tóm tắt</label>
                            <textarea v-model="form.excerpt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">Nội dung</label>
                            <ckeditor :editor="ClassicEditor" v-model="form.content" :config="richEditorConfig" />
                        </div>
                    </div>

                    <div class="space-y-6 bg-white p-6 shadow-sm sm:rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Slug URL</label>
                            <input v-model="form.slug" type="text" placeholder="Tự động nếu bỏ trống" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ảnh banner</label>
                            <input type="file" accept="image/*" @change="selectHero" class="mt-1 block w-full text-sm text-gray-700" />
                            <input v-model="form.hero_image" type="hidden" />
                            <img v-if="heroPreview || form.hero_image" :src="heroPreview || form.hero_image" class="mt-3 h-32 w-full rounded object-cover" />
                        </div>
                        <SEOForm :form="form" />

                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input v-model="form.is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                            Hiển thị
                        </label>
                        <button type="submit" :disabled="form.processing" class="w-full rounded bg-gray-900 px-4 py-3 text-sm font-semibold text-white hover:bg-gray-700 disabled:opacity-60">
                            Lưu trang
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
