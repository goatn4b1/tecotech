<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import ContentHtml from '@/Components/ContentHtml.vue';
import { Link } from '@inertiajs/vue3';
import { ArrowRight, Tag, ArrowLeft, Phone } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps({
    product: Object,
    relatedProducts: {
        type: Array,
        default: () => [],
    },
});

const seoTitle = computed(() => `${props.product.name} - TECOTECH`);
const seoDescription = computed(() => props.product.excerpt || '');
const seoImage = computed(() => props.product.image || '');
</script>

<template>
    <MainLayout :title="seoTitle" :description="seoDescription" :image="seoImage">
        <InnerHero
            :title="product.name"
            :subtitle="product.excerpt"
            :backgroundImage="product.image || 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp'"
        />

        <!-- Breadcrumb -->
        <div class="bg-slate-50 border-b border-slate-200">
            <div class="container mx-auto max-w-7xl px-4 py-3">
                <nav class="flex items-center gap-2 text-sm text-slate-500">
                    <Link href="/" class="hover:text-primary transition-colors">Trang chủ</Link>
                    <span>/</span>
                    <Link href="/san-pham" class="hover:text-primary transition-colors">Sản phẩm</Link>
                    <span>/</span>
                    <span class="text-slate-800 font-medium truncate max-w-xs">{{ product.name }}</span>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <section class="py-16 bg-white">
            <div class="container mx-auto max-w-7xl px-4">
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">

                    <!-- Left: Content -->
                    <div class="lg:col-span-2">
                        <!-- Product Image -->
                        <div v-if="product.image" class="mb-10 overflow-hidden rounded-2xl shadow-lg">
                            <img
                                :src="product.image"
                                :alt="product.name"
                                class="w-full object-cover max-h-[480px]"
                            >
                        </div>

                        <!-- Category Badge -->
                        <div v-if="product.category" class="mb-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-primary">
                                <Tag class="h-3.5 w-3.5" />
                                {{ product.category.name }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h1 class="mb-6 text-3xl font-extrabold leading-tight text-slate-900 lg:text-4xl">
                            {{ product.name }}
                        </h1>

                        <!-- Excerpt callout -->
                        <p v-if="product.excerpt" class="mb-8 text-lg leading-8 text-slate-600 border-l-4 border-primary pl-5 italic bg-slate-50 py-4 pr-4 rounded-r-xl">
                            {{ product.excerpt }}
                        </p>

                        <!-- Description / Content -->
                        <ContentHtml
                            v-if="product.content"
                            :html="product.content"
                        />

                        <div v-else-if="!product.excerpt" class="rounded-xl border-2 border-dashed border-slate-200 p-10 text-center text-slate-400">
                            Chưa có mô tả cho sản phẩm này.
                        </div>
                    </div>

                    <!-- Right: Sidebar -->
                    <div>
                        <div class="sticky top-28 space-y-6">
                            <!-- CTA Box -->
                            <div class="rounded-2xl bg-gradient-to-br from-primary to-secondary p-6 text-white shadow-lg shadow-primary/20">
                                <h3 class="mb-2 text-xl font-bold">Quan tâm sản phẩm này?</h3>
                                <p class="mb-5 text-sm text-white/80 leading-6">Liên hệ ngay để được tư vấn chi tiết và báo giá tốt nhất từ đội ngũ chuyên gia TECOTECH.</p>
                                <Link
                                    href="/lien-he"
                                    class="flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-primary shadow transition hover:bg-slate-50"
                                >
                                    <Phone class="h-4 w-4" />
                                    Liên hệ tư vấn
                                </Link>
                            </div>

                            <!-- Product Info Card -->
                            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6">
                                <h3 class="mb-4 text-base font-bold text-slate-800">Thông tin sản phẩm</h3>
                                <ul class="space-y-3 text-sm text-slate-600">
                                    <li v-if="product.category" class="flex items-start gap-3">
                                        <span class="w-24 shrink-0 font-semibold text-slate-700">Danh mục</span>
                                        <span>{{ product.category.name }}</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-24 shrink-0 font-semibold text-slate-700">Đơn vị</span>
                                        <span>TECOTECH</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Products -->
        <section v-if="relatedProducts.length" class="bg-slate-50 py-16">
            <div class="container mx-auto max-w-7xl px-4">
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-xs font-bold uppercase tracking-widest text-primary">Khám phá thêm</p>
                        <h2 class="text-2xl font-extrabold text-slate-900">Sản phẩm liên quan</h2>
                    </div>
                    <Link href="/san-pham" class="hidden items-center gap-1.5 text-sm font-bold text-primary hover:text-secondary transition-colors sm:flex">
                        Xem tất cả <ArrowRight class="h-4 w-4" />
                    </Link>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <article
                        v-for="related in relatedProducts"
                        :key="related.id"
                        class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl flex flex-col"
                    >
                        <Link :href="`/san-pham/${related.slug}`" class="aspect-video overflow-hidden bg-slate-100 block">
                            <img
                                :src="related.image || 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp'"
                                :alt="related.name"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            >
                        </Link>
                        <div class="p-5 flex flex-col flex-grow space-y-2">
                            <p v-if="related.category" class="text-xs font-bold uppercase tracking-widest text-primary">{{ related.category.name }}</p>
                            <h3 class="text-base font-bold leading-snug text-slate-900 line-clamp-2 flex-grow">{{ related.name }}</h3>
                            <Link :href="`/san-pham/${related.slug}`" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-secondary mt-2 transition-colors">
                                Xem chi tiết <ArrowRight class="h-4 w-4" />
                            </Link>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Back Button -->
        <div class="bg-white py-8 border-t border-slate-100">
            <div class="container mx-auto max-w-7xl px-4">
                <Link href="/san-pham" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-primary transition-colors">
                    <ArrowLeft class="h-4 w-4" />
                    Quay lại danh sách sản phẩm
                </Link>
            </div>
        </div>
    </MainLayout>
</template>
