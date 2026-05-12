<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

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
    <MainLayout title="Liên hệ - TECOTECH">
        <InnerHero 
            title="Liên hệ với chúng tôi" 
            subtitle="TECOTECH luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của quý khách hàng."
            backgroundImage="https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg"
        />

        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-8 bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                    
                    <!-- Contact Information (Left Side) -->
                    <div class="lg:col-span-2 bg-primary text-white p-10 relative overflow-hidden flex flex-col justify-between">
                        <!-- Decorative circles -->
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10"></div>
                        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-white opacity-10"></div>
                        
                        <div class="relative z-10">
                            <h2 class="text-3xl font-bold mb-2">Thông tin liên hệ</h2>
                            <p class="text-primary-100 mb-10 text-sm opacity-90">Điền vào biểu mẫu hoặc liên hệ trực tiếp với chúng tôi qua các thông tin dưới đây.</p>
                            
                            <div class="space-y-8">
                                <div class="flex items-start group">
                                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center flex-shrink-0 group-hover:bg-white group-hover:text-primary transition-all duration-300">
                                        <i class="fas fa-map-marker-alt text-xl"></i>
                                    </div>
                                    <div class="ml-4 mt-1">
                                        <h4 class="font-bold text-lg mb-1">Trụ sở chính</h4>
                                        <p class="text-sm opacity-90">Ô 15 lô B KĐT Đại Kim - Định Công, P. Định Công, TP. Hà Nội</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start group">
                                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center flex-shrink-0 group-hover:bg-white group-hover:text-primary transition-all duration-300">
                                        <i class="fas fa-phone-alt text-xl"></i>
                                    </div>
                                    <div class="ml-4 mt-1">
                                        <h4 class="font-bold text-lg mb-1">Hotline</h4>
                                        <p class="text-sm opacity-90">0923 392 868</p>
                                    </div>
                                </div>

                                <div class="flex items-start group">
                                    <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center flex-shrink-0 group-hover:bg-white group-hover:text-primary transition-all duration-300">
                                        <i class="fas fa-envelope text-xl"></i>
                                    </div>
                                    <div class="ml-4 mt-1">
                                        <h4 class="font-bold text-lg mb-1">Email</h4>
                                        <p class="text-sm opacity-90">etm.ckmt@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative z-10 mt-12 flex space-x-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-primary transition-colors duration-300"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-primary transition-colors duration-300"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-primary transition-colors duration-300"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>

                    <!-- Contact Form (Right Side) -->
                    <div class="lg:col-span-3 p-10 lg:p-12">
                        <h2 class="text-2xl font-bold text-gray-800 mb-8">Gửi tin nhắn cho chúng tôi</h2>
                        
                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên *</label>
                                    <input v-model="form.name" type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-gray-50 focus:bg-white outline-none" placeholder="Nhập họ và tên của bạn">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại *</label>
                                    <input v-model="form.phone" type="tel" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-gray-50 focus:bg-white outline-none" placeholder="Nhập số điện thoại">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                    <input v-model="form.email" type="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-gray-50 focus:bg-white outline-none" placeholder="Nhập địa chỉ email">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dịch vụ quan tâm</label>
                                    <select v-model="form.service" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-gray-50 focus:bg-white outline-none">
                                        <option value="">-- Chọn dịch vụ --</option>
                                        <option value="Xử lý nước thải">Xử lý nước thải</option>
                                        <option value="Xử lý khí thải">Xử lý khí thải</option>
                                        <option value="Gia công cơ khí">Gia công cơ khí</option>
                                        <option value="Tư vấn môi trường">Tư vấn môi trường</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung tin nhắn</label>
                                <textarea v-model="form.content" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors bg-gray-50 focus:bg-white outline-none resize-none" placeholder="Bạn cần chúng tôi hỗ trợ gì?"></textarea>
                            </div>

                            <div class="pt-4 text-right">
                                <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <i class="fas fa-paper-plane mr-2"></i> Gửi yêu cầu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="h-96 w-full">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.1956108119777!2d105.82903731533165!3d20.984795986022067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac5df058b88d%3A0x6b772719d3a77884!2zS0RUICDEkOG6oWkgS2ltLCDEkOG7i25oIEPDtG5nLCBIb8OgbmcgTWFpLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
            ></iframe>
        </section>
    </MainLayout>
</template>
