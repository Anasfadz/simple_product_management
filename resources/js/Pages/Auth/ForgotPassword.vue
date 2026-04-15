<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head :title="$t('Forgot Password')" />

        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 mb-4 shadow-inner text-orange-500 text-3xl">
                🔒
            </div>
            <h2 class="text-2xl font-black text-gray-900">{{ $t('Reset Password') }}</h2>
            <p class="mb-4 mt-3 text-sm text-gray-500 font-medium">
                {{ $t('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </div>

        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600 text-center bg-green-50 p-3 rounded-xl border border-green-100"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
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

                <InputError class="mt-1" :message="form.errors.email" />
            </div>

            <div class="pt-4 flex items-center justify-center w-full">
                <PrimaryButton
                    class="w-full text-center"
                    :class="{ 'opacity-25 scale-95': form.processing }"
                    :disabled="form.processing"
                >
                    {{ $t('Email Password Reset Link') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
