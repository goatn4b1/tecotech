<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    settings: Object,
});

const value = (key, fallback = '') => props.settings?.[key] || fallback;
const previews = ref({
    site_logo: value('site_logo', '/images/logo.png'),
    site_favicon: value('site_favicon', '/favicon.ico'),
    floating_zalo_image: value('floating_zalo_image'),
    floating_messenger_image: value('floating_messenger_image'),
    floating_facebook_image: value('floating_facebook_image'),
    dmca_image: value('dmca_image'),
    home_og_image: value('home_og_image'),
});

const form = useForm({
    site_name: value('site_name', 'TECOTECH'),
    site_logo: value('site_logo', '/images/logo.png'),
    site_logo_upload: null,
    site_favicon: value('site_favicon', '/favicon.ico'),
    site_favicon_upload: null,
    site_phone: value('site_phone'),
    site_email: value('site_email'),
    site_facebook: value('site_facebook'),
    site_instagram: value('site_instagram'),
    site_youtube: value('site_youtube'),
    site_zalo: value('site_zalo'),
    site_messenger: value('site_messenger'),
    site_headquarters: value('site_headquarters'),
    site_address: value('site_address'),
    company_name: value('company_name', 'CÔNG TY TNHH TMDV CÔNG NGHỆ KĨ THUẬT MÔI TRƯỜNG VÀ ĐÔ THỊ TECOTECH'),
    footer_copyright: value('footer_copyright'),
    floating_zalo_image: value('floating_zalo_image'),
    floating_zalo_image_upload: null,
    floating_messenger_image: value('floating_messenger_image'),
    floating_messenger_image_upload: null,
    floating_facebook_image: value('floating_facebook_image'),
    floating_facebook_image_upload: null,
    floating_back_to_top: value('floating_back_to_top', '1'),
    dmca_image: value('dmca_image'),
    dmca_image_upload: null,
    // Home SEO
    home_meta_title: value('home_meta_title'),
    home_meta_description: value('home_meta_description'),
    home_meta_keywords: value('home_meta_keywords'),
    home_og_image: value('home_og_image'),
    home_og_image_upload: null,
    home_canonical_url: value('home_canonical_url'),
    home_meta_robots: value('home_meta_robots'),
});

const selectImage = (event, fileField, valueField) => {
    const file = event.target.files?.[0] || null;
    form[fileField] = file;

    if (file) {
        previews.value[valueField] = URL.createObjectURL(file);
    }
};

const submit = () => {
    form.transform((data) => data).post(route('admin.settings.update'), {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Cấu hình chung" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Cấu hình chung</h2>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="space-y-6">
                    <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="mb-5 text-lg font-bold text-gray-900">Thương hiệu và liên hệ</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tên website</label>
                                <input v-model="form.site_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Logo</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'site_logo_upload', 'site_logo')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.site_logo" :src="previews.site_logo" class="mt-3 h-14 w-auto rounded border bg-white p-1" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Favicon (.ico, .png)</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'site_favicon_upload', 'site_favicon')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.site_favicon" :src="previews.site_favicon" class="mt-3 h-8 w-8 rounded border bg-white p-1" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Điện thoại</label>
                                <input v-model="form.site_phone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input v-model="form.site_email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Trụ sở</label>
                                <input v-model="form.site_headquarters" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Địa chỉ nhà máy/văn phòng</label>
                                <input v-model="form.site_address" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>
                        </div>
                    </section>

                    <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="mb-5 text-lg font-bold text-gray-900">Mạng xã hội và nút nổi</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <input v-model="form.site_facebook" placeholder="Link Facebook" type="text" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <input v-model="form.site_messenger" placeholder="Link Messenger" type="text" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <input v-model="form.site_zalo" placeholder="Zalo ID hoặc link" type="text" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <input v-model="form.site_youtube" placeholder="Youtube" type="text" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <input v-model="form.site_instagram" placeholder="Instagram" type="text" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input v-model="form.floating_back_to_top" true-value="1" false-value="" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                                Hiển thị nút lên đầu trang
                            </label>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Icon Zalo</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'floating_zalo_image_upload', 'floating_zalo_image')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.floating_zalo_image" :src="previews.floating_zalo_image" class="mt-3 h-10 w-10 rounded-full border object-cover" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Icon Messenger</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'floating_messenger_image_upload', 'floating_messenger_image')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.floating_messenger_image" :src="previews.floating_messenger_image" class="mt-3 h-10 w-10 rounded-full border object-cover" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Icon Facebook</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'floating_facebook_image_upload', 'floating_facebook_image')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.floating_facebook_image" :src="previews.floating_facebook_image" class="mt-3 h-10 w-10 rounded-full border object-cover" />
                            </div>
                        </div>
                    </section>

                    <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="mb-5 text-lg font-bold text-gray-900">Footer</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <input v-model="form.company_name" placeholder="Tên công ty" type="text" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:col-span-2" />
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ảnh DMCA/chứng nhận</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'dmca_image_upload', 'dmca_image')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.dmca_image" :src="previews.dmca_image" class="mt-3 h-9 w-auto rounded border" />
                            </div>
                            <textarea v-model="form.footer_copyright" placeholder="Copyright" rows="3" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:col-span-2" />
                        </div>
                    </section>

                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="mb-5 text-lg font-bold text-gray-900">SEO Trang chủ</h3>
                        
                        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ảnh chia sẻ (Social Image)</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'home_og_image_upload', 'home_og_image')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.home_og_image" :src="previews.home_og_image" class="mt-3 h-32 w-auto rounded border object-cover" />
                                <p class="mt-1 text-xs text-gray-500 italic">Dùng làm ảnh đại diện khi chia sẻ trang chủ lên Facebook/Zalo.</p>
                            </div>
                        </div>

                        <SEOForm 
                            :form="{
                                meta_title: form.home_meta_title,
                                meta_description: form.home_meta_description,
                                meta_keywords: form.home_meta_keywords,
                                og_image: form.home_og_image,
                                canonical_url: form.home_canonical_url,
                                meta_robots: form.home_meta_robots
                            }"
                            @update:form="(updated) => {
                                form.home_meta_title = updated.meta_title;
                                form.home_meta_description = updated.meta_description;
                                form.home_meta_keywords = updated.meta_keywords;
                                form.home_og_image = updated.og_image;
                                form.home_canonical_url = updated.canonical_url;
                                form.home_meta_robots = updated.meta_robots;
                            }"
                        />
                    </div>

                    <button :disabled="form.processing" type="submit" class="rounded bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-700 disabled:opacity-60">
                        Lưu cấu hình
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
             <button :disabled="form.processing" type="submit" class="rounded bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-700 disabled:opacity-60">
                        Lưu cấu hình
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
