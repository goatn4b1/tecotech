<script setup>
defineProps({
    title: String,
    subtitle: String,
    backgroundImage: {
        type: String,
        default: 'https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg'
    }
});
</script>

<template>
    <section class="relative h-[350px] md:h-[450px] flex items-center overflow-hidden bg-slate-900">
        <div class="absolute inset-0">
            <img :src="backgroundImage" class="w-full h-full object-cover opacity-40" alt="Background">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-950/40 to-transparent"></div>
        </div>
        
        <div class="container relative z-10 mx-auto px-4 mt-12">
            <div class="max-w-3xl space-y-6">
                <nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-primary/80">
                    <span>Trang chủ</span>
                    <span class="w-1 h-1 rounded-full bg-slate-500"></span>
                    <span class="text-white">{{ title }}</span>
                </nav>
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                    {{ title }}
                </h1>
                <p v-if="subtitle" class="text-lg md:text-xl text-slate-300 font-normal max-w-2xl opacity-90 leading-relaxed">
                    {{ subtitle }}
                </p>
            </div>
        </div>
    </section>
</template>
