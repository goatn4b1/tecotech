<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const flash = computed(() => page.props.flash || {});
const processingAction = ref(null);

const cards = [
    {
        title: 'Cấu hình chung',
        desc: 'SĐT, email, mạng xã hội, địa chỉ.',
        href: 'admin.settings.index',
        icon: 'fas fa-cogs',
        color: 'blue',
    },
    {
        title: 'Quản lý menu',
        desc: 'Cấu trúc đa cấp và link điều hướng.',
        href: 'admin.menus.index',
        icon: 'fas fa-list',
        color: 'orange',
    },
    {
        title: 'Cấu hình trang chủ',
        desc: 'Kéo thả, banner, giới thiệu, đối tác.',
        href: 'admin.home-builder.index',
        icon: 'fas fa-columns',
        color: 'purple',
    },
    {
        title: 'Quản lý bài viết',
        desc: 'Tin tức, sự kiện, chuyên môn.',
        href: 'admin.posts.index',
        icon: 'fas fa-newspaper',
        color: 'red',
    },
    {
        title: 'Trang nội dung',
        desc: 'Giới thiệu, chính sách, tuyển dụng.',
        href: 'admin.pages.index',
        icon: 'fas fa-file-lines',
        color: 'emerald',
    },
    {
        title: 'Tài khoản',
        desc: 'Đổi mật khẩu và thông tin cá nhân.',
        href: 'profile.edit',
        icon: 'fas fa-user',
        color: 'green',
    },
];

const colorClasses = {
    blue: 'bg-blue-100 text-blue-600 group-hover:bg-blue-500',
    orange: 'bg-orange-100 text-orange-600 group-hover:bg-orange-500',
    purple: 'bg-purple-100 text-purple-600 group-hover:bg-purple-500',
    red: 'bg-red-100 text-red-600 group-hover:bg-red-500',
    emerald: 'bg-emerald-100 text-emerald-600 group-hover:bg-emerald-500',
    green: 'bg-green-100 text-green-600 group-hover:bg-green-500',
};

const postMaintenance = (routeName, action) => {
    if (action === 'build' && !confirm('Build lại assets có thể mất vài chục giây. Tiếp tục?')) {
        return;
    }

    processingAction.value = action;
    router.post(route(routeName), {}, {
        preserveScroll: true,
        onFinish: () => {
            processingAction.value = null;
        },
    });
};
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Admin Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-8 sm:px-6 lg:px-8">
                <div v-if="flash.success || flash.error" class="rounded-lg border p-4 text-sm" :class="flash.success ? 'border-green-200 bg-green-50 text-green-800' : 'border-red-200 bg-red-50 text-red-800'">
                    {{ flash.success || flash.error }}
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <Link v-for="card in cards" :key="card.href" :href="route(card.href)" class="group overflow-hidden bg-white p-6 shadow-sm transition hover:shadow-md sm:rounded-lg">
                        <div class="flex items-center">
                            <div class="mr-4 rounded-lg p-3 transition-colors" :class="colorClasses[card.color]">
                                <i :class="[card.icon, 'text-2xl group-hover:text-white']"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ card.title }}</h3>
                                <p class="text-sm text-gray-500">{{ card.desc }}</p>
                            </div>
                        </div>
                    </Link>
                </div>

                <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Bảo trì hệ thống</h3>
                            <p class="mt-1 text-sm text-gray-500">Dùng sau khi chỉnh cấu hình, route, view hoặc cập nhật giao diện frontend.</p>
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <button
                                type="button"
                                :disabled="processingAction !== null"
                                @click="postMaintenance('admin.maintenance.clear-cache', 'cache')"
                                class="inline-flex items-center justify-center rounded-md bg-slate-800 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700 disabled:opacity-60"
                            >
                                <i class="fas fa-broom mr-2"></i>
                                {{ processingAction === 'cache' ? 'Đang xóa cache...' : 'Xóa cache' }}
                            </button>
                            <button
                                type="button"
                                :disabled="processingAction !== null"
                                @click="postMaintenance('admin.maintenance.build-assets', 'build')"
                                class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary-dark disabled:opacity-60"
                            >
                                <i class="fas fa-hammer mr-2"></i>
                                {{ processingAction === 'build' ? 'Đang build...' : 'Build lại dự án' }}
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
