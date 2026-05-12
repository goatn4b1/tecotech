<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Head } from '@inertiajs/vue3';
import { 
    Gem, 
    Leaf, 
    Handshake,
    ShieldCheck,
    Target,
    Award
} from 'lucide-vue-next';
</script>

<template>
    <MainLayout title="Giới thiệu - TECOTECH">
        <InnerHero 
            title="Về TECOTECH" 
            subtitle="Hơn 25 năm đồng hành cùng sự phát triển bền vững của môi trường và công nghiệp Việt Nam."
            backgroundImage="https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp"
        />

        <!-- Story Section -->
        <section class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row gap-20 items-center">
                    <div class="lg:w-1/2 relative">
                        <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                            <img src="https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp" alt="Về chúng tôi" class="w-full h-[500px] object-cover">
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-2/3 rounded-2xl overflow-hidden shadow-2xl border-4 border-white z-20 hidden md:block">
                            <img src="https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp" alt="Công trình" class="w-full h-auto object-cover">
                        </div>
                    </div>
                    
                    <div class="lg:w-1/2 space-y-8">
                        <div>
                            <span class="inline-block text-primary font-bold uppercase tracking-widest text-xs py-1 px-3 bg-primary/10 rounded-full">
                                Câu chuyện của chúng tôi
                            </span>
                            <h2 class="text-3xl md:text-5xl font-bold text-slate-900 leading-tight mt-4">
                                Tổng thầu EPC hàng đầu về xử lý môi trường
                            </h2>
                        </div>
                        
                        <div class="space-y-6 text-slate-600 text-lg leading-relaxed">
                            <p class="font-normal opacity-90">
                                <strong class="text-primary font-bold">TECOTECH</strong> tự hào là đơn vị tiên phong chuyên cung cấp các giải pháp toàn diện về xử lý nước thải, xử lý khí thải, và xử lý nước cấp chất lượng cao.
                            </p>
                            <p class="text-base font-normal opacity-80">
                                Chúng tôi là đối tác tin cậy trong lĩnh vực sản xuất, gia công, chế tạo các thiết bị cơ khí phi tiêu chuẩn phục vụ cho ngành hóa chất, thực phẩm, và các công trình thủy lợi. Với hệ thống nhà máy quy mô lớn tại hai miền Nam Bắc, chúng tôi cam kết mang đến sản phẩm chất lượng cao nhất.
                            </p>
                        </div>
                        
                        <div class="pt-8 grid grid-cols-2 gap-8 border-t border-slate-100">
                            <div class="space-y-1">
                                <h4 class="text-4xl font-bold text-slate-900">25+</h4>
                                <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Năm kinh nghiệm</p>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-4xl font-bold text-primary">500+</h4>
                                <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Dự án hoàn thành</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values -->
        <section class="py-24 bg-slate-50">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
                    <span class="text-primary font-bold uppercase tracking-widest text-xs">Nền tảng phát triển</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900">GIÁ TRỊ CỐT LÕI</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 group">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-500">
                            <Gem class="w-8 h-8 text-primary group-hover:text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-primary transition-colors">Chất lượng vượt trội</h3>
                        <p class="text-slate-500 leading-relaxed text-sm">
                            Mỗi dự án và sản phẩm cơ khí đều được kiểm soát nghiêm ngặt, đảm bảo tuổi thọ cao và hoạt động ổn định trong mọi điều kiện.
                        </p>
                    </div>

                    <!-- Value 2 -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 group">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-secondary group-hover:text-white transition-all duration-500">
                            <Leaf class="w-8 h-8 text-secondary group-hover:text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-secondary transition-colors">Phát triển bền vững</h3>
                        <p class="text-slate-500 leading-relaxed text-sm">
                            Giải pháp của chúng tôi hướng tới việc bảo vệ hệ sinh thái, giảm thiểu tác động tiêu cực và tạo ra giá trị lâu dài cho cộng đồng.
                        </p>
                    </div>

                    <!-- Value 3 -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 group">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-accent group-hover:text-white transition-all duration-500">
                            <Handshake class="w-8 h-8 text-accent group-hover:text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-accent transition-colors">Đồng hành tin cậy</h3>
                        <p class="text-slate-500 leading-relaxed text-sm">
                            Luôn lắng nghe và thấu hiểu nhu cầu của khách hàng, từ tư vấn thiết kế đến chuyển giao công nghệ và bảo trì trọn đời.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission -->
        <section class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="p-12 bg-slate-900 rounded-3xl text-white space-y-6 relative group overflow-hidden">
                        <Target class="w-20 h-20 text-primary opacity-10 absolute -right-4 -top-4 group-hover:scale-110 transition-transform duration-700" />
                        <h3 class="text-2xl font-bold uppercase tracking-tight">Tầm nhìn</h3>
                        <p class="text-lg text-slate-400 leading-relaxed font-normal">
                            Trở thành tập đoàn hàng đầu khu vực trong cung cấp giải pháp tổng thể về hạ tầng môi trường và gia công cơ khí chính xác, góp phần kiến tạo tương lai xanh bền vững.
                        </p>
                    </div>
                    <div class="p-12 bg-primary rounded-3xl text-white space-y-6 relative group overflow-hidden">
                        <Award class="w-20 h-20 text-white opacity-10 absolute -right-4 -top-4 group-hover:scale-110 transition-transform duration-700" />
                        <h3 class="text-2xl font-bold uppercase tracking-tight text-primary-content">Sứ mệnh</h3>
                        <p class="text-lg text-primary-content leading-relaxed font-normal opacity-90">
                            Mang đến những giải pháp công nghệ tiên tiến nhất, tối ưu chi phí và hiệu quả cho doanh nghiệp, đồng thời bảo vệ nguồn tài nguyên thiên nhiên của đất nước.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
