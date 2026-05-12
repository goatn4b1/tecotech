<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Link, Head } from '@inertiajs/vue3';

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
        icon: 'fas fa-water',
        color: 'text-primary',
        bg: 'bg-primary/10'
    },
    {
        id: 2,
        title: 'Xử lý khí thải',
        desc: 'Hệ thống xử lý bụi, mùi, khí độc hại từ các nhà máy sản xuất, đảm bảo tiêu chuẩn khí thải ra môi trường.',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg',
        icon: 'fas fa-wind',
        color: 'text-secondary',
        bg: 'bg-secondary/10'
    },
    {
        id: 3,
        title: 'Xử lý nước cấp',
        desc: 'Cung cấp hệ thống lọc nước sạch, nước tinh khiết phục vụ sinh hoạt và sản xuất công nghiệp.',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420726.jpg',
        icon: 'fas fa-faucet',
        color: 'text-success',
        bg: 'bg-success/10'
    },
    {
        id: 4,
        title: 'Quan trắc môi trường',
        desc: 'Dịch vụ quan trắc, lập báo cáo giám sát môi trường định kỳ cho các doanh nghiệp và khu công nghiệp.',
        image: 'https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg',
        icon: 'fas fa-chart-line',
        color: 'text-blue-600',
        bg: 'bg-blue-100'
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

        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-primary font-bold tracking-wider uppercase text-sm mb-2 block">Lĩnh vực hoạt động</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-6">Giải pháp toàn diện cho doanh nghiệp</h2>
                    <p class="text-gray-600 text-lg">Chúng tôi cam kết mang lại hiệu quả cao nhất với chi phí đầu tư và vận hành hợp lý, đáp ứng mọi quy chuẩn của pháp luật.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-10">
                    <!-- Service Cards -->
                    <div v-for="service in services" :key="service.id" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col sm:flex-row">
                        <div class="sm:w-2/5 h-64 sm:h-auto relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                            <img :src="service.image" :alt="service.title" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            
                            <!-- Icon Float -->
                            <div class="absolute top-4 left-4 z-20 w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-lg">
                                <i :class="[service.icon, service.color, 'text-xl']"></i>
                            </div>
                        </div>
                        <div class="sm:w-3/5 p-8 flex flex-col justify-center relative">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-primary transition-colors">{{ service.title }}</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed flex-grow">{{ service.desc }}</p>
                            <div>
                                <Link href="#" class="inline-flex items-center text-sm font-bold uppercase tracking-wider text-primary group-hover:text-secondary transition-colors">
                                    Chi tiết <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-2 transition-transform"></i>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-primary relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-64 h-64 rounded-full bg-white opacity-5"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-64 h-64 rounded-full bg-white opacity-5"></div>
            
            <div class="container mx-auto px-4 relative z-10 text-center">
                <h2 class="text-3xl font-bold text-white mb-6">Bạn cần tư vấn giải pháp phù hợp?</h2>
                <p class="text-primary-100 mb-8 text-lg max-w-2xl mx-auto">Đội ngũ kỹ sư chuyên gia của chúng tôi luôn sẵn sàng khảo sát thực tế và đưa ra phương án tối ưu nhất cho dự án của bạn.</p>
                <div class="flex justify-center gap-4">
                    <Link href="/lien-he" class="bg-white text-primary font-bold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition-colors">
                        Liên hệ ngay
                    </Link>
                    <a href="tel:0923392868" class="bg-secondary text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-secondary-dark transition-colors flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i> 0923 392 868
                    </a>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
