<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Link } from '@inertiajs/vue3';
import { 
    Calendar, 
    ChevronRight,
    Tag
} from 'lucide-vue-next';

const props = defineProps({
    posts: Array
});

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('vi-VN');
};
</script>

<template>
    <MainLayout title="Tin tức - TECOTECH">
        <InnerHero 
            title="Tin tức" 
            subtitle="Cập nhật tin tức hoạt động, công nghệ mới và kiến thức chuyên ngành từ TECOTECH."
            backgroundImage="https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp"
        />

        <section class="py-24 bg-slate-50">
            <div class="container mx-auto px-4 max-w-7xl">
                
                <div v-if="posts.length === 0" class="text-center text-slate-400 py-40 italic font-medium">
                    Hiện chưa có bài viết nào trong danh mục này.
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10" v-if="posts.length > 0">
                    <div v-for="post in posts" :key="post.id" class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col group">
                        <Link :href="route('posts.show', post.slug)" class="h-60 overflow-hidden relative block">
                            <img :src="post.image || 'https://via.placeholder.com/400x300'" :alt="post.title" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-4 left-4 inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-md text-primary text-[10px] font-bold px-3 py-1 rounded-lg uppercase shadow-sm border border-slate-100">
                                <Tag class="w-3 h-3" />
                                {{ post.categoryRelation?.name || post.category || 'Tin tức' }}
                            </div>
                        </Link>
                        <div class="p-8 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 text-slate-400 text-[10px] mb-4 font-bold uppercase tracking-widest">
                                <Calendar class="w-3.5 h-3.5" />
                                {{ formatDate(post.created_at) }}
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-primary transition-colors leading-snug line-clamp-2">
                                <Link :href="route('posts.show', post.slug)">{{ post.title }}</Link>
                            </h3>
                            <p class="text-slate-500 text-sm mb-8 line-clamp-3 flex-grow font-normal">{{ post.excerpt }}</p>
                            <Link :href="route('posts.show', post.slug)" class="inline-flex items-center gap-2 text-sm font-bold text-primary group/link">
                                Xem chi tiết 
                                <ChevronRight class="w-4 h-4 group-hover/link:translate-x-2 transition-transform" />
                            </Link>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </MainLayout>
</template>
