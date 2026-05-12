<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    menus: Array,
    parentMenus: Array
});

const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    name: '',
    link: '',
    parent_id: '',
    order: 0,
});

const submit = () => {
    if (isEditing.value) {
        form.patch(route('admin.menus.update', editingId.value), {
            onSuccess: () => resetForm(),
        });
    } else {
        form.post(route('admin.menus.store'), {
            onSuccess: () => resetForm(),
        });
    }
};

const editMenu = (menu) => {
    isEditing.value = true;
    editingId.value = menu.id;
    form.name = menu.name;
    form.link = menu.link;
    form.parent_id = menu.parent_id || '';
    form.order = menu.order;
};

const deleteMenu = (id) => {
    if (confirm('Bạn có chắc chắn muốn xóa menu này?')) {
        router.delete(route('admin.menus.destroy', id));
    }
};

const resetForm = () => {
    form.reset();
    isEditing.value = false;
    editingId.value = null;
};
</script>

<template>
    <Head title="Quản lý Menu" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý Menu</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Form -->
                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-bold mb-4">{{ isEditing ? 'Cập nhật Menu' : 'Thêm Menu mới' }}</h3>
                        <form @submit.prevent="submit" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tên hiển thị</label>
                                <input v-model="form.name" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Đường dẫn (Link)</label>
                                <input v-model="form.link" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Menu cha (Parent)</label>
                                <select v-model="form.parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Không có (Menu chính) --</option>
                                    <option v-for="parent in parentMenus" :key="parent.id" :value="parent.id">{{ parent.name }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Thứ tự (Order)</label>
                                <input v-model="form.order" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark transition">
                                    {{ isEditing ? 'Cập nhật' : 'Thêm mới' }}
                                </button>
                                <button v-if="isEditing" @click="resetForm" type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                                    Hủy
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- List -->
                    <div class="md:col-span-2 bg-white p-6 shadow-sm sm:rounded-lg">
                        <h3 class="text-lg font-bold mb-4">Cấu trúc Menu</h3>
                        <div class="space-y-4">
                            <div v-for="menu in menus" :key="menu.id" class="border rounded-lg overflow-hidden">
                                <div class="bg-gray-50 p-4 flex justify-between items-center">
                                    <div>
                                        <span class="font-bold text-gray-800">{{ menu.name }}</span>
                                        <span class="text-gray-400 text-sm ml-2">({{ menu.link }})</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <button @click="editMenu(menu)" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i></button>
                                        <button @click="deleteMenu(menu.id)" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <div v-if="menu.children && menu.children.length > 0" class="pl-8 py-2 bg-white">
                                    <div v-for="child in menu.children" :key="child.id" class="p-3 border-b last:border-0 flex justify-between items-center">
                                        <div>
                                            <i class="fas fa-level-up-alt fa-rotate-90 text-gray-300 mr-2"></i>
                                            <span class="text-gray-700">{{ child.name }}</span>
                                            <span class="text-gray-400 text-xs ml-2">({{ child.link }})</span>
                                        </div>
                                        <div class="flex gap-2">
                                            <button @click="editMenu(child)" class="text-blue-500 hover:text-blue-700 text-sm"><i class="fas fa-edit"></i></button>
                                            <button @click="deleteMenu(child.id)" class="text-red-500 hover:text-red-700 text-sm"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
