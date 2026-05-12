<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    title: String,
    description: String,
    keywords: String,
    image: String,
    canonical: String,
    robots: String,
});

const page = usePage();
const defaults = computed(() => page.props.seoDefaults);

const seoTitle = computed(() => props.title || defaults.value.title);
const seoDescription = computed(() => props.description || defaults.value.description);
const seoKeywords = computed(() => props.keywords || defaults.value.keywords);
const seoImage = computed(() => props.image || defaults.value.image);
const seoFavicon = computed(() => defaults.value.favicon);
const seoCanonical = computed(() => props.canonical || defaults.value.canonical || window.location.href);
const seoRobots = computed(() => props.robots || defaults.value.robots || 'index, follow');
</script>

<template>
    <Head>
        <title>{{ seoTitle }}</title>
        <meta name="description" :content="seoDescription" />
        <meta name="keywords" :content="seoKeywords" />
        <meta name="robots" :content="seoRobots" />
        <link rel="canonical" :href="seoCanonical" />
        <link rel="icon" :href="seoFavicon" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="seoTitle" />
        <meta property="og:description" :content="seoDescription" />
        <meta property="og:image" :content="seoImage" />
        <meta property="og:url" :content="seoCanonical" />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="seoTitle" />
        <meta name="twitter:description" :content="seoDescription" />
        <meta name="twitter:image" :content="seoImage" />
    </Head>
</template>
