<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { 
    ArrowRight, 
    Box, 
    Maximize, 
    Activity 
} from 'lucide-vue-next';

const activeFilter = ref('all');

const filters = [
    { id: 'all', name: 'Tất cả dự án' },
    { id: 'nuoc-thai', name: 'Xử lý nước thải' },
    { id: 'khi-thai', name: 'Xử lý khí thải' },
    { id: 'co-khi', name: 'Gia công cơ khí' }
];

const projects = [
    {
        id: 1,
        title: 'Hệ thống XLNT Khu công nghiệp VSIP',
        category: 'nuoc-thai',
        image: 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
        capacity: '5000 m3/ngày.đêm',
        icon: Activity
    },
    {
        id: 2,
        title: 'Hệ thống lọc bụi nhà máy xi măng',
        category: 'khi-thai',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg',
        capacity: 'Lưu lượng 120.000 m3/h',
        icon: Box
    },
    {
        id: 3,
        title: 'Bồn chứa hóa chất composite',
        category: 'co-khi',
        image: 'https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg',
        capacity: 'Thể tích 50m3',
        icon: Maximize
    },
    {
        id: 4,
        title: 'Trạm XLNT sinh hoạt khu đô thị',
        category: 'nuoc-thai',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420726.jpg',
        capacity: '1500 m3/ngày.đêm',
        icon: Activity
    },
    {
        id: 5,
        title: 'Hệ thống XL khí thải lò hơi',
        category: 'khi-thai',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg',
        capacity: 'Lưu lượng 45.000 m3/h',
        icon: Box
    },
    {
        id: 6,
        title: 'Chế tạo silo inox 304 vi sinh',
        category: 'co-khi',
        image: 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
        capacity: 'Tiêu chuẩn thực phẩm',
        icon: Maximize
    }
];

const filteredProjects = () => {
    if (activeFilter.value === 'all') return projects;
    return projects.filter(p => p.category === activeFilter.value);
};
</script>

<template>
    <MainLayout title="Dự án - Công trình - TECOTECH">
        <InnerHero 
            title="Dự án tiêu biểu" 
            subtitle="Hàng trăm công trình đã được TECOTECH thực hiện thành công trên toàn quốc."
            backgroundImage="https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp"
        />

        <section class="py-24 bg-slate-50">
            <div class="container mx-auto px-4 max-w-7xl">
                
                <!-- Filter -->
                <div class="flex flex-wrap justify-center gap-3 mb-20">
                    <button 
                        v-for="filter in filters" 
                        :key="filter.id"
                        @click="activeFilter = filter.id"
                        :class="[
                            'px-8 py-3 rounded-xl text-sm font-bold uppercase tracking-widest transition-all duration-300 border-2',
                            activeFilter === filter.id 
                                ? 'bg-primary border-primary text-white shadow-xl shadow-primary/20' 
                                : 'bg-white border-white text-slate-500 hover:border-slate-200 hover:text-slate-800'
                        ]"
                    >
                        {{ filter.name }}
                    </button>
                </div>

                <!-- Portfolio Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    <div 
                        v-for="project in filteredProjects()" 
                        :key="project.id" 
                        class="group relative overflow-hidden rounded-3xl bg-slate-900 aspect-[4/5] lg:aspect-[3/4]"
                    >
                        <img :src="project.image" :alt="project.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110 opacity-60 group-hover:opacity-40">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-transparent"></div>
                        
                        <div class="absolute inset-0 p-8 flex flex-col justify-end">
                            <div class="space-y-4 translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-primary/20 backdrop-blur-md border border-primary/30 text-primary-content text-[10px] font-bold tracking-[0.2em] uppercase">
                                    {{ filters.find(f => f.id === project.category)?.name }}
                                </div>
                                <h3 class="text-2xl font-bold text-white leading-tight">{{ project.title }}</h3>
                                
                                <div class="flex items-center gap-3 text-slate-300 text-sm font-normal opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                    <component :is="project.icon" class="w-4 h-4 text-primary" />
                                    {{ project.capacity }}
                                </div>
                                
                                <div class="pt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200">
                                    <Link href="#" class="inline-flex items-center gap-2 text-sm font-bold text-white group/link">
                                        Xem chi tiết 
                                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center group-hover/link:translate-x-2 transition-transform">
                                            <ArrowRight class="w-4 h-4" />
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="filteredProjects().length === 0" class="py-40 text-center">
                    <p class="text-slate-400 font-medium italic">Không tìm thấy dự án nào trong danh mục này.</p>
                </div>

            </div>
        </section>
    </MainLayout>
</template>
