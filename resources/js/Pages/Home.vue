<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { 
    ChevronRight, 
    History, 
    Users, 
    Wrench, 
    ArrowRight,
    Eye,
    Rocket,
    Target,
    Award
} from 'lucide-vue-next';

defineProps({
    sections: {
        type: Array,
        default: () => [],
    },
    featuredPosts: {
        type: Array,
        default: () => [],
    },
    featuredProducts: {
        type: Array,
        default: () => [],
    },
});

const page = usePage();
const settings = computed(() => page.props.globalSettings || {});
const phoneDisplay = computed(() => settings.value.site_phone || '');
const phoneHref = computed(() => `tel:${phoneDisplay.value.replace(/\s+/g, '')}`);

const showCta = computed(() => settings.value.home_cta_active === undefined || settings.value.home_cta_active === '1');
const ctaTitle = computed(() => settings.value.home_cta_title || 'Sẵn sàng triển khai giải pháp tối ưu cho doanh nghiệp của bạn?');
const ctaDesc = computed(() => settings.value.home_cta_desc || 'Liên hệ với chuyên gia của chúng tôi để được tư vấn miễn phí về các giải pháp công nghệ môi trường và gia công cơ khí.');
const ctaBg = computed(() => settings.value.home_cta_bg || 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80');

const ctaBtn1Text = computed(() => settings.value.home_cta_btn1_text || 'Yêu cầu báo giá');
const ctaBtn1Link = computed(() => settings.value.home_cta_btn1_link || '/lien-he');
const ctaBtn2Text = computed(() => settings.value.home_cta_btn2_text || (phoneDisplay.value ? `Gọi ngay: ${phoneDisplay.value}` : ''));
const ctaBtn2Link = computed(() => settings.value.home_cta_btn2_link || (phoneDisplay.value ? phoneHref.value : ''));

const splitHeroTitle = (slide) => {
    const title = slide?.title || '';
    const highlight = slide?.highlight || '';

    if (!highlight || !title.includes(highlight)) {
        return { before: title, highlight: '', after: '' };
    }

    const start = title.indexOf(highlight);

    return {
        before: title.slice(0, start),
        highlight,
        after: title.slice(start + highlight.length),
    };
};

const formatDate = (dateString) => new Date(dateString).toLocaleDateString('vi-VN');
const missionIconMap = { vision: Eye, mission: Rocket, goal: Target };
</script>

<template>
    <MainLayout>
        <template v-for="section in sections" :key="section.id">
            <!-- Hero Section -->
            <section v-if="section.type === 'hero'" class="relative min-h-[560px] md:h-[calc(100vh-80px)] max-h-[800px] overflow-hidden">
                <div class="absolute inset-0">
                    <img :src="section.data.slides[0].image" class="h-full w-full object-cover" alt="TECOTECH">
                    <div class="absolute inset-0 bg-slate-900/40"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/20 to-transparent"></div>
                </div>
                <div class="container relative mx-auto flex min-h-[560px] items-center px-4 py-16 md:h-full md:min-h-0 md:py-0">
                    <div class="max-w-3xl space-y-7 animate-fade-in-up md:space-y-6">
                        <h1 class="text-3xl font-bold text-white leading-[1.22] sm:text-4xl md:text-7xl md:leading-[1.1]">
                            <span>{{ splitHeroTitle(section.data.slides[0]).before }}</span>
                            <span v-if="splitHeroTitle(section.data.slides[0]).highlight" class="text-primary">
                                {{ splitHeroTitle(section.data.slides[0]).highlight }}
                            </span>
                            <span>{{ splitHeroTitle(section.data.slides[0]).after }}</span>
                        </h1>
                        <p class="text-base md:text-xl text-slate-200 leading-8 md:leading-relaxed max-w-2xl font-normal opacity-90">
                            {{ section.data.slides[0].desc }}
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4 md:pt-6">
                            <component :is="(section.data.slides[0].btn1_link || '/lien-he').startsWith('http') ? 'a' : Link"
                                       :href="section.data.slides[0].btn1_link || '/lien-he'" 
                                       class="btn btn-primary btn-lg rounded-xl px-8 md:px-10 font-bold group shadow-xl shadow-primary/30">
                                {{ section.data.slides[0].btn1_text || 'Liên hệ ngay' }}
                                <ArrowRight class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" />
                            </component>
                            <component :is="(section.data.slides[0].btn2_link || '/gioi-thieu').startsWith('http') ? 'a' : Link"
                                       :href="section.data.slides[0].btn2_link || '/gioi-thieu'" 
                                       class="btn bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border-white/20 hover:border-white/40 btn-lg rounded-xl px-8 md:px-10">
                                {{ section.data.slides[0].btn2_text || 'Tìm hiểu thêm' }}
                            </component>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Stats Section (Moved from Hero) -->
            <section v-if="section.type === 'hero'" class="bg-white border-b border-slate-100">
                <div class="container mx-auto px-4 py-12">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="text-center group">
                            <div class="text-4xl font-bold text-slate-900 group-hover:text-primary transition-colors">1+</div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-2">Năm kinh nghiệm</p>
                        </div>
                        <div class="text-center group border-l border-slate-100">
                            <div class="text-4xl font-bold text-slate-900 group-hover:text-primary transition-colors">50+</div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-2">Dự án hoàn thành</p>
                        </div>
                        <div class="text-center group border-l border-slate-100">
                            <div class="text-4xl font-bold text-slate-900 group-hover:text-primary transition-colors">100%</div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-2">Hài lòng</p>
                        </div>
                        <div class="text-center group border-l border-slate-100">
                            <div class="text-4xl font-bold text-slate-900 group-hover:text-primary transition-colors">Top 10</div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-2">Đơn vị uy tín</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- About Section -->
            <section v-if="section.type === 'about'" class="bg-white py-24">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                        <div class="relative">
                            <div class="relative rounded-3xl overflow-hidden aspect-[4/3] shadow-2xl">
                                <img :src="section.data.image" alt="Giới thiệu TECOTECH" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute -bottom-10 -right-10 bg-primary p-8 rounded-3xl shadow-xl hidden md:block">
                                <div class="text-white text-center">
                                    <div class="text-sm font-medium opacity-80 uppercase tracking-widest mb-1">Thành lập</div>
                                    <div class="text-4xl font-bold">2025</div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-10">
                            <div class="space-y-4">
                                <div class="inline-block text-primary font-bold uppercase tracking-widest text-xs py-1 px-3 bg-primary/10 rounded-full">
                                    Về chúng tôi
                                </div>
                                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 leading-[1.2]">
                                    {{ section.data.title }}
                                </h2>
                                <p class="text-slate-600 text-lg leading-relaxed font-normal">
                                    {{ section.data.content }}
                                </p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-3">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-primary border border-slate-100">
                                        <History class="w-6 h-6" />
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Kinh nghiệm</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">Khẳng định vị thế trên thị trường.</p>
                                </div>
                                <div class="space-y-3">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-primary border border-slate-100">
                                        <Users class="w-6 h-6" />
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Đội ngũ</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">Kỹ sư trình độ cao, giàu kinh nghiệm thực tiễn.</p>
                                </div>
                                <div class="space-y-3">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-primary border border-slate-100">
                                        <Wrench class="w-6 h-6" />
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Thiết bị</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">Hệ thống máy móc gia công hiện đại, chính xác.</p>
                                </div>
                            </div>

                            <div class="pt-4">
                                <component :is="(section.data.btn_link || '/gioi-thieu').startsWith('http') ? 'a' : Link"
                                           :href="section.data.btn_link || '/gioi-thieu'" 
                                           class="inline-flex items-center gap-2 text-primary font-bold group">
                                    {{ section.data.btn_text || 'Khám phá câu chuyện của chúng tôi' }}
                                    <ArrowRight class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                                </component>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Services Section -->
            <section v-if="section.type === 'services'" class="py-24 bg-slate-50">
                <div class="container mx-auto px-4">
                    <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
                        <div class="inline-block text-primary font-bold uppercase tracking-widest text-xs py-1 px-3 bg-primary/10 rounded-full">
                            Lĩnh vực hoạt động
                        </div>
                        <h2 class="text-3xl md:text-5xl font-bold text-slate-900">{{ section.data.title }}</h2>
                        <p class="text-slate-500 text-lg max-w-2xl mx-auto">{{ section.data.subtitle }}</p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-8">
                        <div v-for="service in section.data.items" :key="service.title" 
                             class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 w-full sm:w-[calc(50%-16px)] lg:w-[calc(25%-24px)] max-w-sm">
                            <div class="h-52 overflow-hidden relative">
                                <img :src="service.image" :alt="service.title" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-slate-900/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            <div class="p-6 space-y-4">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors leading-snug min-h-[3.5rem] flex items-center">
                                    {{ service.title }}
                                </h3>
                                <Link :href="service.link" class="inline-flex items-center gap-2 text-sm font-bold text-primary group/link">
                                    Tìm hiểu thêm
                                    <ArrowRight class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mission Section -->
            <section v-if="section.type === 'mission'" class="bg-white py-24">
                <div class="container mx-auto px-4">
                    <div class="mx-auto mb-14 max-w-3xl text-center">
                        <div class="inline-block rounded-full bg-primary/10 px-3 py-1 text-xs font-bold uppercase tracking-widest text-primary">
                            Định hướng phát triển
                        </div>
                        <h2 class="mt-4 text-3xl font-bold leading-tight text-slate-900 md:text-5xl">
                            {{ section.data.title || 'Tầm nhìn - Sứ mệnh - Mục tiêu' }}
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                        <article
                            v-for="card in (section.data.cards || [])"
                            :key="card.key || card.title"
                            class="relative rounded-2xl border border-primary/20 bg-gradient-to-b from-white to-sky-50 p-8 pt-12 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                        >
                            <div class="absolute left-1/2 top-0 flex h-16 w-16 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border-4 border-white bg-primary text-white shadow-lg">
                                <component :is="missionIconMap[card.key] || Award" class="h-7 w-7" />
                            </div>
                            <h3 class="mb-4 text-xl font-bold uppercase text-slate-900">{{ card.title }}</h3>
                            <p class="text-left text-base leading-8 text-slate-700">{{ card.content }}</p>
                        </article>
                    </div>

                    <div class="mt-8 rounded-[2rem] border border-primary/20 bg-gradient-to-b from-white to-sky-50 p-8 shadow-sm md:p-10">
                        <div class="flex flex-col gap-6 md:flex-row md:items-start">
                            <div class="flex h-20 w-20 flex-shrink-0 items-center justify-center rounded-full bg-primary text-white shadow-lg">
                                <Award class="h-10 w-10" />
                            </div>
                            <div>
                                <h3 class="mb-5 text-2xl font-bold uppercase text-slate-900">{{ section.data.coreTitle || 'Giá trị cốt lõi' }}</h3>
                                <ul class="space-y-3 text-base leading-8 text-slate-700">
                                    <li v-for="item in (section.data.coreValues || [])" :key="item.title" class="flex gap-3">
                                        <span class="mt-3 h-1.5 w-1.5 flex-shrink-0 rounded-full bg-primary"></span>
                                        <span><strong>{{ item.title }}:</strong> {{ item.content }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Featured Projects / Products Section -->
            <section v-if="section.type === 'featured_projects'" class="bg-white py-24">
                <div class="container mx-auto px-4">
                    <div class="mb-12 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                        <div class="space-y-2">
                            <div class="inline-block text-primary font-bold uppercase tracking-widest text-xs">
                                {{ section.data.eyebrow || 'Danh mục' }}
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-slate-900">{{ section.data.title || 'Công trình tiêu biểu' }}</h2>
                        </div>
                        <Link href="/san-pham" class="inline-flex w-fit items-center gap-2 rounded-lg bg-primary px-5 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary-dark">
                            Xem tất cả <ArrowRight class="w-4 h-4" />
                        </Link>
                    </div>

                    <div v-if="featuredProducts.length" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <article v-for="product in featuredProducts" :key="product.id" class="group overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-slate-100">
                            <div class="relative aspect-[16/10] overflow-hidden">
                                <img
                                    :src="product.image || 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp'"
                                    :alt="product.name"
                                    class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-110"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/10 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="mb-2 text-xs font-bold uppercase tracking-widest text-primary">{{ product.category?.name || 'Sản phẩm' }}</div>
                                    <h3 class="line-clamp-2 text-xl font-bold text-white">{{ product.name }}</h3>
                                </div>
                            </div>
                            <div class="space-y-4 p-6">
                                <p class="line-clamp-2 text-sm leading-6 text-slate-600">{{ product.excerpt }}</p>
                                <Link href="/san-pham" class="inline-flex w-fit items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-sm font-bold text-white transition hover:bg-primary group/btn">
                                    Xem chi tiết <ArrowRight class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" />
                                </Link>
                            </div>
                        </article>
                    </div>

                    <div v-else class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-14 text-center text-slate-500">
                        Chưa có sản phẩm/công trình nào trong danh mục đã chọn.
                    </div>
                </div>
            </section>

            <!-- Partners Section -->
            <section v-if="section.type === 'partners'" class="bg-white py-20">
                <div class="container mx-auto px-4">
                    <div class="mb-12 text-center">
                        <div class="inline-block text-primary font-bold uppercase tracking-widest text-xs py-1 px-3 bg-primary/10 rounded-full">
                            Đối tác
                        </div>
                        <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">
                            {{ section.data.title || 'Đối tác - Khách hàng' }}
                        </h2>
                    </div>

                    <div v-if="section.data.images?.length" class="flex flex-wrap justify-center gap-6">
                        <div v-for="image in section.data.images" :key="image" class="flex h-24 w-[160px] sm:w-[180px] items-center justify-center rounded-lg border border-slate-100 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                            <img :src="image" alt="Đối tác khách hàng TECOTECH" class="max-h-full max-w-full object-contain">
                        </div>
                    </div>
                </div>
            </section>
        </template>

        <!-- Latest News -->
        <section class="bg-slate-50 py-24">
            <div class="container mx-auto px-4">
                <div class="flex items-end justify-between mb-12">
                    <div class="space-y-2">
                        <div class="inline-block text-primary font-bold uppercase tracking-widest text-xs">Cập nhật</div>
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Tin tức & Sự kiện</h2>
                    </div>
                    <Link href="/tin-tuc" class="btn btn-ghost hover:bg-white rounded-xl font-bold text-primary">
                        Xem tất cả <ArrowRight class="ml-2 w-4 h-4" />
                    </Link>
                </div>
                
                <div v-if="featuredPosts.length" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <article v-for="post in featuredPosts" :key="post.id" 
                             class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col">
                        <Link :href="route('posts.show', post.slug)" class="aspect-[16/10] overflow-hidden">
                            <img :src="post.image || 'https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp'" 
                                 :alt="post.title" 
                                 class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        </Link>
                        <div class="p-6 flex-grow flex flex-col space-y-3">
                            <div class="flex items-center gap-3 text-[10px] font-bold uppercase tracking-[0.15em] text-slate-400">
                                <span class="text-primary">{{ post.categoryRelation?.name || 'Tin tức' }}</span>
                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                <span>{{ formatDate(post.created_at) }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                <Link :href="route('posts.show', post.slug)">{{ post.title }}</Link>
                            </h3>
                            <p class="text-slate-500 text-sm line-clamp-2 flex-grow">
                                {{ post.excerpt }}
                            </p>
                        </div>
                    </article>
                </div>
                <div v-else class="bg-white rounded-3xl border-2 border-dashed border-slate-200 p-16 text-center">
                    <p class="text-slate-400 font-medium">Nội dung đang được cập nhật...</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section v-if="showCta" class="relative py-24 bg-slate-900 overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <img :src="ctaBg" class="w-full h-full object-cover" />
            </div>
            <div class="container relative mx-auto px-4 text-center z-10">
                <div class="max-w-4xl mx-auto space-y-10">
                    <h2 class="text-3xl md:text-5xl font-bold text-white leading-tight">
                        {{ ctaTitle }}
                    </h2>
                    <p class="text-slate-400 text-lg md:text-xl font-normal max-w-2xl mx-auto opacity-80">
                        {{ ctaDesc }}
                    </p>
                    <div class="pt-6 flex justify-center gap-6 flex-wrap">
                        <component :is="ctaBtn1Link.startsWith('http') ? 'a' : Link"
                                   :href="ctaBtn1Link" 
                                   class="btn btn-primary btn-lg rounded-xl px-12 font-bold shadow-xl shadow-primary/30">
                            {{ ctaBtn1Text }}
                        </component>
                        <component v-if="ctaBtn2Text"
                                   :is="ctaBtn2Link.startsWith('http') ? 'a' : Link"
                                   :href="ctaBtn2Link" 
                                   class="btn bg-white/5 hover:bg-white/10 backdrop-blur-md text-white border-white/10 hover:border-white/20 btn-lg rounded-xl px-12 font-bold">
                            {{ ctaBtn2Text }}
                        </component>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style scoped>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
}
</style>
