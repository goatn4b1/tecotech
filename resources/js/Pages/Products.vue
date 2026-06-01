<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InnerHero from '@/Components/InnerHero.vue';
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { ArrowRight } from 'lucide-vue-next';

const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
    categories: {
        type: Array,
        default: () => [],
    },
});

const activeCategory = ref('all');

const filteredProducts = computed(() => {
    if (activeCategory.value === 'all') {
        return props.products;
    }

    return props.products.filter((product) => Number(product.product_category_id) === Number(activeCategory.value));
});
</script>

<template>
    <MainLayout title="Sản phẩm - TECOTECH">
        <InnerHero
            title="Sản phẩm"
            subtitle="Danh sách thiết bị, hạng mục cơ khí và giải pháp môi trường TECOTECH cung cấp."
            backgroundImage="https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp"
        />

        <section class="bg-slate-50 py-20">
            <div class="container mx-auto max-w-7xl px-4">
                <div class="mb-12 flex flex-wrap justify-center gap-3">
                    <button
                        type="button"
                        @click="activeCategory = 'all'"
                        :class="[
                            'rounded-lg border px-5 py-3 text-sm font-bold transition',
                            activeCategory === 'all' ? 'border-primary bg-primary text-white' : 'border-white bg-white text-slate-600 hover:border-primary hover:text-primary'
                        ]"
                    >
                        Tất cả
                    </button>
                    <button
                        v-for="category in categories"
                        :key="category.id"
                        type="button"
                        @click="activeCategory = category.id"
                        :class="[
                            'rounded-lg border px-5 py-3 text-sm font-bold transition',
                            Number(activeCategory) === Number(category.id) ? 'border-primary bg-primary text-white' : 'border-white bg-white text-slate-600 hover:border-primary hover:text-primary'
                        ]"
                    >
                        {{ category.name }}
                    </button>
                </div>

                <div v-if="filteredProducts.length" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <article
                        v-for="product in filteredProducts"
                        :key="product.id"
                        class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                    >
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                            <img
                                :src="product.image || 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp'"
                                :alt="product.name"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-110"
                            >
                        </div>
                        <div class="space-y-3 p-6">
                            <div class="text-xs font-bold uppercase tracking-widest text-primary">
                                {{ product.category?.name || 'Sản phẩm' }}
                            </div>
                            <h2 class="text-xl font-bold leading-snug text-slate-900">{{ product.name }}</h2>
                            <p class="line-clamp-3 text-sm leading-6 text-slate-600">{{ product.excerpt }}</p>
                            <Link href="/lien-he" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:text-secondary">
                                Liên hệ tư vấn <ArrowRight class="h-4 w-4" />
                            </Link>
                        </div>
                    </article>
                </div>

                <div v-else class="rounded-2xl border-2 border-dashed border-slate-200 bg-white p-14 text-center text-slate-500">
                    Chưa có sản phẩm trong danh mục này.
                </div>
            </div>
        </section>
    </MainLayout>
</template>
