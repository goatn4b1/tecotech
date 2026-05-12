<script setup>
import InnerHero from '@/Components/InnerHero.vue';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    pageItem: Object,
});
</script>

<template>
    <MainLayout :title="(pageItem.meta_title || pageItem.title) + ' - TECOTECH'">
        <InnerHero
            :title="pageItem.title"
            :subtitle="pageItem.excerpt || ''"
            :backgroundImage="pageItem.hero_image || 'https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp'"
        />

        <section class="bg-white py-14">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <article class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-a:text-primary prose-img:rounded-lg" v-html="pageItem.content"></article>
            </div>
        </section>
    </MainLayout>
</template>
