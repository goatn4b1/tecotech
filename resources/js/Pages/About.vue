<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <MainLayout title="Giới thiệu - TECOTECH">
        <InnerHero 
            title="Về TECOTECH" 
            subtitle="Hơn 25 năm đồng hành cùng sự phát triển bền vững của môi trường và công nghiệp Việt Nam."
            backgroundImage="https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp"
        />

        <!-- Story Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row gap-16 items-center">
                    <div class="lg:w-1/2 relative">
                        <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                            <img src="https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp" alt="Về chúng tôi" class="w-full h-auto object-cover">
                        </div>
                        <div class="absolute -bottom-8 -right-8 w-2/3 rounded-2xl overflow-hidden shadow-xl border-4 border-white z-20 hidden md:block">
                            <img src="https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp" alt="Công trình" class="w-full h-auto object-cover">
                        </div>
                        <!-- Decorative element -->
                        <div class="absolute -top-6 -left-6 w-32 h-32 bg-secondary/10 rounded-full blur-2xl z-0"></div>
                    </div>
                    
                    <div class="lg:w-1/2 space-y-6">
                        <div class="inline-block px-4 py-1 bg-primary/10 text-primary font-semibold rounded-full text-sm uppercase tracking-wide">
                            Câu chuyện của chúng tôi
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight">
                            Tổng thầu EPC hàng đầu về xử lý môi trường tại Việt Nam
                        </h2>
                        <p class="text-gray-600 text-lg leading-relaxed text-justify">
                            <strong class="text-primary">Công ty TNHH TMDV Công Nghệ Kĩ Thuật Môi Trường và Đô Thị TECOTECH</strong> tự hào là đơn vị tiên phong chuyên cung cấp các giải pháp toàn diện về xử lý nước thải, xử lý khí thải, và xử lý nước cấp.
                        </p>
                        <p class="text-gray-600 leading-relaxed text-justify">
                            Bên cạnh đó, chúng tôi là đối tác tin cậy trong lĩnh vực sản xuất, gia công, chế tạo các thiết bị cơ khí phi tiêu chuẩn phục vụ cho ngành hóa chất, sản xuất đồ uống, thực phẩm, thủy hải sản và các công trình thủy lợi. Với nhà máy sản xuất quy mô lớn tại hai miền Nam Bắc, chúng tôi cam kết mang đến sản phẩm chất lượng cao nhất với tiến độ nhanh nhất.
                        </p>
                        
                        <div class="pt-6 grid grid-cols-2 gap-6 border-t border-gray-100">
                            <div>
                                <h4 class="text-4xl font-extrabold text-secondary mb-2">25+</h4>
                                <p class="text-gray-600 font-medium">Năm kinh nghiệm</p>
                            </div>
                            <div>
                                <h4 class="text-4xl font-extrabold text-primary mb-2">500+</h4>
                                <p class="text-gray-600 font-medium">Dự án hoàn thành</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values (Modern Cards) -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 uppercase tracking-wider mb-4">Giá trị cốt lõi</h2>
                    <div class="w-16 h-1 bg-primary mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-300">
                            <i class="fas fa-gem text-2xl text-primary group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Chất lượng vượt trội</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Mỗi dự án và sản phẩm cơ khí đều được kiểm soát nghiêm ngặt, đảm bảo tuổi thọ cao và hoạt động ổn định trong mọi điều kiện môi trường.
                        </p>
                    </div>

                    <!-- Value 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-secondary transition-colors duration-300">
                            <i class="fas fa-leaf text-2xl text-secondary group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Phát triển bền vững</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Giải pháp của chúng tôi hướng tới việc bảo vệ hệ sinh thái, giảm thiểu tác động tiêu cực và tạo ra giá trị lâu dài cho cộng đồng.
                        </p>
                    </div>

                    <!-- Value 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="w-16 h-16 bg-success/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-success transition-colors duration-300">
                            <i class="fas fa-handshake text-2xl text-success group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Đồng hành tin cậy</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Luôn lắng nghe và thấu hiểu nhu cầu của khách hàng, từ tư vấn thiết kế đến chuyển giao công nghệ và bảo hành bảo trì trọn đời.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
