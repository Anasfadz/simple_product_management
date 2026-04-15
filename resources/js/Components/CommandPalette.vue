<template>
    <div v-if="isOpen" class="fixed inset-0 z-[100] overflow-y-auto p-4 sm:p-6 md:p-20" role="dialog" aria-modal="true" @keydown.esc="close">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" @click="close"></div>

        <div class="mx-auto max-w-2xl transform divide-y divide-gray-100 overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
            <div class="relative">
                <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
                <input 
                    ref="searchInput"
                    type="text" 
                    v-model="query"
                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" 
                    placeholder="Search products..."
                    @input="handleSearch"
                    @keydown.down.prevent="moveDown"
                    @keydown.up.prevent="moveUp"
                    @keydown.enter.prevent="selectResult"
                >
            </div>

            <!-- Results -->
            <ul v-if="results.length > 0" class="max-h-96 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800">
                <li v-for="(product, index) in results" :key="product.id" 
                    :class="['group flex cursor-default select-none items-center px-4 py-2.5 transition-colors', selectedIndex === index ? 'bg-orange-50 text-orange-600' : 'hover:bg-gray-50']"
                    @mouseenter="selectedIndex = index"
                    @click="goToProduct(product.id)"
                >
                    <div :class="['flex h-10 w-10 flex-none items-center justify-center rounded-lg border', selectedIndex === index ? 'bg-white border-orange-200' : 'bg-gray-50 border-gray-100']">
                        <img v-if="product.image_path || product.image_url" :src="product.image_path ? `/storage/${product.image_path}` : product.image_url" class="h-8 w-8 object-contain" />
                        <span v-else class="text-lg">📦</span>
                    </div>
                    <div class="ml-4 flex-auto">
                        <p class="font-black text-[13px]">{{ product.name }}</p>
                        <p :class="['text-[11px] font-bold', selectedIndex === index ? 'text-orange-400' : 'text-gray-400']">
                            {{ product.category?.name || 'Uncategorized' }} • RM {{ parseFloat(product.price).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>
                    <span v-if="selectedIndex === index" class="ml-3 flex-none text-[10px] font-bold text-orange-400 uppercase tracking-widest">Jump to Edit →</span>
                </li>
            </ul>

            <!-- Empty State -->
            <div v-if="query !== '' && results.length === 0 && !isLoading" class="px-6 py-14 text-center sm:px-14">
                <svg class="mx-auto h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5l-7 7m0 0l7 7m-7-7h18" />
                </svg>
                <p class="mt-4 text-sm font-bold text-gray-900 tracking-tight">No products matching your search.</p>
                <p class="mt-2 text-xs text-gray-500 font-medium">Try searching for something else or create a new product.</p>
            </div>

            <!-- Hint -->
            <div class="flex items-center justify-between bg-gray-50 px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-400">
                <div class="flex space-x-4">
                    <span class="flex items-center"><kbd class="font-sans mr-1.5 flex h-5 w-5 items-center justify-center rounded border bg-white">↓</kbd> Navigate</span>
                    <span class="flex items-center"><kbd class="font-sans mr-1.5 flex h-5 w-5 items-center justify-center rounded border bg-white">↵</kbd> Select</span>
                </div>
                <span>CMD + K</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const isOpen = ref(false);
const query = ref('');
const results = ref([]);
const selectedIndex = ref(0);
const isLoading = ref(false);
const searchInput = ref(null);

let searchTimeout = null;

const open = () => {
    isOpen.value = true;
    query.value = '';
    results.value = [];
    selectedIndex.value = 0;
    nextTick(() => {
        searchInput.value?.focus();
    });
};

const close = () => {
    isOpen.value = false;
};

const handleSearch = () => {
    if (query.value.length < 2) {
        results.value = [];
        return;
    }

    isLoading.value = true;
    clearTimeout(searchTimeout);
    
    searchTimeout = setTimeout(async () => {
        try {
            const response = await axios.get(route('api.search'), {
                params: { q: query.value }
            });
            results.value = response.data;
            selectedIndex.value = 0;
        } catch (error) {
            console.error('Quick search failed', error);
        } finally {
            isLoading.value = false;
        }
    }, 300);
};

const moveDown = () => {
    if (selectedIndex.value < results.value.length - 1) {
        selectedIndex.value++;
    }
};

const moveUp = () => {
    if (selectedIndex.value > 0) {
        selectedIndex.value--;
    }
};

const selectResult = () => {
    if (results.value[selectedIndex.value]) {
        goToProduct(results.value[selectedIndex.value].id);
    }
};

const goToProduct = (id) => {
    close();
    router.visit(route('products.edit', id));
};

const onKeyDown = (e) => {
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        if (isOpen.value) close();
        else open();
    }
};

onMounted(() => {
    window.addEventListener('keydown', onKeyDown);
});

onUnmounted(() => {
    window.removeEventListener('keydown', onKeyDown);
});
</script>
