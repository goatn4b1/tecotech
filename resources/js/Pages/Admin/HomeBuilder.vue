<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import draggable from 'vuedraggable';

const props = defineProps({
    sections: Array,
});

const sectionList = ref(props.sections);
const editingSection = ref(null);
const isEditing = ref(false);

const updateOrder = () => {
    const orderedSections = sectionList.value.map((section, index) => ({
        id: section.id,
        order: index + 1,
    }));

    router.post(route('admin.home-builder.order'), { sections: orderedSections }, {
        preserveScroll: true,
        onSuccess: () => alert('Đã cập nhật thứ tự!'),
    });
};

const toggleActive = (id) => {
    router.patch(route('admin.home-builder.toggle', id), {}, { preserveScroll: true });
};

const editSection = (section) => {
    editingSection.value = JSON.parse(JSON.stringify(section));
    isEditing.value = true;
};

const saveSection = () => {
    const savedSection = JSON.parse(JSON.stringify(editingSection.value));

    router.patch(route('admin.home-builder.update', editingSection.value.id), {
        data: editingSection.value.data,
    }, {
        preserveScroll: true,
        onSuccess: () => {
            const index = sectionList.value.findIndex((section) => section.id === savedSection.id);
            if (index !== -1) sectionList.value[index] = savedSection;
            isEditing.value = false;
            editingSection.value = null;
            alert('Đã cập nhật nội dung component!');
        },
    });
};

const uploadImage = async (event, assign) => {
    const file = event.target.files?.[0] || null;
    if (!file) return;

    const data = new FormData();
    data.append('image', file);

    const response = await window.axios.post(route('admin.uploads.images'), data, {
        headers: { 'Content-Type': 'multipart/form-data' },
    });

    assign(response.data.url);
};

const cancelEdit = () => {
    isEditing.value = false;
    editingSection.value = null;
};
</script>

