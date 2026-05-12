<script setup>
import InnerHero from '@/Components/InnerHero.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    post: Object,
    relatedPosts: Array,
});

const formatDate = (dateString) => new Date(dateString).toLocaleDateString('vi-VN');
</script>

<template>
    <MainLayout 
        :title="post.meta_title || (post.title + ' - TECOTECH')"
        :description="post.meta_description"
        :keywords="post.meta_keywords"
        :image="post.og_image || post.image"
        :canonical="post.canonical_url"
        :robots="post.meta_robots"
    >
        <InnerHero
            :title="post.title"
            :subtitle="post.excerpt || ''"
            :backgroundImage="post.image || 'https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp'"
        />

        <section class="bg-white py-14">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
                <article class="lg:col-span-2">
                    <div class="mb-8 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                        <span class="rounded-full bg-primary/10 px-3 py-1 font-semibold text-primary">{{ post.categoryRelation?.name || post.category || 'Tin tuc' }}</span>
                        <span>{{ formatDate(post.created_at) }}</span>
                    </div>
                    <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-a:text-primary prose-img:rounded-lg" v-html="post.content"></div>
                </article>

                <aside class="lg:col-span-1">
                    <div class="sticky top-28 rounded-lg border border-gray-200 bg-gray-50 p-6">
                        <h2 class="mb-4 text-lg font-bold text-gray-900">Bai viet lien quan</h2>
                        <div class="space-y-4">
                            <Link v-for="item in relatedPosts" :key="item.id" :href="route('posts.show', item.slug)" class="block group">
                                <img v-if="item.image" :src="item.image" :alt="item.title" class="mb-2 h-28 w-full rounded object-cover" />
                                <h3 class="text-sm font-semibold text-gray-800 group-hover:text-primary">{{ item.title }}</h3>
                            </Link>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </MainLayout>
</template>
