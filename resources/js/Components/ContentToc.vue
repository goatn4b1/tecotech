<script setup>
import { ListTree } from 'lucide-vue-next';

defineProps({
    items: {
        type: Array,
        default: () => [],
    },
    title: {
        type: String,
        default: 'Mục lục',
    },
    variant: {
        type: String,
        default: 'sidebar',
    },
});
</script>

<template>
    <div
        v-if="items.length"
        :class="[
            variant === 'mobile'
                ? 'rounded-2xl border border-slate-100 bg-slate-50 p-5'
                : 'rounded-3xl border border-slate-100 bg-white p-8 shadow-sm',
        ]"
    >
        <div
            :class="[
                'flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-slate-900',
                variant === 'mobile' ? 'mb-4' : 'mb-6',
            ]"
        >
            <ListTree class="h-4 w-4 text-primary" />
            {{ title }}
        </div>

        <nav class="space-y-2">
            <a
                v-for="item in items"
                :key="item.id"
                :href="`#${item.id}`"
                :class="[
                    'block rounded-lg px-3 py-2 text-sm font-semibold leading-5 text-slate-600 transition',
                    variant === 'mobile' ? 'hover:bg-white hover:text-primary' : 'hover:bg-slate-50 hover:text-primary',
                    item.level === 3 ? 'pl-7' : '',
                    item.level >= 4 ? 'pl-10 text-xs' : '',
                ]"
            >
                {{ item.text }}
            </a>
        </nav>
    </div>
</template>
