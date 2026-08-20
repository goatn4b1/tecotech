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
    'prose-p:leading-8',
    'prose-p:text-slate-700',
    'prose-li:text-slate-700',
    'prose-a:text-primary',
    'prose-img:rounded-xl',
    'prose-img:shadow-md',
].join(' ');
</script>

<template>
    <div :class="contentClass" v-html="html" />
</template>
