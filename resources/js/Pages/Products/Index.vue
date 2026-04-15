<template>
    <MainLayout>
        <!-- Page Title & Actions -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-black text-2xl text-gray-900 tracking-tight">{{ $t('Products') }}</h2>
            <div class="flex space-x-3">
                <Link :href="route('products.create')" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-5 py-2.5 rounded-xl hover:from-orange-500 hover:to-orange-700 transition shadow-[0_4px_14px_0_rgba(255,100,50,0.39)] text-[13px] font-bold flex items-center group">
                    <svg class="w-4 h-4 ml-[-2px] mr-1.5 group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Create Product
                </Link>
            </div>
        </div>

        <!-- Filter Bar like in the mock -->
        <div class="mb-6 flex flex-wrap gap-3 items-center text-[13px] font-bold text-gray-700">
             <div class="relative max-w-xs w-full lg:w-64">
                <input 
                    v-model="form.search" 
                    @keyup.enter="applyFilters"
                    type="text" 
                    placeholder="Search Products..." 
                    class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 shadow-sm font-medium text-[13px]" 
                />
                <svg @click="applyFilters" class="w-4 h-4 text-gray-400 absolute left-3 top-2.5 cursor-pointer hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
             </div>
             
             <div class="relative">
                 <select v-model="form.sort" @change="applyFilters" class="appearance-none bg-white border border-gray-200 pl-4 pr-10 py-2 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 font-bold text-gray-700 text-[13px] pr-10 cursor-pointer">
                    <option value="name_asc">Sort by Name (A-Z)</option>
                    <option value="name_desc">Sort by Name (Z-A)</option>
                    <option value="id_asc">Sort by ID (Lowest)</option>
                    <option value="id_desc">Sort by ID (Highest)</option>
                    <option value="created_at_desc">Date Created (Newest)</option>
                    <option value="created_at_asc">Date Created (Oldest)</option>
                 </select>
             </div>
             
             <div class="relative">
                 <select v-model="form.category_id" @change="applyFilters" class="appearance-none bg-white border border-gray-200 pl-4 pr-10 py-2 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 font-bold text-gray-700 text-[13px] cursor-pointer">
                    <option value="">{{ $t('All Categories') }}</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                 </select>
             </div>

             <div class="flex-grow"></div>

             <button @click="resetFilters" class="px-4 py-2 bg-white border border-gray-200 text-gray-500 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm flex items-center group">
                 <svg class="w-3.5 h-3.5 mr-1.5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                 Reset
             </button>
             
        </div>

        <!-- Product Cards Grid Layout matching UI Dashboard.webp -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 pb-20">
            <div v-for="product in products.data" :key="product.id" class="bg-white border border-gray-200/80 rounded-[1.25rem] overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 group hover:-translate-y-1 relative flex flex-col">
                <!-- Product Image Area -->
                <div class="h-48 w-full bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-6 relative overflow-hidden group-hover:bg-gray-100/50 transition-colors duration-500 border-b border-gray-50">
                    <img v-if="product.image_path || product.image_url" :src="product.image_path ? `/storage/${product.image_path}` : product.image_url" :alt="product.name" class="w-full h-full object-cover drop-shadow-xl scale-100 group-hover:scale-105 transition-transform duration-500" />
                    <img v-else :src="`https://ui-avatars.com/api/?name=${product.name}&background=random&color=fff&size=200&font-size=0.3&rounded=true`" :alt="product.name" class="w-32 h-32 object-contain drop-shadow-xl rounded-full scale-100 group-hover:scale-105 transition-transform duration-500" />
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    
                    <!-- Title -->
                    <h3 class="font-black text-gray-900 text-sm leading-snug mb-4 line-clamp-2" :title="product.name">{{ product.name }}</h3>
                    
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">Unit Price</p>
                            <p class="font-bold text-[13px] text-gray-900">RM {{ new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(product.price) }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">In Stock</p>
                            <p class="font-bold text-[13px] text-gray-900">{{ product.quantity }} <span class="text-gray-500 font-medium lowercase">units</span></p>
                        </div>
                    </div>

                    <!-- Estimated Worth -->
                    <div class="mb-5 p-3.5 bg-orange-50/50 rounded-2xl border border-orange-100/30">
                        <p class="text-[10px] uppercase font-bold text-orange-500 tracking-widest mb-1.5 flex items-center">
                            <span class="mr-1.5">💰</span>
                            Estimated Worth
                        </p>
                        <p class="font-black text-lg text-orange-600 tracking-tight">
                            RM {{ new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(product.price * product.quantity) }}
                        </p>
                    </div>
                    
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-1.5 mb-5 mt-auto">
                        <span class="bg-gray-50 text-gray-500 text-[10px] font-bold px-2.5 py-1 rounded border border-gray-100 uppercase tracking-wide">{{ product.category?.name || 'Item' }}</span>
                    </div>
                    
                    <!-- Bottom Actions (Matches "Import Product") -->
                    <div class="flex items-stretch gap-2 mt-auto">
                        <Link :href="route('products.edit', product.id)" class="flex-1 px-4 py-2 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-lg text-[10px] font-black uppercase tracking-widest hover:from-orange-500 hover:to-orange-700 transition-all shadow-sm shadow-orange-500/20 text-center flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit
                        </Link>
                        <button @click="deleteProduct(product.id)" class="flex-1 px-4 py-2 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100/50 flex items-center justify-center group">
                            <svg class="w-3.5 h-3.5 mr-2 text-red-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Empty State -->
            <div v-if="products.data.length === 0" class="col-span-full py-20 flex flex-col items-center justify-center border-2 border-dashed border-gray-200 rounded-[2rem] bg-gray-50/50">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm mb-4">
                    <span class="text-3xl text-gray-300">📦</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">No products found</h3>
                <p class="text-sm text-gray-500 mb-6 font-medium">Create your first product to see it populate here!</p>
                <Link :href="route('products.create')" class="bg-gray-900 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-gray-200 hover:bg-orange-500 hover:shadow-orange-500/30 transition-all hover:-translate-y-0.5">
                    Create Product
                </Link>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-between items-center bg-white p-4 rounded-2xl border border-gray-100 shadow-sm" v-if="products.links && products.data.length > 0">
            <div class="text-[13px] font-bold text-gray-400">
                Showing <span class="text-gray-900">{{ products.from }}</span> to <span class="text-gray-900">{{ products.to }}</span> of <span class="text-gray-900">{{ products.total }}</span> entries
            </div>
            <div class="flex items-center space-x-1.5">
                <template v-for="(link, i) in products.links" :key="i">
                    <!-- Previous/Next arrows using text HTML decode -->
                    <Link 
                        v-if="link.url"
                        :href="link.url"
                        v-html="link.label"
                        class="min-w-[2rem] px-2 py-1.5 border rounded-lg text-xs font-bold flex items-center justify-center transition-colors"
                        :class="[link.active ? 'bg-orange-50 border-orange-500 text-orange-600' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900']"
                    />
                    <span v-else v-html="link.label" class="min-w-[2rem] px-2 py-1.5 border rounded-lg text-xs font-bold bg-gray-50 border-gray-100 text-gray-400 flex items-center justify-center"></span>
                </template>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    products: Object,
    categories: Array,
    filters: Object,
});

