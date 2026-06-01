<script setup>
import ZaloIcon from '@/Components/ZaloIcon.vue';
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
import { computed, onBeforeUnmount, ref, watch } from 'vue';

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});
const menus = computed(() => page.props.globalMenus || []);

const isMobileOpen = ref(false);
const openSubmenus = ref({});

const phoneHref = computed(() => `tel:${(settings.value.site_phone || '').replace(/\s+/g, '')}`);
const zaloLink = computed(() => {
    const value = (settings.value.site_zalo || '').replace(/\s+/g, '');
    return value.startsWith('http') ? value : `https://zalo.me/${value}`;
});

const closeMobileMenu = () => {
    isMobileOpen.value = false;
    openSubmenus.value = {};
};

const toggleMobileMenu = () => {
    isMobileOpen.value = !isMobileOpen.value;
};

const toggleSubmenu = (id) => {
    openSubmenus.value = {
        ...openSubmenus.value,
        [id]: !openSubmenus.value[id],
    };
};

watch(isMobileOpen, (isOpen) => {
    document.body.style.overflow = isOpen ? 'hidden' : '';
});

onBeforeUnmount(() => {
    document.body.style.overflow = '';
});
</script>

<template>
    <div class="relative z-[1000]">
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
                <Link href="/" class="flex min-w-0 items-center" @click="closeMobileMenu">
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
                            class="block px-4 py-3 text-[13px] font-bold uppercase tracking-wide text-slate-700 hover:text-primary"
                        >
                            {{ menu.name }}
                        </Link>

                        <div v-else>
                            <button type="button" class="flex items-center px-4 py-3 text-[13px] font-bold uppercase tracking-wide text-slate-700 hover:text-primary">
                                {{ menu.name }}
                                <ChevronDown class="ml-1 h-3.5 w-3.5 transition group-hover:rotate-180" />
                            </button>
                            <div class="invisible absolute left-0 top-full z-50 w-72 translate-y-2 pt-2 opacity-0 transition group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                                <div class="overflow-hidden rounded-xl border border-slate-100 bg-white py-2 shadow-xl">
                                    <Link
                                        v-for="child in menu.children"
                                        :key="child.id"
                                        :href="child.link"
                                        class="block border-l-4 border-transparent px-6 py-3 text-sm font-semibold text-slate-600 hover:border-primary hover:bg-slate-50 hover:text-primary"
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

                <button
                    type="button"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-slate-200 text-slate-800 lg:hidden"
                    :aria-expanded="isMobileOpen"
                    aria-controls="mobile-main-menu"
                    aria-label="Mở menu"
                    @click="toggleMobileMenu"
                >
                    <MenuIcon v-if="!isMobileOpen" class="h-6 w-6" />
                    <X v-else class="h-6 w-6" />
                </button>
            </div>
        </header>
    </div>

    <div
        v-if="isMobileOpen"
        id="mobile-main-menu"
        class="fixed inset-0 z-[3000] lg:hidden"
        role="dialog"
        aria-modal="true"
    >
        <button type="button" class="absolute inset-0 h-full w-full bg-slate-950/60" aria-label="Đóng menu" @click="closeMobileMenu"></button>

        <aside class="absolute right-0 top-0 flex h-full w-[86vw] max-w-[360px] flex-col bg-white shadow-2xl">
            <div class="flex h-16 items-center justify-between border-b border-slate-100 px-5">
                <Link href="/" @click="closeMobileMenu">
                    <img
                        :src="settings.site_logo || '/images/logo.png'"
                        :alt="settings.site_name || 'TECOTECH'"
                        class="h-10 w-auto"
                    >
                </Link>
                <button type="button" class="rounded-lg p-2 text-slate-700 hover:bg-slate-100" aria-label="Đóng menu" @click="closeMobileMenu">
                    <X class="h-6 w-6" />
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto px-5 py-4">
                <div v-for="menu in menus" :key="menu.id" class="border-b border-slate-100 last:border-b-0">
                    <Link
                        v-if="!menu.children || menu.children.length === 0"
                        :href="menu.link"
                        class="block py-4 text-sm font-bold uppercase tracking-wide text-slate-800"
                        @click="closeMobileMenu"
                    >
                        {{ menu.name }}
                    </Link>

                    <div v-else class="py-4">
                        <button
                            type="button"
                            class="flex w-full items-center justify-between text-left text-sm font-bold uppercase tracking-wide text-slate-800"
                            @click="toggleSubmenu(menu.id)"
                        >
                            {{ menu.name }}
                            <ChevronDown class="h-4 w-4 transition" :class="{ 'rotate-180': openSubmenus[menu.id] }" />
                        </button>

                        <div v-if="openSubmenus[menu.id]" class="mt-3 border-l-2 border-primary/20 pl-4">
                            <Link
                                v-for="child in menu.children"
                                :key="child.id"
                                :href="child.link"
                                class="block rounded-r-lg px-3 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary"
                                @click="closeMobileMenu"
                            >
                                {{ child.name }}
                            </Link>
                        </div>
                    </div>
                </div>

                <div v-if="menus.length === 0" class="py-8 text-center text-sm text-slate-500">
                    Chưa có menu hiển thị.
                </div>
            </nav>

            <div class="border-t border-slate-100 bg-slate-50 p-5">
                <Link href="/tu-van" class="btn btn-secondary w-full rounded-xl font-bold" @click="closeMobileMenu">
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
