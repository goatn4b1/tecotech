<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    sections: {
        type: Array,
        default: () => [],
    },
    featuredPosts: {
        type: Array,
        default: () => [],
    },
});

const projects = [
    {
        title: 'Công trình xử lý nước thải ga cáp treo khu du lịch núi Bà Đen',
        image: 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
    },
    {
        title: 'Công trình xử lý nước thải chợ trung tâm Lý Sơn',
        image: 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
    },
];

const formatDate = (dateString) => new Date(dateString).toLocaleDateString('vi-VN');
</script>

<template>
    <MainLayout title="Trang chủ - TECOTECH">
        <template v-for="section in sections" :key="section.id">
            <section v-if="section.type === 'hero'" class="relative h-[400px] overflow-hidden bg-gray-900 md:h-[600px]">
                <div class="absolute inset-0">
                    <img :src="section.data.slides[0].image" class="h-full w-full object-cover opacity-60" alt="TECOTECH">
                </div>
                <div class="container relative mx-auto flex h-full flex-col justify-center px-4 text-white">
                    <h1 class="mb-4 text-3xl font-extrabold md:text-5xl">{{ section.data.slides[0].title }}</h1>
                    <p class="max-w-2xl text-lg md:text-xl">{{ section.data.slides[0].desc }}</p>
                    <div class="mt-8">
                        <Link href="/lien-he" class="rounded-full bg-primary px-8 py-3 font-bold text-white transition hover:bg-primary-dark">Liên hệ ngay</Link>
                    </div>
                </div>
            </section>

            <section v-if="section.type === 'about'" class="bg-white py-16">
                <div class="container mx-auto px-4">
                    <div class="mb-12 text-center">
                        <h2 class="inline-block border-b-4 border-primary pb-2 text-3xl font-bold uppercase tracking-wider text-gray-800">{{ section.data.title }}</h2>
                        <p class="mx-auto mt-6 max-w-4xl text-lg leading-relaxed text-gray-600">{{ section.data.content }}</p>
                    </div>
                    <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2">
                        <img :src="section.data.image" alt="Giới thiệu TECOTECH" class="rounded-lg shadow-2xl">
                        <div class="space-y-8">
                            <div class="flex items-start">
                                <div class="mr-4 mt-1 rounded-lg bg-primary p-3 text-white">
                                    <i class="fas fa-history text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary">25 năm kinh nghiệm</h3>
                                    <p class="text-gray-600">Thương hiệu tin cậy trong lĩnh vực cơ khí và môi trường tại Việt Nam.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="mr-4 mt-1 rounded-lg bg-primary p-3 text-white">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary">Năng lực vượt trội</h3>
                                    <p class="text-gray-600">Đội ngũ kỹ sư và lực lượng sản xuất, thi công chuyên nghiệp.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="mr-4 mt-1 rounded-lg bg-primary p-3 text-white">
                                    <i class="fas fa-tools text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary">Dịch vụ đa dạng</h3>
                                    <p class="text-gray-600">Thi công, sản xuất các thiết bị và bồn chứa phục vụ xử lý môi trường.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section v-if="section.type === 'services'" class="relative bg-gray-50 bg-[url('https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg')] bg-cover bg-fixed bg-center py-16">
                <div class="absolute inset-0 bg-primary/80"></div>
                <div class="container relative mx-auto px-4">
                    <div class="mb-12 text-center text-white">
                        <h2 class="inline-block border-b-4 border-white pb-2 text-3xl font-bold uppercase tracking-wider">{{ section.data.title }}</h2>
                        <p class="mx-auto mt-4 max-w-2xl">{{ section.data.subtitle }}</p>
                    </div>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4">
                        <div v-for="service in section.data.items" :key="service.title" class="group relative overflow-hidden rounded-lg bg-white shadow-lg transition duration-300 hover:-translate-y-2">
                            <div class="h-48 overflow-hidden">
                                <img :src="service.image" :alt="service.title" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="text-sm font-bold uppercase text-primary md:text-base">{{ service.title }}</h3>
                            </div>
                            <Link :href="service.link" class="absolute inset-0 z-10" :aria-label="service.title"></Link>
                        </div>
                    </div>
                </div>
            </section>

            <section v-if="section.type === 'partners'" class="border-t border-gray-200 bg-gray-100 py-12">
                <div class="container mx-auto px-4">
                    <div class="mb-10 text-center">
                        <h2 class="inline-block border-b-4 border-primary pb-2 text-2xl font-bold uppercase tracking-wider text-gray-800">{{ section.data.title }}</h2>
                    </div>
                    <div class="flex flex-wrap items-center justify-center gap-8 opacity-70 grayscale transition duration-500 hover:grayscale-0">
                        <img v-for="(img, idx) in section.data.images" :key="idx" :src="img" alt="Đối tác TECOTECH" class="h-12 md:h-16">
                    </div>
                </div>
            </section>
        </template>

        <section class="bg-white py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
                    <div class="lg:col-span-4">
                        <div class="mb-8 flex items-end justify-between border-b-2 border-primary pb-2">
                            <h2 class="text-2xl font-bold uppercase text-primary">Công trình tiêu biểu</h2>
                            <Link href="/cong-trinh" class="text-sm text-gray-500 hover:text-primary">Xem tất cả <i class="fas fa-angle-double-right"></i></Link>
                        </div>
                        <div class="space-y-6">
                            <div v-for="project in projects" :key="project.title" class="group flex gap-4">
                                <div class="h-32 w-1/3 flex-shrink-0 overflow-hidden rounded-lg">
                                    <img :src="project.image" :alt="project.title" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                </div>
                                <div class="w-2/3">
                                    <h3 class="line-clamp-2 font-bold text-gray-800 transition hover:text-primary">
                                        <Link href="/cong-trinh">{{ project.title }}</Link>
                                    </h3>
                                    <Link href="/cong-trinh" class="mt-2 inline-block text-sm font-semibold italic text-primary">Xem thêm <i class="fas fa-caret-right"></i></Link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-8">
                        <div class="mb-8 flex items-end justify-between border-b-2 border-primary pb-2">
                            <h2 class="text-2xl font-bold uppercase text-primary">Bài viết mới nhất</h2>
                            <Link href="/tin-tuc" class="text-sm text-gray-500 hover:text-primary">Xem tất cả <i class="fas fa-angle-double-right"></i></Link>
                        </div>
                        <div v-if="featuredPosts.length" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <article v-for="post in featuredPosts" :key="post.id" class="group flex gap-4 rounded-lg border border-gray-100 bg-white p-3 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                                <Link :href="route('posts.show', post.slug)" class="h-28 w-36 flex-shrink-0 overflow-hidden rounded-md bg-gray-100">
                                    <img :src="post.image || 'https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp'" :alt="post.title" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                </Link>
                                <div class="min-w-0 flex-1">
                                    <div class="mb-2 flex flex-wrap items-center gap-2 text-xs text-gray-500">
                                        <span class="rounded bg-primary/10 px-2 py-0.5 font-semibold text-primary">{{ post.categoryRelation?.name || post.category || 'Tin tức' }}</span>
                                        <span>{{ formatDate(post.created_at) }}</span>
                                    </div>
                                    <h3 class="line-clamp-2 font-bold leading-snug text-gray-800 transition group-hover:text-primary">
                                        <Link :href="route('posts.show', post.slug)">{{ post.title }}</Link>
                                    </h3>
                                    <p class="mt-2 line-clamp-2 text-sm text-gray-500">{{ post.excerpt }}</p>
                                    <Link :href="route('posts.show', post.slug)" class="mt-2 inline-flex items-center text-sm font-semibold text-primary hover:text-secondary">
                                        Xem thêm <i class="fas fa-caret-right ml-1"></i>
                                    </Link>
                                </div>
                            </article>
                        </div>
                        <div v-else class="rounded-lg border border-dashed border-gray-200 p-8 text-center text-gray-500">
                            Chưa có bài viết nào.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
