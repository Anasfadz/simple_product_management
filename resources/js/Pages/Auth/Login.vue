<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
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
    email: '',
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
        <Head :title="$t('Log in')" />

        <div class="mb-8 text-center">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">{{ $t('Welcome Back') }}</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">{{ $t('Please enter your credentials to access your dashboard.') }}</p>
        </div>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <InputLabel for="email" :value="$t('Email')" class="ml-1 mb-1 font-semibold text-gray-700" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" :value="$t('Password')" class="ml-1 mb-1 font-semibold text-gray-700" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-between mt-2">
                <label class="flex items-center cursor-pointer">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm font-medium text-gray-600">{{ $t('Remember me') }}</span>
                </label>
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm font-medium text-orange-500 hover:text-orange-600 transition-colors focus:outline-none"
                >
                    {{ $t('Forgot password?') }}
                </Link>
            </div>

            <div class="mt-8 flex flex-col space-y-3">
                <PrimaryButton
                    class="w-full text-center"
                    :class="{ 'opacity-25 scale-95': form.processing }"
                    :disabled="form.processing"
                >
                    {{ $t('Log in') }}
                </PrimaryButton>

                <p class="text-sm text-center text-gray-500 font-medium">
                    {{ $t("Don't have an account?") }}
                    <Link
                        :href="route('register')"
                        class="text-orange-500 hover:text-orange-600 focus:outline-none focus:underline transition-colors"
                    >
                        {{ $t('Create one now') }}
                    </Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
