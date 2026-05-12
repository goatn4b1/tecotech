<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Đăng nhập hệ thống" />

        <div v-if="status" class="mb-6 text-sm font-medium text-green-600 bg-green-50 p-4 rounded-xl border border-green-100 shadow-sm text-center">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Tên đăng nhập</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input
                        id="username"
                        type="text"
                        class="block w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl leading-5 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors sm:text-sm"
                        v-model="form.username"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Nhập tên đăng nhập"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-sm font-bold text-gray-700">Mật khẩu</label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-xs font-semibold text-primary hover:text-primary-dark transition-colors"
                    >
                        Quên mật khẩu?
                    </Link>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input
                        id="password"
                        type="password"
                        class="block w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl leading-5 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors sm:text-sm"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" id="remember" class="rounded text-primary focus:ring-primary h-4 w-4" />
                <label for="remember" class="ml-2 block text-sm font-medium text-gray-600 cursor-pointer select-none">
                    Ghi nhớ đăng nhập
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:-translate-y-0.5"
                    :class="{ 'opacity-70 cursor-not-allowed hover:translate-y-0': form.processing }"
                    :disabled="form.processing"
                >
                    <i class="fas fa-sign-in-alt mr-2 mt-0.5"></i> Đăng nhập
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
