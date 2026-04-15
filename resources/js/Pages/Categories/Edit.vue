<template>
    <MainLayout>
        <!-- Page Title & Actions -->
        <div class="flex items-center mb-8">
            <div>
                <h2 class="font-black text-2xl text-gray-900 tracking-tight">{{ $t('Edit Category') }}</h2>
                <p class="text-sm font-bold text-orange-600 mt-1 tracking-wide">{{ category.name }}</p>
            </div>
        </div>

        <div class="bg-white/60 backdrop-blur-xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] p-8 max-w-3xl relative overflow-hidden">
            <!-- Decorative blobs -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-orange-400 to-amber-600 rounded-full blur-3xl opacity-10"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-gradient-to-tr from-yellow-400 to-orange-600 rounded-full blur-3xl opacity-10"></div>

            <form @submit.prevent="submit" class="relative z-10">
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-xs font-black text-gray-900 uppercase tracking-widest mb-2 pl-1">Category Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            v-model="form.name" 
                            placeholder="e.g. Electronics"
                            class="block w-full border-gray-200 bg-gray-50/50 rounded-2xl px-5 py-3.5 text-sm font-semibold text-gray-900 focus:bg-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all shadow-inner"
                            :class="{'border-red-500 ring-red-500/10 focus:ring-red-500/10 focus:border-red-500': form.errors.name}"
                        >
                        <div v-if="form.errors.name" class="text-red-500 text-xs font-bold mt-2 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ form.errors.name }}
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end space-x-4 border-t border-gray-100 pt-6">
                    <Link :href="route('categories.index')" class="px-6 py-3 bg-white border border-gray-200 text-gray-500 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm flex items-center">
                        Cancel
                    </Link>
                    <button type="submit" :disabled="form.processing" class="px-8 py-3 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-xl font-black text-[12px] uppercase tracking-[0.15em] hover:from-orange-500 hover:to-orange-700 transition-all shadow-lg shadow-orange-500/25 disabled:opacity-50 disabled:cursor-not-allowed group flex items-center">
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span>{{ form.processing ? 'Saving...' : 'Update Category' }}</span>
                        <svg v-if="!form.processing" class="w-4 h-4 ml-2.5 group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: props.category.name,
});

const submit = () => {
    form.put(route('categories.update', props.category.id));
};
</script>
