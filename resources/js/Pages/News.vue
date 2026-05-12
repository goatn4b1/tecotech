<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    posts: Array
});

const featuredPost = props.posts.length > 0 ? props.posts[0] : null;
const regularPosts = props.posts.length > 1 ? props.posts.slice(1) : [];

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('vi-VN');
};
</script>

<template>
    <MainLayout title="Tin tức & Sự kiện - TECOTECH">
        <InnerHero 
            title="Tin tức & Cẩm nang" 
            subtitle="Cập nhật tin tức hoạt động, công nghệ mới và kiến thức chuyên ngành từ TECOTECH."
            backgroundImage="https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp"
        />

        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 max-w-7xl">
                
                <div v-if="posts.length === 0" class="text-center text-gray-500 py-10">
                    Hiện chưa có bài viết nào.
                </div>

                <!-- Featured Post -->
                <div class="mb-16" v-if="featuredPost">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg flex flex-col lg:flex-row border border-gray-100 group cursor-pointer">
                        <div class="lg:w-3/5 h-80 lg:h-auto overflow-hidden">
                            <img :src="featuredPost.image || 'https://via.placeholder.com/800x600'" :alt="featuredPost.title" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="lg:w-2/5 p-10 flex flex-col justify-center">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="bg-secondary/10 text-secondary font-bold px-3 py-1 rounded-full text-xs uppercase">{{ featuredPost.category || 'Tin tức' }}</span>
                                <span class="text-gray-500 text-sm"><i class="far fa-calendar-alt mr-2"></i>{{ formatDate(featuredPost.created_at) }}</span>
                            </div>
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-4 group-hover:text-primary transition-colors leading-tight">
                                <Link :href="route('posts.show', featuredPost.slug)">{{ featuredPost.title }}</Link>
                            </h2>
                            <p class="text-gray-600 mb-8 leading-relaxed line-clamp-3">{{ featuredPost.excerpt }}</p>
                            <div>
                                <Link :href="route('posts.show', featuredPost.slug)" class="inline-block bg-primary text-white px-6 py-2 rounded-full font-semibold hover:bg-primary-dark transition-colors">Đọc tiếp</Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Posts -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" v-if="regularPosts.length > 0">
                    <div v-for="post in regularPosts" :key="post.id" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col group cursor-pointer">
                        <div class="h-56 overflow-hidden relative">
                            <img :src="post.image || 'https://via.placeholder.com/400x300'" :alt="post.title" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow-md">
                                {{ post.category || 'Tin tức' }}
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-gray-400 text-xs mb-3 font-medium">
                                <i class="far fa-calendar-alt mr-2"></i>{{ formatDate(post.created_at) }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-primary transition-colors leading-snug line-clamp-2">
                                <Link :href="route('posts.show', post.slug)">{{ post.title }}</Link>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">{{ post.excerpt }}</p>
                            <Link :href="route('posts.show', post.slug)" class="text-primary font-bold text-sm hover:text-secondary transition-colors mt-auto inline-flex items-center">
                                Xem chi tiết <i class="fas fa-arrow-right ml-2"></i>
                            </Link>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </MainLayout>
</template>
