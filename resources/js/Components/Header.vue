<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const isMenuOpen = ref(false);
const activeSubMenu = ref(null);

const page = usePage();
const settings = computed(() => page.props.globalSettings);
const menus = computed(() => page.props.globalMenus);
const zaloLink = computed(() => {
    const value = settings.value.site_zalo || '';
    return value.startsWith('http') ? value : `https://zalo.me/${value}`;
});

const toggleSubMenu = (menu) => {
    activeSubMenu.value = activeSubMenu.value === menu ? null : menu;
};
</script>

<template>
    <!-- Top Bar -->
    <div class="w-full bg-gray-100 py-2 border-b border-gray-200">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
            <div class="flex items-center space-x-4 mb-2 md:mb-0">
                <div class="flex items-center">
                    <i class="fas fa-phone-alt mr-2 text-primary"></i>
                    <a :href="'tel:' + settings.site_phone" class="hover:text-primary font-semibold">{{ settings.site_phone }}</a>
                </div>
                <div class="hidden sm:flex items-center">
                    <i class="far fa-envelope mr-2 text-primary"></i>
                    <span>Email: <strong class="text-gray-800">{{ settings.site_email }}</strong></span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 pr-4">
                    <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="hover:text-primary"><i class="fab fa-facebook-f"></i></a>
                    <a v-if="settings.site_instagram" :href="settings.site_instagram" target="_blank" class="hover:text-primary"><i class="fab fa-instagram"></i></a>
                    <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="hover:text-primary"><i class="fab fa-youtube"></i></a>
                    <a v-if="settings.site_zalo" :href="zaloLink" target="_blank" class="hover:text-primary">Zalo</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-50 w-full bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <Link href="/">
                    <img :src="settings.site_logo || '/images/logo.png'" :alt="settings.site_name || 'TECOTECH'" class="h-12 md:h-16">
                </Link>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center space-x-6 font-bold text-gray-800 uppercase text-sm">
                <div v-for="menu in menus" :key="menu.id" class="relative group">
                    <Link v-if="!menu.children || menu.children.length === 0" :href="menu.link" class="hover:text-primary py-2 block">
                        {{ menu.name }}
                    </Link>
                    
                    <div v-else class="relative">
                        <Link :href="menu.link || '#'" class="hover:text-primary flex items-center py-2">
                            {{ menu.name }}
                            <i class="fas fa-chevron-down ml-1 text-[10px]"></i>
                        </Link>
                        <div class="absolute left-0 mt-0 w-64 bg-white shadow-lg border-t-2 border-primary hidden group-hover:block z-50">
                            <Link v-for="child in menu.children" :key="child.id" :href="child.link" class="block px-4 py-3 hover:bg-primary hover:text-white normal-case font-medium border-b border-gray-100 last:border-0">
                                {{ child.name }}
                            </Link>
                        </div>
                    </div>
                </div>
                
                <div class="ml-4">
                    <a href="/tu-van" class="bg-secondary hover:bg-orange-600 text-white px-4 py-2 rounded-full flex items-center transition duration-300">
                        <i class="fas fa-headset mr-2 text-lg"></i>
                        <span class="normal-case">Tư vấn miễn phí</span>
                    </a>
                </div>
            </nav>

            <!-- Mobile Menu Button -->
            <button @click="isMenuOpen = !isMenuOpen" class="lg:hidden text-gray-800 focus:outline-none">
                <i class="fas fa-bars text-2xl" v-if="!isMenuOpen"></i>
                <i class="fas fa-times text-2xl" v-else></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div v-show="isMenuOpen" class="lg:hidden bg-white border-t border-gray-200 py-4 px-4 space-y-2 uppercase font-bold text-sm">
            <div v-for="menu in menus" :key="menu.id">
                <div v-if="!menu.children || menu.children.length === 0">
                    <Link :href="menu.link" class="block py-2 border-b border-gray-100 hover:text-primary">{{ menu.name }}</Link>
                </div>
                <div v-else>
                    <div @click="toggleSubMenu(menu.id)" class="flex justify-between items-center py-2 border-b border-gray-100 hover:text-primary cursor-pointer">
                        {{ menu.name }}
                        <i class="fas" :class="activeSubMenu === menu.id ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </div>
                    <div v-show="activeSubMenu === menu.id" class="pl-4 bg-gray-50 normal-case font-medium">
                        <Link v-for="child in menu.children" :key="child.id" :href="child.link" class="block py-2 border-b border-gray-200 last:border-0">
                            {{ child.name }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
