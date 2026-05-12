<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { 
    MapPin, 
    Phone, 
    Mail, 
    Send,
    Facebook,
    Youtube,
    Instagram
} from 'lucide-vue-next';

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});

const phoneHref = computed(() => `tel:${(settings.value.site_phone || '').replace(/\s+/g, '')}`);
const emailHref = computed(() => `mailto:${settings.value.site_email}`);

const form = ref({
    name: '',
    phone: '',
    email: '',
    service: '',
    content: ''
});

const submit = () => {
    // Implement form submission logic here
    alert('Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể!');
};
</script>

<template>
    <MainLayout :title="'Liên hệ - ' + (settings.site_name || 'TECOTECH')">
        <InnerHero 
            title="Liên hệ với chúng tôi" 
            subtitle="TECOTECH luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của quý khách hàng."
            backgroundImage="https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg"
        />

        <section class="py-24 bg-slate-50">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100">
                    
                    <!-- Contact Information (Left Side) -->
                    <div class="lg:col-span-2 bg-slate-900 text-white p-12 relative overflow-hidden flex flex-col justify-between">
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-primary opacity-10 blur-3xl"></div>
                        
                        <div class="relative z-10">
                            <h2 class="text-3xl font-bold mb-4">Thông tin liên hệ</h2>
                            <p class="text-slate-400 mb-12 text-base font-normal">Điền vào biểu mẫu hoặc liên hệ trực tiếp với chúng tôi qua các kênh dưới đây.</p>
                            
                            <div class="space-y-10">
                                <div class="flex items-start group">
                                    <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all duration-300 border border-white/10">
                                        <MapPin class="w-6 h-6" />
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="font-bold text-sm uppercase tracking-widest text-primary mb-2">Trụ sở chính</h4>
                                        <p class="text-base text-slate-300 leading-relaxed font-normal">{{ settings.site_headquarters || settings.site_address }}</p>
                                    </div>
                                </div>
                                
                                <div v-if="settings.site_phone" class="flex items-start group">
                                    <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all duration-300 border border-white/10">
                                        <Phone class="w-6 h-6" />
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="font-bold text-sm uppercase tracking-widest text-primary mb-2">Hotline</h4>
                                        <a :href="phoneHref" class="text-2xl font-bold text-white hover:text-primary transition-colors">{{ settings.site_phone }}</a>
                                    </div>
                                </div>

                                <div v-if="settings.site_email" class="flex items-start group">
                                    <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all duration-300 border border-white/10">
                                        <Mail class="w-6 h-6" />
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="font-bold text-sm uppercase tracking-widest text-primary mb-2">Email</h4>
                                        <a :href="emailHref" class="text-base text-slate-300 hover:text-white transition-colors font-normal">{{ settings.site_email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative z-10 mt-16 flex space-x-5">
                            <a v-if="settings.site_facebook" :href="settings.site_facebook" target="_blank" class="w-11 h-11 rounded-xl bg-white/5 flex items-center justify-center hover:bg-primary transition-all duration-300 border border-white/10">
                                <Facebook class="w-5 h-5" />
                            </a>
                            <a v-if="settings.site_youtube" :href="settings.site_youtube" target="_blank" class="w-11 h-11 rounded-xl bg-white/5 flex items-center justify-center hover:bg-primary transition-all duration-300 border border-white/10">
                                <Youtube class="w-5 h-5" />
                            </a>
                            <a v-if="settings.site_instagram" :href="settings.site_instagram" target="_blank" class="w-11 h-11 rounded-xl bg-white/5 flex items-center justify-center hover:bg-primary transition-all duration-300 border border-white/10">
                                <Instagram class="w-5 h-5" />
                            </a>
                        </div>
                    </div>

                    <!-- Contact Form (Right Side) -->
                    <div class="lg:col-span-3 p-12 lg:p-16">
                        <div class="mb-10">
                            <h2 class="text-3xl font-bold text-slate-900 mb-3">Gửi tin nhắn cho chúng tôi</h2>
                            <p class="text-slate-500 font-normal">Chúng tôi sẽ phản hồi yêu cầu của bạn trong vòng 24h làm việc.</p>
                        </div>
                        
                        <form @submit.prevent="submit" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Họ và tên *</label>
                                    <input v-model="form.name" type="text" required class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-slate-50 focus:bg-white outline-none font-normal" placeholder="Nhập họ và tên của bạn">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Số điện thoại *</label>
                                    <input v-model="form.phone" type="tel" required class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-slate-50 focus:bg-white outline-none font-normal" placeholder="Nhập số điện thoại">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Email *</label>
                                    <input v-model="form.email" type="email" required class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-slate-50 focus:bg-white outline-none font-normal" placeholder="Nhập địa chỉ email">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Dịch vụ quan tâm</label>
                                    <div class="relative">
                                        <select v-model="form.service" class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-slate-50 focus:bg-white outline-none font-normal appearance-none">
                                            <option value="">-- Chọn dịch vụ --</option>
                                            <option value="Xử lý nước thải">Xử lý nước thải</option>
                                            <option value="Xử lý khí thải">Xử lý khí thải</option>
                                            <option value="Gia công cơ khí">Gia công cơ khí</option>
                                            <option value="Tư vấn môi trường">Tư vấn môi trường</option>
                                        </select>
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                            <i class="fas fa-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest">Nội dung tin nhắn</label>
                                <textarea v-model="form.content" rows="4" class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all bg-slate-50 focus:bg-white outline-none resize-none font-normal" placeholder="Bạn cần chúng tôi hỗ trợ gì?"></textarea>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-full md:w-auto px-12 rounded-xl font-bold shadow-xl shadow-primary/20 flex items-center justify-center gap-3">
                                    <Send class="w-5 h-5" /> Gửi yêu cầu ngay
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="h-[500px] w-full grayscale contrast-125 opacity-90 hover:grayscale-0 hover:opacity-100 transition-all duration-700 overflow-hidden contact-map" v-html="settings.site_google_map">
        </section>
    </MainLayout>
</template>

<style scoped>
.contact-map :deep(iframe) {
    width: 100% !important;
    height: 100% !important;
}
</style>