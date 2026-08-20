<script setup>
import ZaloIcon from '@/Components/ZaloIcon.vue';
import { useActiveMenu } from '@/Composables/useActiveMenu';
import { Link, usePage } from '@inertiajs/vue3';
import {
    ChevronDown,
    Facebook,
    Headphones,
    Instagram,
    Mail,
    Menu as MenuIcon,
    Phone,
    X,
    Youtube,
} from 'lucide-vue-next';
import { computed } from 'vue';

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});
const menus = computed(() => page.props.globalMenus || []);
const { isActiveLink, isActiveMenu } = useActiveMenu(page);

const phoneHref = computed(() => `tel:${(settings.value.site_phone || '').replace(/\s+/g, '')}`);
const zaloLink = computed(() => {
    const value = (settings.value.site_zalo || '').replace(/\s+/g, '');
    return value.startsWith('http') ? value : `https://zalo.me/${value}`;
});
</script>

<template>
    <div class="relative z-[1000]">
        <input id="mobile-menu-toggle" type="checkbox" class="peer sr-only" aria-hidden="true">

        <div class="hidden bg-slate-900 py-2.5 text-xs text-slate-300 md:block">
            <div class="container mx-auto flex items-center justify-between px-4">
                <div class="flex items-center gap-6">
                    <a v-if="settings.site_phone" :href="phoneHref" class="inline-flex items-center gap-2 font-semibold hover:text-white">
                        <Phone class="h-3.5 w-3.5 text-primary" />
                        {{ settings.site_phone }}
                    </a>
                    <a v-if="settings.site_email" :href="`mailto:${settings.site_email}`" class="inline-flex items-center gap-2 hover:text-white">
                        <Mail class="h-3.5 w-3.5 text-primary" />
                        <span>Email: <strong class="text-white">{{ settings.site_email }}</strong></span>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="hover:text-white" aria-label="Facebook">
                        <Facebook class="h-4 w-4" />
                    </a>
                    <a v-if="settings.site_instagram" :href="settings.site_instagram" target="_blank" class="hover:text-white" aria-label="Instagram">
                        <Instagram class="h-4 w-4" />
                    </a>
                    <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="hover:text-white" aria-label="Youtube">
                        <Youtube class="h-4 w-4" />
                    </a>
                    <a v-if="settings.site_zalo" :href="zaloLink" target="_blank" class="inline-flex items-center gap-1 font-bold hover:text-white" aria-label="Zalo">
                        <ZaloIcon class="h-4 w-4 text-[#0068FF]" />
                        ZALO
                    </a>
                </div>
            </div>
        </div>

        <header class="sticky top-0 border-b border-slate-100 bg-white shadow-sm">
            <div class="container mx-auto flex h-16 items-center justify-between px-4 lg:h-20">
                <Link href="/" class="flex min-w-0 items-center">
                    <img
                        :src="settings.site_logo || '/images/logo.png'"
                        :alt="settings.site_name || 'TECOTECH'"
                        class="h-10 w-auto lg:h-14"
                    >
                </Link>

                <nav class="hidden items-center gap-1 lg:flex">
                    <div v-for="menu in menus" :key="menu.id" class="group relative">
                        <Link
                            v-if="!menu.children || menu.children.length === 0"
                            :href="menu.link"
                            class="block rounded-xl px-4 py-3 text-[13px] font-bold uppercase tracking-wide transition"
                            :class="isActiveMenu(menu) ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary'"
                            :aria-current="isActiveMenu(menu) ? 'page' : undefined"
                        >
                            {{ menu.name }}
                        </Link>

                        <div v-else>
                            <button
                                type="button"
                                class="flex items-center rounded-xl px-4 py-3 text-[13px] font-bold uppercase tracking-wide transition"
                                :class="isActiveMenu(menu) ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:text-primary'"
                                :aria-current="isActiveMenu(menu) ? 'page' : undefined"
                            >
                                {{ menu.name }}
                                <ChevronDown class="ml-1 h-3.5 w-3.5 transition group-hover:rotate-180" />
                            </button>
                            <div class="invisible absolute left-0 top-full z-50 w-72 translate-y-2 pt-2 opacity-0 transition group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                                <div class="overflow-hidden rounded-xl border border-slate-100 bg-white py-2 shadow-xl">
                                    <Link
                                        v-for="child in menu.children"
                                        :key="child.id"
                                        :href="child.link"
                                        class="block border-l-4 px-6 py-3 text-sm font-semibold transition"
                                        :class="isActiveLink(child.link) ? 'border-primary bg-primary/5 text-primary' : 'border-transparent text-slate-600 hover:border-primary hover:bg-slate-50 hover:text-primary'"
                                        :aria-current="isActiveLink(child.link) ? 'page' : undefined"
                                    >
                                        {{ child.name }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <Link href="/tu-van" class="btn btn-secondary btn-sm ml-5 h-10 rounded-xl px-5 font-bold normal-case">
                        <Headphones class="mr-2 h-4 w-4" />
                        Tư vấn miễn phí
                    </Link>
                </nav>

                <label
                    for="mobile-menu-toggle"
                    class="inline-flex h-12 w-12 cursor-pointer items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-800 lg:hidden"
                    aria-label="Mở menu"
                >
                    <MenuIcon class="h-7 w-7 peer-checked:hidden" />
                </label>
            </div>
        </header>

        <label
            for="mobile-menu-toggle"
            class="fixed inset-0 z-[3000] hidden cursor-pointer bg-slate-950/60 peer-checked:block lg:hidden"
            aria-label="Đóng menu"
        ></label>

        <aside class="fixed bottom-0 right-0 top-0 z-[3010] flex w-[88vw] max-w-[380px] translate-x-full flex-col bg-white shadow-2xl transition-transform duration-300 peer-checked:translate-x-0 lg:hidden">
            <div class="flex h-16 items-center justify-between border-b border-slate-100 px-5">
                <Link href="/">
                    <img
                        :src="settings.site_logo || '/images/logo.png'"
                        :alt="settings.site_name || 'TECOTECH'"
                        class="h-10 w-auto"
                    >
                </Link>
                <label for="mobile-menu-toggle" class="cursor-pointer rounded-lg p-2 text-slate-700 hover:bg-slate-100" aria-label="Đóng menu">
                    <X class="h-7 w-7" />
                </label>
            </div>

            <nav class="flex-1 overflow-y-auto px-5 py-4">
                <div v-for="menu in menus" :key="menu.id" class="border-b border-slate-100 last:border-b-0">
                    <Link
                        v-if="!menu.children || menu.children.length === 0"
                        :href="menu.link"
                        class="block py-4 text-sm font-bold uppercase tracking-wide"
                        :class="isActiveMenu(menu) ? 'text-primary' : 'text-slate-800'"
                        :aria-current="isActiveMenu(menu) ? 'page' : undefined"
                    >
                        {{ menu.name }}
                    </Link>

                    <details v-else class="group py-4">
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between text-sm font-bold uppercase tracking-wide"
                            :class="isActiveMenu(menu) ? 'text-primary' : 'text-slate-800'"
                        >
                            {{ menu.name }}
                            <ChevronDown class="h-4 w-4 transition group-open:rotate-180" />
                        </summary>

                        <div class="mt-3 border-l-2 border-primary/20 pl-4">
                            <Link
                                v-for="child in menu.children"
                                :key="child.id"
                                :href="child.link"
                                class="block rounded-r-lg px-3 py-3 text-sm font-semibold transition"
                                :class="isActiveLink(child.link) ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-50 hover:text-primary'"
                                :aria-current="isActiveLink(child.link) ? 'page' : undefined"
                            >
                                {{ child.name }}
                            </Link>
                        </div>
                    </details>
                </div>

                <div v-if="menus.length === 0" class="py-8 text-center text-sm text-slate-500">
                    Chưa có menu hiển thị.
                </div>
            </nav>

            <div class="border-t border-slate-100 bg-slate-50 p-5">
                <Link href="/tu-van" class="btn btn-secondary w-full rounded-xl font-bold">
                    <Headphones class="h-5 w-5" />
                    Tư vấn miễn phí
                </Link>

                <div class="mt-5 flex items-center justify-center gap-6 text-slate-500">
                    <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="hover:text-primary" aria-label="Facebook">
                        <Facebook class="h-5 w-5" />
                    </a>
                    <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="hover:text-primary" aria-label="Youtube">
                        <Youtube class="h-5 w-5" />
                    </a>
                    <a v-if="settings.site_zalo" :href="zaloLink" target="_blank" class="flex items-center gap-1 text-xs font-bold hover:text-primary" aria-label="Zalo">
                        <ZaloIcon class="h-5 w-5 text-[#0068FF]" />
                        ZALO
                    </a>
                </div>
            </div>
        </aside>
    </div>
</template>
