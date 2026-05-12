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
    <section class="relative h-[300px] md:h-[400px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img :src="backgroundImage" class="w-full h-full object-cover" alt="Background">
            <div class="absolute inset-0 bg-primary-dark/70 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>
        
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-16">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white uppercase tracking-wider mb-4 shadow-sm" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                {{ title }}
            </h1>
            <div class="w-24 h-1 bg-secondary mx-auto mb-6 rounded-full"></div>
            <p v-if="subtitle" class="text-lg md:text-xl text-gray-200 font-medium" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                {{ subtitle }}
            </p>
        </div>
    </section>
</template>
