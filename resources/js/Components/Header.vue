<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import ZaloIcon from '@/Components/ZaloIcon.vue';
import { 
    Phone, 
    Mail, 
    Facebook, 
    Instagram, 
    Youtube, 
    ChevronDown, 
    ChevronUp, 
    Menu as MenuIcon, 
    X, 
    Headphones
} from 'lucide-vue-next';

const isMenuOpen = ref(false);
const activeSubMenu = ref(null);

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});
const menus = computed(() => page.props.globalMenus || []);
const zaloLink = computed(() => {
    const value = (settings.value.site_zalo || '').replace(/\s+/g, '');
    return value.startsWith('http') ? value : `https://zalo.me/${value}`;
});

const toggleSubMenu = (menuId) => {
    activeSubMenu.value = activeSubMenu.value === menuId ? null : menuId;
};

const closeMenu = () => {
    isMenuOpen.value = false;
    activeSubMenu.value = null;
};
</script>

<template>
    <!-- Top Bar -->
    <div class="hidden md:block w-full bg-slate-900 text-slate-300 py-2.5">
        <div class="container mx-auto px-4 flex justify-between items-center text-xs tracking-wide">
            <div class="flex items-center space-x-6">
                <div class="flex items-center group cursor-pointer">
                    <Phone class="w-3.5 h-3.5 mr-2 text-primary group-hover:animate-pulse" />
                    <a :href="'tel:' + settings.site_phone" class="hover:text-white transition-colors duration-200 font-medium">
                        {{ settings.site_phone }}
                    </a>
                </div>
                <div class="flex items-center group">
                    <Mail class="w-3.5 h-3.5 mr-2 text-primary group-hover:scale-110 transition-transform" />
                    <span class="group-hover:text-white transition-colors cursor-default">
                        Email: <strong class="text-white font-semibold ml-1">{{ settings.site_email }}</strong>
                    </span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3.5">
                    <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="hover:text-white transition-colors duration-200" title="Facebook">
                        <Facebook class="w-4 h-4" />
                    </a>
                    <a v-if="settings.site_instagram" :href="settings.site_instagram" target="_blank" class="hover:text-white transition-colors duration-200" title="Instagram">
                        <Instagram class="w-4 h-4" />
                    </a>
                    <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="hover:text-white transition-colors duration-200" title="Youtube">
                        <Youtube class="w-4 h-4" />
                    </a>
                    <a v-if="settings.site_zalo" :href="zaloLink" target="_blank" class="hover:text-white transition-colors duration-200 flex items-center gap-1 font-semibold" title="Zalo">
                        <ZaloIcon class="w-4 h-4 text-[#0068FF]" />
                        <span>ZALO</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="sticky top-0 z-[100] w-full bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-100">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <Link href="/" class="block group">
                    <img :src="settings.site_logo || '/images/logo.png'" 
                         :alt="settings.site_name || 'TECOTECH'" 
                         class="h-10 md:h-14 transition-transform duration-300 group-hover:scale-105">
                </Link>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center space-x-1">
                <div v-for="menu in menus" :key="menu.id" class="relative group">
                    <template v-if="!menu.children || menu.children.length === 0">
                        <Link :href="menu.link" 
                              class="px-4 py-2 text-[13px] font-bold text-slate-700 uppercase tracking-wide hover:text-primary transition-colors duration-200 relative after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                            {{ menu.name }}
                        </Link>
                    </template>
                    
                    <template v-else>
                        <div class="relative group/sub">
                            <button class="px-4 py-2 text-[13px] font-bold text-slate-700 uppercase tracking-wide hover:text-primary flex items-center transition-colors duration-200">
                                {{ menu.name }}
                                <ChevronDown class="ml-1 w-3.5 h-3.5 transition-transform duration-300 group-hover/sub:rotate-180" />
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute left-0 mt-0 pt-2 w-72 invisible opacity-0 translate-y-2 group-hover/sub:visible group-hover/sub:opacity-100 group-hover/sub:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-white shadow-xl rounded-xl border border-slate-100 overflow-hidden py-2">
                                    <Link v-for="child in menu.children" 
                                          :key="child.id" 
                                          :href="child.link" 
                                          class="block px-6 py-3.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary border-l-4 border-transparent hover:border-primary transition-all duration-200">
                                        {{ child.name }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                
                <div class="ml-6">
                    <Link href="/tu-van" class="btn btn-secondary btn-sm rounded-xl normal-case font-bold px-6 h-10 hover:shadow-lg hover:shadow-secondary/20 transition-all duration-300">
                        <Headphones class="w-4 h-4 mr-2" />
                        Tư vấn miễn phí
                    </Link>
                </div>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button @click="isMenuOpen = !isMenuOpen" 
                    type="button"
                    class="relative z-[130] lg:hidden p-2 rounded-lg text-slate-700 hover:bg-slate-100 transition-colors focus:outline-none"
                    :aria-expanded="isMenuOpen"
                    aria-label="Toggle menu">
                <MenuIcon v-if="!isMenuOpen" class="w-6 h-6" />
                <X v-else class="w-6 h-6" />
            </button>
        </div>

    </header>

    <div
        v-show="isMenuOpen"
        class="fixed inset-x-0 bottom-0 top-[64px] z-[110] bg-slate-950/60 backdrop-blur-sm lg:hidden"
        @click="closeMenu"
    ></div>

    <aside
        class="fixed bottom-0 right-0 top-[64px] z-[120] flex w-[min(88vw,360px)] flex-col bg-white shadow-2xl transition-transform duration-300 ease-in-out lg:hidden"
        :class="isMenuOpen ? 'translate-x-0' : 'translate-x-full'"
        aria-label="Menu mobile"
    >
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <Link href="/" class="block" @click="closeMenu">
                <img
                    :src="settings.site_logo || '/images/logo.png'"
                    :alt="settings.site_name || 'TECOTECH'"
                    class="h-11 w-auto"
                >
            </Link>
            <button type="button" class="rounded-lg p-2 text-slate-700 hover:bg-slate-100" aria-label="Đóng menu" @click="closeMenu">
                <X class="h-6 w-6" />
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-5 py-4">
            <div v-for="menu in menus" :key="menu.id" class="border-b border-slate-100 last:border-0">
                <template v-if="!menu.children || menu.children.length === 0">
                    <Link
                        :href="menu.link"
                        @click="closeMenu"
                        class="block py-4 text-sm font-bold uppercase tracking-wider text-slate-800 hover:text-primary"
                    >
                        {{ menu.name }}
                    </Link>
                </template>

                <template v-else>
                    <div class="py-4">
                        <button
                            type="button"
                            @click="toggleSubMenu(menu.id)"
                            class="flex w-full items-center justify-between text-left text-sm font-bold uppercase tracking-wider text-slate-800 hover:text-primary"
                        >
                            <span>{{ menu.name }}</span>
                            <ChevronDown class="h-4 w-4 transition-transform duration-300" :class="activeSubMenu === menu.id ? 'rotate-180' : ''" />
                        </button>
                        <div v-show="activeSubMenu === menu.id" class="mt-3 border-l-2 border-primary/20 pl-4">
                            <Link
                                v-for="child in menu.children"
                                :key="child.id"
                                :href="child.link"
                                @click="closeMenu"
                                class="block rounded-r-lg px-3 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-primary"
                            >
                                {{ child.name }}
                            </Link>
                        </div>
                    </div>
                </template>
            </div>

            <div v-if="menus.length === 0" class="py-8 text-center text-sm text-slate-500">
                Chưa có menu hiển thị.
            </div>
        </div>

        <div class="border-t border-slate-100 bg-slate-50 p-5">
            <Link href="/tu-van" @click="closeMenu" class="btn btn-secondary w-full rounded-xl font-bold gap-2">
                <Headphones class="w-5 h-5" />
                Tư vấn miễn phí
            </Link>
            <div class="mt-5 flex justify-center space-x-6 text-slate-500">
                <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="hover:text-primary"><Facebook class="w-5 h-5" /></a>
                <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="hover:text-primary"><Youtube class="w-5 h-5" /></a>
                <a v-if="settings.site_zalo" :href="zaloLink" target="_blank" class="flex items-center gap-1 text-xs font-bold hover:text-primary">
                    <ZaloIcon class="w-5 h-5 text-[#0068FF]" />
                    <span>ZALO</span>
                </a>
            </div>
        </div>
    </aside>
</template>
