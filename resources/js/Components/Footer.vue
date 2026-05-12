<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

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

    <footer class="border-t border-slate-200 bg-slate-50 text-slate-700">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-12">
                <section class="lg:col-span-6" aria-labelledby="footer-company">
                    <h2 id="footer-company" class="max-w-2xl text-lg font-extrabold uppercase leading-snug tracking-wide text-slate-900">
                        {{ companyName }}
                    </h2>
                    <div class="mt-3 h-0.5 w-28 bg-primary"></div>

                    <p class="mt-5 max-w-2xl text-sm leading-6 text-slate-600">
                        Đơn vị cung cấp giải pháp tổng thầu EPC về môi trường, gia công cơ khí và chế tạo thiết bị phi tiêu chuẩn theo yêu cầu.
                    </p>

                    <address class="mt-6 space-y-4 text-sm not-italic">
                        <div v-if="settings.site_headquarters" class="flex gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <i class="fas fa-location-dot text-sm"></i>
                            </span>
                            <p class="flex items-center"><strong class="font-semibold text-slate-900 mr-1">Trụ sở:</strong> {{ settings.site_headquarters }}</p>
                        </div>
                        <div v-if="phone" class="flex gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <i class="fas fa-phone text-sm"></i>
                            </span>
                            <p class="flex items-center"><strong class="font-semibold text-slate-900 mr-1">Hotline:</strong> <a :href="phoneHref" class="hover:text-primary">{{ phone }}</a></p>
                        </div>
                        <div v-if="email" class="flex gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <i class="fas fa-envelope text-sm"></i>
                            </span>
                            <p class="flex items-center"><strong class="font-semibold text-slate-900 mr-1">Email:</strong> <a :href="emailHref" class="hover:text-primary">{{ email }}</a></p>
                        </div>
                        <div v-if="settings.site_address" class="flex gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <i class="fas fa-industry text-sm"></i>
                            </span>
                            <p class="flex items-center"><strong class="font-semibold text-slate-900 mr-1">Địa chỉ:</strong> {{ settings.site_address }}</p>
                        </div>
                    </address>
                </section>

                <nav class="lg:col-span-3" aria-labelledby="footer-primary-links">
                    <h2 id="footer-primary-links" class="text-base font-bold uppercase tracking-wide text-slate-900">Liên kết</h2>
                    <div class="mt-3 h-0.5 w-20 bg-primary"></div>
                    <ul class="mt-6 space-y-3 text-sm">
                        <li v-for="item in primaryLinks" :key="item.href">
                            <Link :href="item.href" class="group flex items-center gap-2 transition hover:text-primary">
                                <i class="fas fa-caret-right text-xs text-primary transition group-hover:translate-x-0.5"></i>
                                <span>{{ item.label }}</span>
                            </Link>
                        </li>
                    </ul>
                </nav>

                <nav class="lg:col-span-3" aria-labelledby="footer-policy-links">
                    <h2 id="footer-policy-links" class="text-base font-bold uppercase tracking-wide text-slate-900">Thông tin hữu ích</h2>
                    <div class="mt-3 h-0.5 w-20 bg-primary"></div>
                    <ul class="mt-6 space-y-3 text-sm">
                        <li v-for="item in policyLinks" :key="item.href">
                            <Link :href="item.href" class="group flex items-center gap-2 transition hover:text-primary">
                                <i class="fas fa-caret-right text-xs text-primary transition group-hover:translate-x-0.5"></i>
                                <span>{{ item.label }}</span>
                            </Link>
                        </li>
                    </ul>

                    <img v-if="settings.dmca_image" :src="settings.dmca_image" alt="DMCA Protected" class="mt-6 h-8 w-auto">
                </nav>
            </div>
        </div>

        <div class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <p>{{ settings.footer_copyright || '© Copyright 2008 - 2024 TECOTECH.' }}</p>
                <div class="flex items-center gap-4" aria-label="Mạng xã hội">
                    <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" rel="noopener" class="hover:text-primary" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" rel="noopener" class="hover:text-primary" aria-label="Youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a v-if="settings.site_instagram" :href="settings.site_instagram" target="_blank" rel="noopener" class="hover:text-primary" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>
