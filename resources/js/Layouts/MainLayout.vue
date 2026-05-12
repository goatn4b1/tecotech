<script setup>
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import AppHead from '@/Components/AppHead.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ZaloIcon from '@/Components/ZaloIcon.vue';
import { 
    Phone, 
    Facebook, 
    ChevronUp,
    MessageSquare
} from 'lucide-vue-next';

defineProps({
    title: String,
    description: String,
    keywords: String,
    image: String,
    canonical: String,
    robots: String,
});

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});
const buttonClass = 'group w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-xl text-primary hover:bg-primary hover:text-white hover:-translate-y-1 transition-all duration-300 border border-slate-100';
const primaryButtonClass = 'group w-12 h-12 bg-primary rounded-full flex items-center justify-center shadow-xl text-white hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300';

const phoneHref = computed(() => `tel:${(settings.value.site_phone || '').replace(/\s+/g, '')}`);
const zaloLink = computed(() => {
    const value = (settings.value.site_zalo || '').replace(/\s+/g, '');
    return value.startsWith('http') ? value : `https://zalo.me/${value}`;
});
const scrollTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

<template>
    <div class="selection:bg-primary/20 selection:text-primary">
        <AppHead 
            :title="title" 
            :description="description" 
            :keywords="keywords" 
            :image="image" 
            :canonical="canonical" 
            :robots="robots"
        />

        <div class="min-h-screen bg-slate-50 flex flex-col font-sans">
            <Header />

            <main class="flex-grow">
                <slot />
            </main>

            <Footer />
        </div>

        <!-- Floating Action Buttons -->
        <div class="fixed bottom-8 right-6 z-50 flex flex-col space-y-4">
            <button 
                v-if="settings.floating_back_to_top && (settings.site_phone || settings.site_zalo || settings.site_messenger || settings.site_facebook)" 
                type="button" 
                :class="buttonClass" 
                aria-label="Lên đầu trang" 
                @click="scrollTop"
            >
                <ChevronUp class="w-5 h-5" />
            </button>

            <a v-if="settings.site_phone" :href="phoneHref" :class="primaryButtonClass" aria-label="Gọi điện">
                <Phone class="w-5 h-5 group-hover:animate-bounce" />
            </a>

            <a v-if="settings.site_zalo" :href="zaloLink" target="_blank" :class="buttonClass" aria-label="Zalo">
                <ZaloIcon class="w-5 h-5" />
            </a>

            <a v-if="settings.site_messenger" :href="settings.site_messenger" target="_blank" :class="buttonClass" aria-label="Messenger">
                <MessageSquare class="w-5 h-5" />
            </a>

            <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" :class="buttonClass" aria-label="Facebook">
                <Facebook class="w-5 h-5" />
            </a>        </div>
    </div>
</template>
