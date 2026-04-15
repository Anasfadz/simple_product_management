<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <MainLayout>
        <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <!-- Header section -->
            <div class="mb-4">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Account Settings</h2>
                <p class="text-gray-500 font-medium mt-1">Manage your storefront profile, security, and administrative access.</p>
            </div>

            <div class="grid grid-cols-1 gap-8">
                <!-- Profile Information -->
                <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="max-w-xl">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                        />
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="max-w-xl">
                        <UpdatePasswordForm />
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="bg-white border border-red-50 rounded-3xl p-8 shadow-sm hover:shadow-md transition-shadow bg-gradient-to-br from-white to-red-50/30">
                    <div class="max-w-xl">
                        <DeleteUserForm />
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
