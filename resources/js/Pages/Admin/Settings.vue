<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SEOForm from '@/Components/SEOForm.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    settings: Object,
});

const value = (key, fallback = '') => props.settings?.[key] || fallback;

const parseJSON = (str, fallback) => {
    if (!str) return fallback;
    try {
        return JSON.parse(str);
    } catch (e) {
        if (typeof str === 'string' && str.includes('|')) {
            return str.split('\n').filter(line => line.trim()).map(line => {
                const [label, href] = line.split('|').map(part => part.trim());
                return { label, href: href || '#' };
            });
        }
        return fallback;
    }
};

const defaultCol1 = [
    { href: '/', label: 'Trang chủ' },
    { href: '/moi-truong', label: 'Tổng thầu EPC về môi trường' },
    { href: '/gia-cong-co-khi', label: 'Gia công cơ khí' },
    { href: '/cong-trinh', label: 'Công trình' },
    { href: '/tuyen-dung', label: 'Tuyển dụng' },
];

const defaultCol2 = [
    { href: '/chinh-sach-ban-hang', label: 'Chính sách bán hàng' },
    { href: '/chinh-sach-san-pham', label: 'Chính sách về sản phẩm' },
    { href: '/chinh-sach-bao-mat', label: 'Chính sách bảo mật' },
    { href: '/an-toan-thong-tin', label: 'An toàn thông tin' },
];

const previews = ref({
    site_logo: value('site_logo', '/images/logo.png'),
    site_favicon: value('site_favicon', '/favicon.ico'),
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
    footer_links_column_1: parseJSON(value('footer_links_column_1'), defaultCol1),
    footer_links_column_2: parseJSON(value('footer_links_column_2'), defaultCol2),
    footer_copyright: value('footer_copyright'),
    site_google_map: value('site_google_map'),
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
    form.transform((data) => ({
        ...data,
        footer_links_column_1: JSON.stringify(data.footer_links_column_1),
        footer_links_column_2: JSON.stringify(data.footer_links_column_2),
    })).post(route('admin.settings.update'), {
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
                        <h3 class="mb-5 text-lg font-bold text-gray-900">Mạng xã hội và Nút nổi (Floating Buttons)</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Link Facebook</label>
                                <input v-model="form.site_facebook" placeholder="https://facebook.com/trang-cua-ban" type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                <p class="text-xs text-gray-500 italic">Hiển thị icon Facebook nổi ở góc màn hình.</p>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Link Messenger</label>
                                <input v-model="form.site_messenger" placeholder="https://m.me/username" type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                <p class="text-xs text-gray-500 italic">Dùng link m.me/username để mở trực tiếp chat.</p>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Zalo ID hoặc Số điện thoại</label>
                                <input v-model="form.site_zalo" placeholder="0912345678" type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                <p class="text-xs text-gray-500 italic">Nhập số điện thoại Zalo để tự động tạo link chat.</p>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Kênh Youtube</label>
                                <input v-model="form.site_youtube" placeholder="https://youtube.com/@kenh-cua-ban" type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Instagram</label>
                                <input v-model="form.site_instagram" placeholder="https://instagram.com/username" type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                            </div>

                            <div class="flex items-center pt-6">
                                <label class="flex items-center gap-2 text-sm font-medium text-gray-700 cursor-pointer">
                                    <input v-model="form.floating_back_to_top" true-value="1" false-value="" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                                    Hiển thị nút "Lên đầu trang" (Back to Top)
                                </label>
                            </div>
                        </div>
                        <div class="mt-6 p-4 bg-amber-50 rounded-lg border border-amber-100">
                            <p class="text-sm text-amber-800">
                                <strong>Lưu ý:</strong> Hệ thống sẽ tự động sử dụng icon chuẩn của các mạng xã hội. Bạn chỉ cần nhập đúng đường dẫn (link) hoặc số điện thoại.
                            </p>
                        </div>
                    </section>

                    <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="mb-5 text-lg font-bold text-gray-900">Footer</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <input v-model="form.company_name" placeholder="Tên công ty" type="text" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:col-span-2" />
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Liên kết (Cột 1)</label>
                                <div class="space-y-2 mb-2">
                                    <div v-for="(link, index) in form.footer_links_column_1" :key="index" class="flex gap-2 items-center">
                                        <input v-model="link.label" placeholder="Tên hiển thị" type="text" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" />
                                        <input v-model="link.href" placeholder="Đường dẫn" type="text" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" />
                                        <button @click.prevent="form.footer_links_column_1.splice(index, 1)" class="text-red-500 hover:text-red-700 p-2" title="Xóa">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <button @click.prevent="form.footer_links_column_1.push({label: '', href: ''})" class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Thêm liên kết
                                </button>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Thông tin (Cột 2)</label>
                                <div class="space-y-2 mb-2">
                                    <div v-for="(link, index) in form.footer_links_column_2" :key="index" class="flex gap-2 items-center">
                                        <input v-model="link.label" placeholder="Tên hiển thị" type="text" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" />
                                        <input v-model="link.href" placeholder="Đường dẫn" type="text" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" />
                                        <button @click.prevent="form.footer_links_column_2.splice(index, 1)" class="text-red-500 hover:text-red-700 p-2" title="Xóa">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <button @click.prevent="form.footer_links_column_2.push({label: '', href: ''})" class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Thêm liên kết
                                </button>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ảnh DMCA/chứng nhận</label>
                                <input type="file" accept="image/*" @change="selectImage($event, 'dmca_image_upload', 'dmca_image')" class="mt-1 block w-full text-sm text-gray-700" />
                                <img v-if="previews.dmca_image" :src="previews.dmca_image" class="mt-3 h-9 w-auto rounded border" />
                            </div>
                            <textarea v-model="form.footer_copyright" placeholder="Copyright" rows="3" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:col-span-2" />
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Mã nhúng Google Map (Iframe)</label>
                                <textarea v-model="form.site_google_map" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder='<iframe src="..." ...></iframe>'></textarea>
                                <p class="mt-1 text-xs text-gray-500 italic">Lấy mã nhúng từ Google Maps > Chia sẻ > Nhúng bản đồ.</p>
                            </div>
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
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Từ khóa SEO trang chủ</label>
                                <textarea v-model="form.home_meta_keywords" rows="4" placeholder="xử lý nước thải, xử lý khí thải, gia công cơ khí, tổng thầu EPC môi trường..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                <p class="mt-1 text-xs text-gray-500 italic">Nhập các từ khóa chính, phân tách bằng dấu phẩy. Trường này sẽ được dùng cho meta keywords của trang chủ.</p>
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
