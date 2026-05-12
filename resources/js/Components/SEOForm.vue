<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    titleSource: {
        type: String,
        default: ''
    },
    descriptionSource: {
        type: String,
        default: ''
    },
    baseUrl: {
        type: String,
        default: window.location.origin
    },
    showRobots: {
        type: Boolean,
        default: true
    },
    showCanonical: {
        type: Boolean,
        default: true
    }
});

const isOpen = ref(false);

const metaTitle = computed(() => props.form.meta_title || props.titleSource || 'Tiêu đề trang');
const metaDescription = computed(() => props.form.meta_description || props.descriptionSource || 'Mô tả nội dung trang web của bạn sẽ hiển thị tại đây để người dùng có thể đọc trước khi click vào link...');

const titleLength = computed(() => (props.form.meta_title || '').length);
const descLength = computed(() => (props.form.meta_description || '').length);

const titleStatus = computed(() => {
    if (titleLength.value === 0) return 'gray';
    if (titleLength.value <= 60) return 'green';
    return 'red';
});

const descStatus = computed(() => {
    if (descLength.value === 0) return 'gray';
    if (descLength.value >= 120 && descLength.value <= 160) return 'green';
    if (descLength.value < 120) return 'yellow';
    return 'red';
});

const toggleOpen = () => {
    isOpen.value = !isOpen.value;
};
</script>

<template>
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <button 
            type="button"
            @click="toggleOpen"
            class="flex w-full items-center justify-between bg-gray-50 px-4 py-3 text-left transition-hover hover:bg-gray-100"
        >
            <span class="flex items-center gap-2 font-semibold text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cấu hình SEO & Social
            </span>
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="h-5 w-5 text-gray-400 transition-transform duration-200" 
                :class="{ 'rotate-180': isOpen }"
                fill="none" viewBox="0 0 24 24" stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div v-show="isOpen" class="border-t border-gray-200 p-4 space-y-6">
            <!-- Google Preview -->
            <div class="rounded bg-white p-3 border border-gray-100 shadow-inner">
                <span class="text-xs font-bold uppercase text-gray-400 mb-2 block">Xem trước kết quả tìm kiếm</span>
                <div class="max-w-[600px] font-sans">
                    <div class="text-[14px] text-[#202124] flex items-center mb-1 overflow-hidden whitespace-nowrap">
                        {{ baseUrl }} <span class="mx-1 text-gray-400">›</span> ...
                    </div>
                    <div class="text-[20px] text-[#1a0dab] hover:underline cursor-pointer leading-tight mb-1 truncate">
                        {{ metaTitle }}
                    </div>
                    <div class="text-[14px] text-[#4d5156] leading-relaxed line-clamp-2">
                        {{ metaDescription }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Meta Title -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-sm font-medium text-gray-700">Tiêu đề SEO (Meta Title)</label>
                        <span class="text-xs" :class="{
                            'text-gray-400': titleStatus === 'gray',
                            'text-green-600': titleStatus === 'green',
                            'text-red-600': titleStatus === 'red'
                        }">{{ titleLength }}/60</span>
                    </div>
                    <input 
                        v-model="form.meta_title" 
                        type="text" 
                        placeholder="Mặc định dùng tiêu đề bài viết"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
                    />
                </div>

                <!-- Meta Description -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-sm font-medium text-gray-700">Mô tả SEO (Meta Description)</label>
                        <span class="text-xs" :class="{
                            'text-gray-400': descStatus === 'gray',
                            'text-green-600': descStatus === 'green',
                            'text-yellow-600': descStatus === 'yellow',
                            'text-red-600': descStatus === 'red'
                        }">{{ descLength }}/160</span>
                    </div>
                    <textarea 
                        v-model="form.meta_description" 
                        rows="3" 
                        placeholder="Mô tả ngắn gọn nội dung trang"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
                    />
                </div>

                <!-- Meta Keywords -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Từ khóa (Meta Keywords)</label>
                    <input 
                        v-model="form.meta_keywords" 
                        type="text" 
                        placeholder="Từ khóa 1, từ khóa 2, ..."
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
                    />
                </div>

                <!-- OG Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ảnh chia sẻ (Social Image URL)</label>
                    <div class="flex gap-2">
                        <input 
                            v-model="form.og_image" 
                            type="text" 
                            placeholder="Link ảnh (Facebook, Zalo...)"
                            class="block flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
                        />
                    </div>
                    <p class="mt-1 text-xs text-gray-500 italic">Kích thước khuyến nghị: 1200x630px.</p>
                </div>

                <!-- Advanced Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-gray-100">
                    <div v-if="showCanonical">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Canonical URL</label>
                        <input 
                            v-model="form.canonical_url" 
                            type="text" 
                            placeholder="Đường dẫn chuẩn"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
                        />
                    </div>
                    
                    <div v-if="showRobots">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Robots Meta</label>
                        <select 
                            v-model="form.meta_robots" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        >
                            <option :value="null">Mặc định (index, follow)</option>
                            <option value="index, follow">index, follow</option>
                            <option value="noindex, follow">noindex, follow</option>
                            <option value="index, nofollow">index, nofollow</option>
                            <option value="noindex, nofollow">noindex, nofollow</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Social Media Preview Tabs (Mini) -->
            <div class="pt-4 border-t border-gray-100">
                <span class="text-xs font-bold uppercase text-gray-400 mb-3 block">Xem trước chia sẻ mạng xã hội</span>
                <div class="bg-[#f0f2f5] rounded-xl overflow-hidden border border-gray-200 max-w-[500px]">
                    <div v-if="form.og_image" class="h-[260px] bg-gray-200 overflow-hidden">
                        <img :src="form.og_image" class="w-full h-full object-cover" />
                    </div>
                    <div v-else class="h-[260px] bg-gray-300 flex items-center justify-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="p-3 bg-white border-t border-gray-200">
                        <div class="text-xs text-gray-500 uppercase">{{ new URL(baseUrl).hostname }}</div>
                        <div class="font-bold text-[16px] text-[#1c1e21] leading-tight my-1 truncate">{{ metaTitle }}</div>
                        <div class="text-sm text-[#606770] line-clamp-1">{{ metaDescription }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
