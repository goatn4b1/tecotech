<script setup>
defineProps({
    html: {
        type: String,
        default: '',
    },
});

const contentClass = [
    'prose',
    'prose-lg',
    'prose-slate',
    'max-w-none',
    'prose-headings:font-extrabold',
    'prose-headings:text-slate-900',
    'prose-h2:mt-12',
    'prose-h2:border-l-4',
    'prose-h2:border-primary',
    'prose-h2:pl-4',
    'prose-h2:leading-tight',
    'prose-h3:text-slate-900',
    'prose-p:leading-8',
    'prose-p:text-slate-700',
    'prose-li:leading-8',
    'prose-li:text-slate-700',
    'prose-strong:text-slate-900',
    'prose-a:text-primary',
    'prose-blockquote:border-primary',
    'prose-blockquote:bg-primary/5',
    'prose-blockquote:px-6',
    'prose-blockquote:py-4',
    'prose-blockquote:rounded-r-xl',
    'prose-img:rounded-2xl',
    'prose-img:shadow-lg',
].join(' ');
</script>

<template>
    <div :class="contentClass" v-html="html" />
</template>
