<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { 
    ChevronRight, 
    Home, 
    FileText, 
    Layout, 
    ExternalLink 
} from 'lucide-vue-next';

defineProps({
    pages: Array,
    posts: Array,
    staticLinks: Array
});
</script>

<template>
    <Head title="Sitemap" />

    <MainLayout>
        <div class="bg-slate-50 min-h-screen py-16">
            <div class="container mx-auto px-4 max-w-4xl">
                <div class="mb-12 text-center">
                    <h1 class="text-4xl font-extrabold text-slate-900 mb-4 uppercase tracking-tight">Sitemap</h1>
                    <div class="h-1.5 w-24 bg-primary mx-auto rounded-full"></div>
                    <p class="mt-6 text-slate-600 max-w-lg mx-auto leading-relaxed">
                        Danh sách toàn bộ các trang và bài viết trên hệ thống Tecotech giúp bạn dễ dàng tìm kiếm thông tin.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Static & Main Pages -->
                    <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="p-2.5 bg-primary/10 rounded-xl text-primary">
                                <Home class="w-5 h-5" />
                            </div>
                            <h2 class="text-xl font-bold text-slate-900">Trang chính</h2>
                        </div>
                        <ul class="space-y-4">
                            <li v-for="link in staticLinks" :key="link.url">
                                <Link :href="link.url" class="group flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <ChevronRight class="w-4 h-4 text-slate-300 group-hover:text-primary transition-colors" />
                                        <span class="text-slate-700 font-medium group-hover:text-slate-900">{{ link.label }}</span>
                                    </div>
                                    <ExternalLink class="w-3.5 h-3.5 text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity" />
                                </Link>
                            </li>
                        </ul>
                    </section>

                    <!-- CMS Pages -->
                    <section v-if="pages.length" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="p-2.5 bg-blue-50 rounded-xl text-blue-600">
                                <Layout class="w-5 h-5" />
                            </div>
                            <h2 class="text-xl font-bold text-slate-900">Trang nội dung</h2>
                        </div>
                        <ul class="space-y-4">
                            <li v-for="page in pages" :key="page.id">
                                <Link :href="'/' + page.slug" class="group flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <ChevronRight class="w-4 h-4 text-slate-300 group-hover:text-primary transition-colors" />
                                        <span class="text-slate-700 font-medium group-hover:text-slate-900">{{ page.title }}</span>
                                    </div>
                                    <ExternalLink class="w-3.5 h-3.5 text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity" />
                                </Link>
                            </li>
                        </ul>
                    </section>

                    <!-- Posts -->
                    <section v-if="posts.length" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 hover:shadow-md transition-shadow md:col-span-2">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="p-2.5 bg-emerald-50 rounded-xl text-emerald-600">
                                <FileText class="w-5 h-5" />
                            </div>
                            <h2 class="text-xl font-bold text-slate-900">Bài viết tin tức</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div v-for="post in posts" :key="post.id">
                                <Link :href="'/tin-tuc/' + post.slug" class="group flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <ChevronRight class="w-4 h-4 text-slate-300 group-hover:text-primary transition-colors" />
                                        <span class="text-slate-700 font-medium group-hover:text-slate-900 line-clamp-1">{{ post.title }}</span>
                                    </div>
                                    <ExternalLink class="w-3.5 h-3.5 text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity" />
                                </Link>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
