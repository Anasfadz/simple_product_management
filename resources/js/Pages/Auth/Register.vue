<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head :title="$t('Register')" />

        <div class="mb-8 text-center">
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">{{ $t('Join StockOps') }}</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">{{ $t('Please fill in your details to get started.') }}</p>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <InputLabel for="name" :value="$t('Name')" class="ml-1 mb-1 font-semibold text-gray-700" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-1" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" :value="$t('Email')" class="ml-1 mb-1 font-semibold text-gray-700" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-1" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" :value="$t('Password')" class="ml-1 mb-1 font-semibold text-gray-700" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-1" :message="form.errors.password" />
            </div>

            <div>
                <InputLabel
                    for="password_confirmation"
                    :value="$t('Confirm Password')"
                    class="ml-1 mb-1 font-semibold text-gray-700"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-1"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-8 flex flex-col space-y-3">
                <PrimaryButton
                    class="w-full text-center"
                    :class="{ 'opacity-25 scale-95': form.processing }"
                    :disabled="form.processing"
                >
                    {{ $t('Register') }}
                </PrimaryButton>

                <p class="text-sm text-center text-gray-500 font-medium">
                    <Link
                        :href="route('login')"
                        class="text-orange-500 hover:text-orange-600 focus:outline-none focus:underline transition-colors"
                    >
                        {{ $t('Already registered?') }}
                    </Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
