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
                    class="lg:hidden p-2 rounded-lg text-slate-700 hover:bg-slate-100 transition-colors focus:outline-none"
                    aria-label="Toggle menu">
                <MenuIcon v-if="!isMenuOpen" class="w-6 h-6" />
                <X v-else class="w-6 h-6" />
            </button>
        </div>

        <!-- Mobile Menu Drawer (Overlay style) -->
        <div v-if="isMenuOpen" 
             class="fixed inset-0 top-[65px] z-50 bg-slate-900/50 backdrop-blur-sm lg:hidden transition-opacity duration-300"
             @click="isMenuOpen = false">
        </div>
        
        <div class="fixed top-[65px] right-0 bottom-0 w-[300px] bg-white z-[60] lg:hidden shadow-2xl transform transition-transform duration-300 ease-in-out"
             :class="isMenuOpen ? 'translate-x-0' : 'translate-x-full'">
            <div class="h-full flex flex-col overflow-y-auto">
                <div class="p-6 space-y-2">
                    <div v-for="menu in menus" :key="menu.id" class="border-b border-slate-50 last:border-0">
                        <template v-if="!menu.children || menu.children.length === 0">
                            <Link :href="menu.link" 
                                  @click="isMenuOpen = false"
                                  class="block py-4 text-sm font-bold text-slate-700 uppercase tracking-wider hover:text-primary transition-colors">
                                {{ menu.name }}
                            </Link>
                        </template>
                        <template v-else>
                            <div class="py-4">
                                <button @click="toggleSubMenu(menu.id)" 
                                        class="flex justify-between items-center w-full text-sm font-bold text-slate-700 uppercase tracking-wider hover:text-primary transition-colors focus:outline-none">
                                    {{ menu.name }}
                                    <ChevronDown class="w-4 h-4 transition-transform duration-300" :class="activeSubMenu === menu.id ? 'rotate-180' : ''" />
                                </button>
                                <div v-show="activeSubMenu === menu.id" class="mt-2 ml-4 space-y-1 border-l-2 border-slate-100">
                                    <Link v-for="child in menu.children" 
                                          :key="child.id" 
                                          :href="child.link" 
                                          @click="isMenuOpen = false"
                                          class="block py-3 px-4 text-sm font-semibold text-slate-500 hover:text-primary hover:bg-slate-50 transition-all rounded-r-lg">
                                        {{ child.name }}
                                    </Link>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                
                <div class="mt-auto p-6 bg-slate-50">
                    <Link href="/tu-van" 
                          @click="isMenuOpen = false"
                          class="btn btn-secondary w-full rounded-xl font-bold gap-2">
                        <Headphones class="w-5 h-5" />
                        Tư vấn miễn phí
                    </Link>
                    <div class="mt-6 flex justify-center space-x-6 text-slate-400">
                        <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="hover:text-primary transition-colors"><Facebook class="w-5 h-5" /></a>
                        <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="hover:text-primary transition-colors"><Youtube class="w-5 h-5" /></a>
                        <a v-if="settings.site_zalo" :href="zaloLink" target="_blank" class="hover:text-primary transition-colors flex items-center gap-1 font-bold text-xs">
                            <ZaloIcon class="w-5 h-5 text-[#0068FF]" />
                            <span>ZALO</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
