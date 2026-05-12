<script setup>
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import AppHead from '@/Components/AppHead.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    title: String,
    description: String,
    keywords: String,
    image: String,
    canonical: String,
});

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});
const buttonClass = 'w-12 h-12 bg-primary rounded-full flex items-center justify-center shadow-lg text-white hover:bg-primary-dark hover:scale-110 transition duration-300';
const phoneHref = computed(() => `tel:${(settings.value.site_phone || '').replace(/\s+/g, '')}`);
const zaloHref = computed(() => {
    const value = settings.value.site_zalo || '';
    return value.startsWith('http') ? value : `https://zalo.me/${value}`;
});
const scrollTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

<template>
    <div>
        <AppHead 
            :title="title" 
            :description="description" 
            :keywords="keywords" 
            :image="image" 
            :canonical="canonical" 
            :robots="robots"
        />

        <div class="min-h-screen bg-gray-50 flex flex-col">
            <Header />

            <main class="flex-grow">
                <slot />
            </main>

            <Footer />
        </div>

        <div class="fixed bottom-6 right-6 z-50 flex flex-col space-y-3">
            <a v-if="settings.site_phone" :href="phoneHref" :class="buttonClass" aria-label="Gọi điện">
                <i class="fas fa-phone-alt text-lg"></i>
            </a>
            <a v-if="settings.site_zalo" :href="zaloHref" target="_blank" :class="buttonClass" aria-label="Zalo">
                <img v-if="settings.floating_zalo_image" :src="settings.floating_zalo_image" alt="Zalo" class="h-7 w-7 object-contain" />
                <span v-else class="text-xs font-bold">Zalo</span>
            </a>
            <a v-if="settings.site_messenger" :href="settings.site_messenger" target="_blank" :class="buttonClass" aria-label="Messenger">
                <img v-if="settings.floating_messenger_image" :src="settings.floating_messenger_image" alt="Messenger" class="h-7 w-7 object-contain" />
                <i v-else class="fab fa-facebook-messenger text-xl"></i>
            </a>
            <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" :class="buttonClass" aria-label="Facebook">
                <img v-if="settings.floating_facebook_image" :src="settings.floating_facebook_image" alt="Facebook" class="h-7 w-7 object-contain" />
                <i v-else class="fab fa-facebook-f text-xl"></i>
            </a>
            <button v-if="settings.floating_back_to_top" type="button" :class="buttonClass" aria-label="Lên đầu trang" @click="scrollTop">
                <i class="fas fa-chevron-up text-lg"></i>
            </button>
        </div>
    </div>
</template>
