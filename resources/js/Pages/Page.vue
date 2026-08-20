<script setup>
import InnerHero from "@/Components/InnerHero.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import ContentToc from "@/Components/ContentToc.vue";
import ContentHtml from "@/Components/ContentHtml.vue";
import { useContentToc } from "@/Composables/useContentToc";

const props = defineProps({
    pageItem: Object,
});

const contentWithToc = useContentToc(() => props.pageItem?.content || "", "muc");
</script>

<template>
    <MainLayout
        :title="pageItem.meta_title || (pageItem.title + ' - TECOTECH')"
        :description="pageItem.meta_description"
        :keywords="pageItem.meta_keywords"
        :image="pageItem.og_image || pageItem.hero_image"
        :canonical="pageItem.canonical_url"
        :robots="pageItem.meta_robots"
    >
        <InnerHero
            :title="pageItem.title"
            :subtitle="pageItem.excerpt || ''"
            :backgroundImage="pageItem.hero_image || 'https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp'"
        />

        <section class="bg-white py-16">
            <div class="container mx-auto grid max-w-7xl grid-cols-1 gap-12 px-4 lg:grid-cols-3">

                <article class="space-y-8 lg:col-span-2">
                    <div class="lg:hidden">
                        <ContentToc :items="contentWithToc.items" title="Mục lục" variant="mobile" />
                    </div>

                    <ContentHtml :html="contentWithToc.html" />
                </article>

                <aside class="lg:col-span-1">
                    <div class="sticky top-28 space-y-6">
                        <ContentToc class="hidden lg:block" :items="contentWithToc.items" title="Mục lục" />

                        <div class="rounded-3xl bg-slate-900 p-8 text-white text-center space-y-6">
                            <h3 class="text-xl font-bold">Bạn cần tư vấn?</h3>
                            <p class="text-slate-400 text-sm font-normal">Đội ngũ chuyên gia của chúng tôi luôn sẵn sàng hỗ trợ bạn.</p>
                            <a href="/lien-he" class="btn btn-primary w-full rounded-xl font-bold">Liên hệ ngay</a>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </MainLayout>
</template>
