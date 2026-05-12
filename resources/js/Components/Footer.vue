<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { 
    MapPin, 
    Phone, 
    Mail, 
    Factory, 
    ChevronRight, 
    Facebook, 
    Youtube, 
    Instagram,
    ShieldCheck
} from 'lucide-vue-next';

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});

const companyName = computed(() => settings.value.company_name || 'CÔNG TY TNHH TMDV CÔNG NGHỆ KĨ THUẬT MÔI TRƯỜNG VÀ ĐÔ THỊ TECOTECH');
const phone = computed(() => settings.value.site_phone || '');
const phoneHref = computed(() => `tel:${phone.value.replace(/\s+/g, '')}`);
const email = computed(() => settings.value.site_email || '');
const emailHref = computed(() => `mailto:${email.value}`);

const primaryLinks = [
    { href: '/', label: 'Trang chủ' },
    { href: '/moi-truong', label: 'Tổng thầu EPC về môi trường' },
    { href: '/gia-cong-co-khi', label: 'Gia công cơ khí' },
    { href: '/cong-trinh', label: 'Công trình' },
    { href: '/tuyen-dung', label: 'Tuyển dụng' },
];

const policyLinks = [
    { href: '/chinh-sach-ban-hang', label: 'Chính sách bán hàng' },
    { href: '/chinh-sach-san-pham', label: 'Chính sách về sản phẩm' },
    { href: '/chinh-sach-bao-mat', label: 'Chính sách bảo mật' },
    { href: '/an-toan-thong-tin', label: 'An toàn thông tin' },
];

const organizationSchema = computed(() => JSON.stringify({
    '@context': 'https://schema.org',
    '@type': 'Organization',
    name: companyName.value,
    url: typeof window !== 'undefined' ? window.location.origin : '',
    logo: settings.value.site_logo || '',
    email: email.value,
    telephone: phone.value,
    address: {
        '@type': 'PostalAddress',
        streetAddress: settings.value.site_address || settings.value.site_headquarters || '',
        addressCountry: 'VN',
    },
    sameAs: [
        settings.value.site_facebook,
        settings.value.site_youtube,
        settings.value.site_instagram,
    ].filter(Boolean),
}));
</script>

<template>
    <Head>
        <component :is="'script'" type="application/ld+json" v-html="organizationSchema" />
    </Head>

    <footer class="bg-slate-900 text-slate-400">
        <div class="container mx-auto px-4 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12">
                <!-- Company Info -->
                <div class="lg:col-span-5 space-y-8">
                    <div>
                        <Link href="/">
                            <img :src="settings.site_logo || '/images/logo.png'" 
                                 :alt="settings.site_name || 'TECOTECH'" 
                                 class="h-14 brightness-0 invert opacity-90 mb-6">
                        </Link>
                        <h2 class="text-lg font-bold text-white uppercase leading-snug tracking-wider">
                            {{ companyName }}
                        </h2>
                        <div class="mt-3 h-1 w-20 bg-primary rounded-full"></div>
                    </div>

                    <p class="text-sm leading-relaxed max-w-md">
                        Đơn vị cung cấp giải pháp tổng thầu EPC về môi trường, gia công cơ khí và chế tạo thiết bị phi tiêu chuẩn theo yêu cầu chất lượng hàng đầu Việt Nam.
                    </p>

                    <div class="space-y-4">
                        <div v-if="settings.site_headquarters" class="flex items-start gap-4 group">
                            <div class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-800 text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                <MapPin class="w-4 h-4" />
                            </div>
                            <div class="text-sm">
                                <span class="block font-semibold text-slate-200 mb-0.5 tracking-wide">Trụ sở chính:</span>
                                <p>{{ settings.site_headquarters }}</p>
                            </div>
                        </div>
                        <div v-if="phone" class="flex items-start gap-4 group">
                            <div class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-800 text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                <Phone class="w-4 h-4" />
                            </div>
                            <div class="text-sm">
                                <span class="block font-semibold text-slate-200 mb-0.5 tracking-wide">Hotline hỗ trợ:</span>
                                <a :href="phoneHref" class="hover:text-primary transition-colors">{{ phone }}</a>
                            </div>
                        </div>
                        <div v-if="email" class="flex items-start gap-4 group">
                            <div class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-800 text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                <Mail class="w-4 h-4" />
                            </div>
                            <div class="text-sm">
                                <span class="block font-semibold text-slate-200 mb-0.5 tracking-wide">Email liên hệ:</span>
                                <a :href="emailHref" class="hover:text-primary transition-colors">{{ email }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="lg:col-span-2 space-y-8">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-wider mb-6">Liên kết</h3>
                        <div class="h-1 w-10 bg-primary rounded-full"></div>
                    </div>
                    <ul class="space-y-3">
                        <li v-for="item in primaryLinks" :key="item.href">
                            <Link :href="item.href" class="group flex items-center gap-2 text-sm hover:text-white transition-colors duration-200">
                                <ChevronRight class="w-3.5 h-3.5 text-primary group-hover:translate-x-1 transition-transform" />
                                <span>{{ item.label }}</span>
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Useful Info -->
                <div class="lg:col-span-2 space-y-8">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-wider mb-6">Thông tin</h3>
                        <div class="h-1 w-10 bg-primary rounded-full"></div>
                    </div>
                    <ul class="space-y-3">
                        <li v-for="item in policyLinks" :key="item.href">
                            <Link :href="item.href" class="group flex items-center gap-2 text-sm hover:text-white transition-colors duration-200">
                                <ShieldCheck class="w-3.5 h-3.5 text-primary group-hover:translate-x-1 transition-transform" />
                                <span>{{ item.label }}</span>
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Certifications/Badges -->
                <div class="lg:col-span-3 space-y-8">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-wider mb-6">Chứng nhận</h3>
                        <div class="h-1 w-10 bg-primary rounded-full"></div>
                    </div>
                    <div class="space-y-6">
                        <div class="p-4 bg-slate-800/50 rounded-xl border border-slate-700/50">
                            <p class="text-xs italic leading-relaxed mb-4">
                                Cam kết mang lại giá trị bền vững cho cộng đồng qua các dự án xử lý môi trường hiện đại.
                            </p>
                            <img v-if="settings.dmca_image" :src="settings.dmca_image" alt="DMCA Protected" class="h-8 w-auto opacity-80 hover:opacity-100 transition-opacity">
                        </div>
                        <div class="flex gap-4">
                            <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full bg-slate-800 hover:bg-primary hover:text-white transition-all duration-300">
                                <Facebook class="w-5 h-5" />
                            </a>
                            <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full bg-slate-800 hover:bg-primary hover:text-white transition-all duration-300">
                                <Youtube class="w-5 h-5" />
                            </a>
                            <a v-if="settings.site_instagram" :href="settings.site_instagram" target="_blank" class="h-10 w-10 flex items-center justify-center rounded-full bg-slate-800 hover:bg-primary hover:text-white transition-all duration-300">
                                <Instagram class="w-5 h-5" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="mt-16 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs tracking-wide">
                <p>{{ settings.footer_copyright || '© Copyright 2008 - 2024 TECOTECH. All rights reserved.' }}</p>
                <div class="flex items-center gap-6">
                    <span class="text-slate-500">Thiết kế bởi <strong class="text-slate-300">TECOTECH Team</strong></span>
                    <div class="h-4 w-px bg-slate-700"></div>
                    <Link href="/sitemap" class="hover:text-white">Sitemap</Link>
                </div>
            </div>
        </div>
    </footer>
</template>
