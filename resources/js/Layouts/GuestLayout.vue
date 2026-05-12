<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 bg-[url('https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg')] bg-cover bg-center relative">
        <!-- Overlays -->
        <div class="absolute inset-0 bg-primary/90 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-80"></div>
        
        <div class="relative z-10 w-full max-w-md px-4 sm:px-6">
            <div class="text-center mb-8">
                <Link href="/">
                    <img src="/images/logo.png" alt="Logo" class="h-16 mx-auto brightness-0 invert drop-shadow-md hover:scale-105 transition-transform">
                </Link>
                <h2 class="mt-6 text-2xl font-extrabold text-white uppercase tracking-widest drop-shadow-md">Hệ thống quản trị</h2>
                <p class="text-primary-100 text-sm mt-2 font-medium">Vui lòng đăng nhập để tiếp tục</p>
            </div>

            <div class="bg-white/95 backdrop-blur-md px-8 py-10 shadow-2xl rounded-3xl border border-white/20">
                <slot />
            </div>
            
            <p class="text-center text-gray-400 text-xs mt-8 font-medium">
                &copy; {{ new Date().getFullYear() }} TECOTECH. All rights reserved.
            </p>
        </div>
    </div>
</template>
