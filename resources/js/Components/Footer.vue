<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ZaloIcon from '@/Components/ZaloIcon.vue';
import { 
    MapPin, 
    Phone, 
    Mail, 
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
const zaloLink = computed(() => {
    const value = (settings.value.site_zalo || '').replace(/\s+/g, '');
    return value.startsWith('http') ? value : `https://zalo.me/${value}`;
});

const parseLinks = (linksString, defaults) => {
    if (!linksString) return defaults;
    try {
        return JSON.parse(linksString);
    } catch (e) {
        if (typeof linksString === 'string' && linksString.includes('|')) {
            return linksString.split('\n').filter(line => line.trim()).map(line => {
                const [label, href] = line.split('|').map(part => part.trim());
                return { label, href: href || '#' };
            });
        }
        return defaults;
    }
};

const primaryLinks = computed(() => parseLinks(settings.value.footer_links_column_1, [
    { href: '/', label: 'Trang chủ' },
    { href: '/moi-truong', label: 'Tổng thầu EPC về môi trường' },
    { href: '/gia-cong-co-khi', label: 'Gia công cơ khí' },
    { href: '/cong-trinh', label: 'Công trình' },
    { href: '/tuyen-dung', label: 'Tuyển dụng' },
]));

const policyLinks = computed(() => parseLinks(settings.value.footer_links_column_2, [
    { href: '/chinh-sach-ban-hang', label: 'Chính sách bán hàng' },
    { href: '/chinh-sach-san-pham', label: 'Chính sách về sản phẩm' },
    { href: '/chinh-sach-bao-mat', label: 'Chính sách bảo mật' },
    { href: '/an-toan-thong-tin', label: 'An toàn thông tin' },
]));

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
            <!-- Main Footer Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Company Info -->
                <div class="lg:col-span-4 space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-wider mb-6 min-h-[40px] flex items-center">
                            Thông tin liên hệ
                        </h3>
                        <div class="h-1 w-10 bg-primary rounded-full -mt-4 mb-6"></div>
                        <p class="text-sm font-bold text-slate-200 mb-4 leading-tight uppercase">
                            {{ companyName }}
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div v-if="settings.site_headquarters" class="flex items-start gap-4 group">
                            <MapPin class="w-4 h-4 text-primary shrink-0 mt-0.5" />
                            <div class="text-sm leading-relaxed">
                                <p>{{ settings.site_headquarters }}</p>
                            </div>
                        </div>
                        <div v-if="phone" class="flex items-start gap-4 group">
                            <Phone class="w-4 h-4 text-primary shrink-0 mt-0.5" />
                            <div class="text-sm">
                                <a :href="phoneHref" class="hover:text-primary transition-colors">{{ phone }}</a>
                            </div>
                        </div>
                        <div v-if="email" class="flex items-start gap-4 group">
                            <Mail class="w-4 h-4 text-primary shrink-0 mt-0.5" />
                            <div class="text-sm">
                                <a :href="emailHref" class="hover:text-primary transition-colors">{{ email }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="h-9 w-9 flex items-center justify-center rounded-lg bg-slate-800 hover:bg-primary hover:text-white transition-all duration-300">
                            <Facebook class="w-4 h-4" />
                        </a>
                        <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="h-9 w-9 flex items-center justify-center rounded-lg bg-slate-800 hover:bg-primary hover:text-white transition-all duration-300">
                            <Youtube class="w-4 h-4" />
                        </a>
                        <a v-if="settings.site_instagram" :href="settings.site_instagram" target="_blank" class="h-9 w-9 flex items-center justify-center rounded-lg bg-slate-800 hover:bg-primary hover:text-white transition-all duration-300">
                            <Instagram class="w-4 h-4" />
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-wider mb-6 min-h-[40px] flex items-center">
                            Liên kết
                        </h3>
                        <div class="h-1 w-10 bg-primary rounded-full -mt-4 mb-6"></div>
                    </div>
                    <ul class="space-y-3">
                        <li v-for="item in primaryLinks" :key="item.href">
                            <Link :href="item.href" class="group flex items-center gap-2 text-sm hover:text-white transition-colors duration-200">
                                <ChevronRight class="w-3.5 h-3.5 text-primary/50 group-hover:text-primary transition-colors" />
                                <span>{{ item.label }}</span>
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Useful Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-wider mb-6 min-h-[40px] flex items-center">
                            Thông tin
                        </h3>
                        <div class="h-1 w-10 bg-primary rounded-full -mt-4 mb-6"></div>
                    </div>
                    <ul class="space-y-3">
                        <li v-for="item in policyLinks" :key="item.href">
                            <Link :href="item.href" class="group flex items-center gap-2 text-sm hover:text-white transition-colors duration-200">
                                <ShieldCheck class="w-3.5 h-3.5 text-primary/50 group-hover:text-primary transition-colors" />
                                <span>{{ item.label }}</span>
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Google Map Section -->
                <div class="lg:col-span-4 space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-white uppercase tracking-wider mb-6 min-h-[40px] flex items-center">
                            Bản đồ
                        </h3>
                        <div class="h-1 w-10 bg-primary rounded-full -mt-4 mb-6"></div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-800 shadow-2xl h-[200px] footer-map" v-html="settings.site_google_map">
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="mt-16 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs tracking-wide">
                <p>{{ settings.footer_copyright || '© Copyright 2008 - 2024 TECOTECH. All rights reserved.' }}</p>
                <div class="flex items-center gap-6">
                    <span class="text-slate-500">Thiết kế bởi <strong class="text-slate-300">Goatn4b1</strong></span>
                    <div class="h-4 w-px bg-slate-700"></div>
                    <Link href="/sitemap" class="hover:text-white transition-colors">Sitemap</Link>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.footer-map :deep(iframe) {
    width: 100% !important;
    height: 100% !important;
}
</style>