const form = reactive({
    search: props.filters.search || '',
    category_id: props.filters.category_id || '',
    sort: props.filters.sort_by ? `${props.filters.sort_by}_${props.filters.sort_dir}` : 'name_asc',
});

const applyFilters = () => {
    let parts = form.sort;
    let sort_by = 'name';
    let sort_dir = 'asc';
    
    if (parts === 'name_asc') { sort_by = 'name'; sort_dir = 'asc'; }
    if (parts === 'name_desc') { sort_by = 'name'; sort_dir = 'desc'; }
    if (parts === 'id_asc') { sort_by = 'id'; sort_dir = 'asc'; }
    if (parts === 'id_desc') { sort_by = 'id'; sort_dir = 'desc'; }
    if (parts === 'created_at_desc') { sort_by = 'created_at'; sort_dir = 'desc'; }
    if (parts === 'created_at_asc') { sort_by = 'created_at'; sort_dir = 'asc'; }

    router.get(route('products.index'), {
        search: form.search,
        category_id: form.category_id,
        sort_by: sort_by,
        sort_dir: sort_dir,
    }, { preserveState: true, preserveScroll: true });
};

const resetFilters = () => {
    form.search = '';
    form.category_id = '';
    form.sort = 'name_asc';
    applyFilters();
};

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        router.delete(route('products.destroy', id), {
            preserveScroll: true
        });
    }
};
</script>
