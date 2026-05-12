<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Link, Head } from '@inertiajs/vue3';
import { 
    Droplets, 
    Wind, 
    Waves, 
    Activity, 
    ArrowRight,
    Phone
} from 'lucide-vue-next';

defineProps({
    title: {
        type: String,
        default: 'Dịch vụ Môi trường'
    },
    subtitle: {
        type: String,
        default: 'Cung cấp các giải pháp tối ưu cho xử lý nước thải, khí thải và nước cấp.'
    }
});

const services = [
    {
        id: 1,
        title: 'Xử lý nước thải',
        desc: 'Thiết kế, thi công hệ thống xử lý nước thải sinh hoạt, công nghiệp, y tế với công nghệ hiện đại, tự động hóa cao.',
        image: 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
        icon: Droplets,
        color: 'text-blue-600',
        bg: 'bg-blue-50'
    },
    {
        id: 2,
        title: 'Xử lý khí thải',
        desc: 'Hệ thống xử lý bụi, mùi, khí độc hại từ các nhà máy sản xuất, đảm bảo tiêu chuẩn khí thải ra môi trường.',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg',
        icon: Wind,
        color: 'text-indigo-600',
        bg: 'bg-indigo-50'
    },
    {
        id: 3,
        title: 'Xử lý nước cấp',
        desc: 'Cung cấp hệ thống lọc nước sạch, nước tinh khiết phục vụ sinh hoạt và sản xuất công nghiệp.',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420726.jpg',
        icon: Waves,
        color: 'text-cyan-600',
        bg: 'bg-cyan-50'
    },
    {
        id: 4,
        title: 'Quan trắc môi trường',
        desc: 'Dịch vụ quan trắc, lập báo cáo giám sát môi trường định kỳ cho các doanh nghiệp và khu công nghiệp.',
        image: 'https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg',
        icon: Activity,
        color: 'text-emerald-600',
        bg: 'bg-emerald-50'
    }
];
</script>

<template>
    <MainLayout :title="title + ' - TECOTECH'">
        <InnerHero 
            :title="title" 
            :subtitle="subtitle"
            backgroundImage="https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg"
        />

        <section class="py-24 bg-slate-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
                    <span class="text-primary font-bold tracking-widest uppercase text-xs">Lĩnh vực hoạt động</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-slate-900">Giải pháp toàn diện cho doanh nghiệp</h2>
                    <p class="text-slate-500 text-lg font-normal">Chúng tôi cam kết mang lại hiệu quả cao nhất với chi phí đầu tư và vận hành hợp lý, đáp ứng mọi quy chuẩn của pháp luật.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Service Cards -->
                    <div v-for="service in services" :key="service.id" class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col lg:flex-row">
                        <div class="lg:w-2/5 h-64 lg:h-auto relative overflow-hidden">
                            <img :src="service.image" :alt="service.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-transparent transition-colors duration-500"></div>
                        </div>
                        <div class="lg:w-3/5 p-10 flex flex-col justify-center">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-6 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6 shadow-sm" :class="[service.bg, service.color]">
                                <component :is="service.icon" class="w-6 h-6" />
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-primary transition-colors">{{ service.title }}</h3>
                            <p class="text-slate-500 mb-8 leading-relaxed font-normal">{{ service.desc }}</p>
                            <Link href="#" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-primary group/link">
                                Tìm hiểu chi tiết 
                                <ArrowRight class="w-4 h-4 group-hover/link:translate-x-2 transition-transform" />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-slate-900 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80" class="w-full h-full object-cover" />
            </div>
            
            <div class="container relative mx-auto px-4 z-10 text-center">
                <div class="max-w-3xl mx-auto space-y-8">
                    <h2 class="text-3xl md:text-4xl font-bold text-white">Bạn cần tư vấn giải pháp phù hợp?</h2>
                    <p class="text-slate-400 text-lg font-normal opacity-80">Đội ngũ kỹ sư chuyên gia của chúng tôi luôn sẵn sàng khảo sát thực tế và đưa ra phương án tối ưu nhất cho dự án của bạn.</p>
                    <div class="pt-6 flex justify-center gap-6 flex-wrap">
                        <Link href="/lien-he" class="btn btn-primary btn-lg rounded-xl px-12 font-bold shadow-xl shadow-primary/20">
                            Liên hệ ngay
                        </Link>
                        <a href="tel:0923392868" class="btn bg-white/5 hover:bg-white/10 backdrop-blur-md text-white border-white/10 hover:border-white/20 btn-lg rounded-xl px-12 font-bold flex items-center gap-2">
                            <Phone class="w-5 h-5" /> 0923 392 868
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
