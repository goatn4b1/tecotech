<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Link, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const activeFilter = ref('all');

const filters = [
    { id: 'all', name: 'Tất cả' },
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
        capacity: '5000 m3/ngày.đêm'
    },
    {
        id: 2,
        title: 'Hệ thống lọc bụi nhà máy xi măng',
        category: 'khi-thai',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg',
        capacity: 'Lưu lượng 120.000 m3/h'
    },
    {
        id: 3,
        title: 'Bồn chứa hóa chất composite',
        category: 'co-khi',
        image: 'https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg',
        capacity: 'Thể tích 50m3'
    },
    {
        id: 4,
        title: 'Trạm XLNT sinh hoạt khu đô thị',
        category: 'nuoc-thai',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420726.jpg',
        capacity: '1500 m3/ngày.đêm'
    },
    {
        id: 5,
        title: 'Hệ thống XL khí thải lò hơi',
        category: 'khi-thai',
        image: 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg',
        capacity: 'Lưu lượng 45.000 m3/h'
    },
    {
        id: 6,
        title: 'Chế tạo silo inox 304 vi sinh',
        category: 'co-khi',
        image: 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
        capacity: 'Tiêu chuẩn thực phẩm'
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

        <section class="py-20 bg-white">
            <div class="container mx-auto px-4 max-w-7xl">
                
                <!-- Filter -->
                <div class="flex flex-wrap justify-center gap-4 mb-16">
                    <button 
                        v-for="filter in filters" 
                        :key="filter.id"
                        @click="activeFilter = filter.id"
                        :class="[
                            'px-6 py-2 rounded-full font-semibold transition-all duration-300',
                            activeFilter === filter.id 
                                ? 'bg-primary text-white shadow-md' 
                                : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                        ]"
                    >
                        {{ filter.name }}
                    </button>
                </div>

                <!-- Portfolio Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="project in filteredProjects()" 
                        :key="project.id" 
                        class="group relative overflow-hidden rounded-2xl cursor-pointer"
                    >
                        <div class="aspect-w-4 aspect-h-3">
                            <img :src="project.image" :alt="project.title" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        </div>
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
                        
                        <!-- Content -->
                        <div class="absolute inset-0 p-6 flex flex-col justify-end transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <div class="w-10 h-1 bg-secondary mb-4 rounded-full"></div>
                            <h3 class="text-xl font-bold text-white mb-2 leading-tight">{{ project.title }}</h3>
                            <p class="text-gray-300 text-sm mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                <i class="fas fa-cogs mr-2 text-secondary"></i> {{ project.capacity }}
                            </p>
                            <Link href="#" class="inline-flex items-center text-sm font-bold uppercase tracking-wider text-primary group-hover:text-white transition-colors opacity-0 group-hover:opacity-100 duration-500 delay-200">
                                Xem chi tiết <i class="fas fa-arrow-right ml-2"></i>
                            </Link>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </MainLayout>
</template>
