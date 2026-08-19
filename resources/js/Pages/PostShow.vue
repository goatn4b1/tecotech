<script setup>
import InnerHero from '@/Components/InnerHero.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import ContentToc from '@/Components/ContentToc.vue';
import { Link } from '@inertiajs/vue3';
import { Calendar, Tag, ChevronRight } from 'lucide-vue-next';
import { computed } from 'vue';
import { useContentToc } from '@/Composables/useContentToc';

const props = defineProps({
    post: Object,
    relatedPosts: Array,
    articleSchema: Object,
});

const formatDate = (dateString) => new Date(dateString).toLocaleDateString('vi-VN');
const stripHtml = (value = '') => value.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
const limitText = (value = '', limit = 160) => value.length > limit ? value.slice(0, limit).trim() : value;

const seoTitle = computed(() => props.post.meta_title || `${props.post.title} - TECOTECH`);
const seoDescription = computed(() => props.post.meta_description || limitText(props.post.excerpt || stripHtml(props.post.content || '')));
const seoImage = computed(() => props.post.og_image || props.post.image);
const seoCanonical = computed(() => props.post.canonical_url || (typeof window !== 'undefined' ? window.location.href : ''));
const seoRobots = computed(() => props.post.meta_robots || 'index, follow');

const contentWithToc = useContentToc(() => props.post?.content || '', 'noi-dung');
</script>

<template>
    <MainLayout 
        :title="seoTitle"
        :description="seoDescription"
        :keywords="post.meta_keywords"
        :image="seoImage"
        :canonical="seoCanonical"
        :robots="seoRobots"
        type="article"
        :published-time="post.created_at"
        :modified-time="post.updated_at"
        :section="post.categoryRelation?.name || post.category"
        :schema="articleSchema"
    >
        <InnerHero
            :title="post.title"
            :subtitle="post.excerpt || ''"
            :backgroundImage="post.image || 'https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp'"
        />

        <section class="bg-white py-20">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-16 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
                <article class="lg:col-span-2 space-y-10">
                    <div class="flex flex-wrap items-center gap-6 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                        <span class="inline-flex items-center gap-1.5 bg-primary/10 text-primary px-3 py-1 rounded-lg">
                            <Tag class="w-3 h-3" />
                            {{ post.categoryRelation?.name || post.category || 'Tin tức' }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <Calendar class="w-3.5 h-3.5" />
                            {{ formatDate(post.created_at) }}
                        </span>
                    </div>
                    
                    <div class="lg:hidden">
                        <ContentToc :items="contentWithToc.items" title="Mục lục bài viết" variant="mobile" />
                    </div>

                    <div class="post-content" v-html="contentWithToc.html"></div>
                </article>

                <aside class="lg:col-span-1">
                    <div class="sticky top-28 space-y-10">
                        <ContentToc class="hidden lg:block" :items="contentWithToc.items" title="Mục lục bài viết" />

                        <div class="rounded-3xl border border-slate-100 bg-slate-50 p-8">
                            <h2 class="text-sm font-bold text-slate-900 uppercase tracking-widest mb-6">Bài viết liên quan</h2>
                            <div class="space-y-8">
                                <Link v-for="item in relatedPosts" :key="item.id" :href="route('posts.show', item.slug)" class="group block space-y-3">
                                    <div class="aspect-[16/9] overflow-hidden rounded-2xl">
                                        <img :src="item.image || 'https://via.placeholder.com/400x225'" :alt="item.title" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                    </div>
                                    <h3 class="text-base font-bold text-slate-800 group-hover:text-primary transition-colors line-clamp-2 leading-snug">{{ item.title }}</h3>
                                    <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                                        Xem chi tiết <ChevronRight class="w-3 h-3" />
                                    </div>
                                </Link>
                            </div>
                        </div>

                        <div class="rounded-3xl bg-slate-900 p-8 text-white text-center space-y-6">
                            <h3 class="text-xl font-bold">Bạn cần tư vấn?</h3>
                            <p class="text-slate-400 text-sm font-normal">Đội ngũ chuyên gia của chúng tôi luôn sẵn sàng hỗ trợ bạn.</p>
                            <Link href="/lien-he" class="btn btn-primary w-full rounded-xl font-bold">Liên hệ ngay</Link>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </MainLayout>
</template>
