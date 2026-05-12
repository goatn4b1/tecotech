<script setup>
defineProps({
    form: Object
});
</script>

<template>
    <div class="space-y-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
        <h3 class="text-lg font-medium text-gray-900 flex items-center gap-2">
            <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
            Cấu hình SEO
        </h3>
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Meta Title (Tiêu đề SEO)</label>
            <input 
                v-model="form.meta_title" 
                type="text" 
                placeholder="Mặc định dùng tiêu đề bài viết"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
            />
            <p class="mt-1 text-xs text-gray-500">Nên dưới 60 ký tự. Hiển thị trên kết quả tìm kiếm Google.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Meta Description (Mô tả SEO)</label>
            <textarea 
                v-model="form.meta_description" 
                rows="3" 
                placeholder="Mô tả ngắn gọn nội dung trang"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
            />
            <p class="mt-1 text-xs text-gray-500">Nên từ 150-160 ký tự để hiển thị tốt nhất.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Meta Keywords (Từ khóa SEO)</label>
            <input 
                v-model="form.meta_keywords" 
                type="text" 
                placeholder="Từ khóa 1, từ khóa 2, ..."
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
            />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Canonical URL (Đường dẫn chuẩn)</label>
            <input 
                v-model="form.canonical_url" 
                type="text" 
                placeholder="https://tecotech.com.vn/duong-dan"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
            />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">OG Image URL (Ảnh khi chia sẻ)</label>
            <input 
                v-model="form.og_image" 
                type="text" 
                placeholder="Link ảnh hiển thị khi share Facebook/Zalo"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" 
            />
        </div>
    </div>
</template>
