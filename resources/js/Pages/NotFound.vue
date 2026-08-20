<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ArrowLeft, Home, Phone, SearchX } from 'lucide-vue-next';

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
        return;
    }

    window.location.href = '/';
};
</script>

<template>
    <MainLayout
        title="Không tìm thấy trang - TECOTECH"
        description="Trang bạn đang tìm kiếm không tồn tại hoặc đã được di chuyển."
        robots="noindex, follow"
    >
        <section class="relative overflow-hidden bg-slate-950 py-20 text-white md:py-28">
            <div class="absolute inset-0 opacity-15">
                <img
                    src="https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp"
                    alt=""
                    class="h-full w-full object-cover"
                >
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/95 to-slate-950"></div>

            <div class="container relative mx-auto max-w-5xl px-4 text-center">
                <div class="mx-auto mb-8 flex h-20 w-20 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-primary backdrop-blur">
                    <SearchX class="h-10 w-10" />
                </div>

                <p class="mb-4 text-sm font-bold uppercase tracking-[0.28em] text-primary">Lỗi 404</p>
                <h1 class="mx-auto max-w-3xl text-4xl font-extrabold leading-tight md:text-6xl">
                    Không tìm thấy trang
                </h1>
                <p class="mx-auto mt-6 max-w-2xl text-base leading-8 text-slate-300 md:text-lg">
                    Đường dẫn này có thể đã thay đổi, bị xóa hoặc chưa được cấu hình trong hệ thống.
                    Bạn có thể quay lại trang chủ hoặc liên hệ TECOTECH để được hỗ trợ.
                </p>

                <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                    <Link href="/" class="btn btn-primary btn-lg rounded-xl px-8 font-bold shadow-xl shadow-primary/30">
                        <Home class="h-5 w-5" />
                        Về trang chủ
                    </Link>

                    <button
                        type="button"
                        class="btn border-white/20 bg-white/10 text-white hover:border-white/40 hover:bg-white/20 btn-lg rounded-xl px-8 font-bold"
                        @click="goBack"
                    >
                        <ArrowLeft class="h-5 w-5" />
                        Quay lại
                    </button>
                </div>
            </div>
        </section>

        <section class="bg-white py-16">
            <div class="container mx-auto max-w-7xl px-4">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <Link
                        href="/moi-truong"
                        class="group rounded-2xl border border-slate-100 bg-slate-50 p-8 transition hover:-translate-y-1 hover:border-primary/30 hover:bg-white hover:shadow-xl"
                    >
                        <p class="mb-3 text-xs font-bold uppercase tracking-widest text-primary">Dịch vụ</p>
                        <h2 class="text-xl font-bold text-slate-900 group-hover:text-primary">Tổng thầu EPC về môi trường</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-500">Giải pháp xử lý nước thải, khí thải và môi trường tổng thể.</p>
                    </Link>

                    <Link
                        href="/gia-cong-co-khi"
                        class="group rounded-2xl border border-slate-100 bg-slate-50 p-8 transition hover:-translate-y-1 hover:border-primary/30 hover:bg-white hover:shadow-xl"
                    >
                        <p class="mb-3 text-xs font-bold uppercase tracking-widest text-primary">Sản xuất</p>
                        <h2 class="text-xl font-bold text-slate-900 group-hover:text-primary">Gia công cơ khí</h2>
                        <p class="mt-3 text-sm leading-6 text-slate-500">Chế tạo thiết bị và hạng mục cơ khí theo yêu cầu dự án.</p>
                    </Link>

                    <Link
                        href="/lien-he"
                        class="group rounded-2xl border border-slate-100 bg-slate-50 p-8 transition hover:-translate-y-1 hover:border-primary/30 hover:bg-white hover:shadow-xl"
                    >
                        <p class="mb-3 text-xs font-bold uppercase tracking-widest text-primary">Hỗ trợ</p>
                        <h2 class="flex items-center gap-2 text-xl font-bold text-slate-900 group-hover:text-primary">
                            <Phone class="h-5 w-5" />
                            Liên hệ tư vấn
                        </h2>
                        <p class="mt-3 text-sm leading-6 text-slate-500">Gửi yêu cầu để đội ngũ TECOTECH hỗ trợ đúng nội dung bạn cần.</p>
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