<template>
    <Head title="Cấu hình Trang chủ" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Cấu hình Trang chủ (kéo thả)</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto flex max-w-7xl gap-8 sm:px-6 lg:px-8">
                <div class="w-1/2 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-800">Các component</h3>
                        <button @click="updateOrder" class="rounded bg-gray-800 px-3 py-1 text-sm text-white hover:bg-gray-700">Lưu thứ tự</button>
                    </div>

                    <p class="mb-4 text-sm text-gray-500">Kéo thả để thay đổi vị trí hiển thị trên trang chủ.</p>

                    <draggable v-model="sectionList" item-key="id" class="space-y-3" handle=".handle">
                        <template #item="{element}">
                            <div class="flex items-center justify-between rounded-lg border bg-gray-50 p-3 shadow-sm transition-all" :class="{'opacity-50': !element.is_active}">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-grip-vertical handle cursor-move text-gray-400"></i>
                                    <div class="font-bold text-gray-700">{{ element.name }} <span class="ml-2 text-xs font-normal text-gray-400">({{ element.type }})</span></div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button @click="toggleActive(element.id)" :title="element.is_active ? 'Đang bật - click để ẩn' : 'Đang ẩn - click để bật'">
                                        <i v-if="element.is_active" class="fas fa-eye text-green-500"></i>
                                        <i v-else class="fas fa-eye-slash text-gray-400"></i>
                                    </button>
                                    <button @click="editSection(element)" class="text-blue-500 hover:text-blue-700" title="Chỉnh sửa nội dung">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </draggable>
                </div>

                <div class="w-1/2">
                    <div v-if="isEditing" class="border-t-4 border-primary bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="mb-4 text-lg font-bold text-gray-800">Chỉnh sửa: {{ editingSection.name }}</h3>

                        <form @submit.prevent="saveSection" class="space-y-4">
                            <div v-if="editingSection.type === 'hero'">
                                <p class="mb-2 text-sm text-gray-500">Cấu hình banner chính.</p>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Tiêu đề lớn</label>
                                    <input v-model="editingSection.data.slides[0].title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Phần highlight trong tiêu đề</label>
                                    <input v-model="editingSection.data.slides[0].highlight" type="text" placeholder="Nhập đúng cụm chữ trong tiêu đề để đổi màu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <p class="mt-1 text-xs text-gray-500">Ví dụ tiêu đề có chữ TECOTECH, nhập TECOTECH để phần này hiển thị màu nhấn.</p>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Mô tả nhỏ</label>
                                    <input v-model="editingSection.data.slides[0].desc" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Ảnh banner</label>
                                    <input type="file" accept="image/*" @change="uploadImage($event, (url) => editingSection.data.slides[0].image = url)" class="mt-1 block w-full text-sm text-gray-700">
                                    <img v-if="editingSection.data.slides[0].image" :src="editingSection.data.slides[0].image" class="mt-2 h-20 rounded object-cover">
                                </div>
                            </div>

                            <div v-if="editingSection.type === 'about'">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                                    <input v-model="editingSection.data.title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Nội dung</label>
                                    <textarea v-model="editingSection.data.content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Ảnh đại diện</label>
                                    <input type="file" accept="image/*" @change="uploadImage($event, (url) => editingSection.data.image = url)" class="mt-1 block w-full text-sm text-gray-700">
                                    <img v-if="editingSection.data.image" :src="editingSection.data.image" class="mt-2 h-20 rounded object-cover">
                                </div>
                            </div>

                            <div v-if="editingSection.type === 'services'">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                                    <input v-model="editingSection.data.title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Phụ đề</label>
                                    <input v-model="editingSection.data.subtitle" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <p class="mt-4 border-b pb-1 text-sm font-bold">Danh sách dịch vụ</p>
                                <div v-for="(item, idx) in editingSection.data.items" :key="idx" class="mb-2 rounded border bg-gray-50 p-2">
                                    <input v-model="item.title" placeholder="Tên dịch vụ" class="mb-1 w-full rounded border-gray-300 text-sm">
                                    <input type="file" accept="image/*" @change="uploadImage($event, (url) => item.image = url)" class="mb-1 w-full text-sm">
                                    <img v-if="item.image" :src="item.image" class="mb-1 h-16 rounded object-cover">
                                    <input v-model="item.link" placeholder="Link trang chi tiết" class="w-full rounded border-gray-300 text-sm">
                                </div>
                            </div>

                            <div v-if="editingSection.type === 'partners'">
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                                    <input v-model="editingSection.data.title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <p class="mt-4 border-b pb-1 text-sm font-bold">Ảnh đối tác</p>
                                <div v-for="(img, idx) in editingSection.data.images" :key="idx" class="mb-2 flex items-center gap-2">
                                    <input type="file" accept="image/*" @change="uploadImage($event, (url) => editingSection.data.images[idx] = url)" class="flex-grow text-sm">
                                    <img v-if="img" :src="img" class="h-10 w-20 rounded border bg-white object-contain">
                                    <button type="button" @click="editingSection.data.images.splice(idx, 1)" class="text-red-500"><i class="fas fa-times"></i></button>
                                </div>
                                <button type="button" @click="editingSection.data.images.push('')" class="text-sm text-blue-500"><i class="fas fa-plus"></i> Thêm ảnh</button>
                            </div>

                            <div class="flex gap-2 border-t border-gray-200 pt-4">
                                <button type="submit" class="rounded bg-primary px-4 py-2 text-white shadow hover:bg-primary-dark">Cập nhật nội dung</button>
                                <button type="button" @click="cancelEdit" class="rounded bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">Hủy</button>
                            </div>
                        </form>
                    </div>
                    <div v-else class="flex h-full min-h-[300px] items-center justify-center rounded-lg border-2 border-dashed border-gray-200 bg-gray-50 text-gray-400">
                        Chọn một module bên trái để chỉnh sửa nội dung
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
