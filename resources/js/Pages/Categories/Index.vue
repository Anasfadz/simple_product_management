<template>
    <MainLayout>
        <!-- Page Title & Actions -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-black text-2xl text-gray-900 tracking-tight">{{ $t('Categories') }}</h2>
            <Link :href="route('categories.create')" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-5 py-2.5 rounded-xl hover:from-orange-500 hover:to-orange-700 transition shadow-[0_4px_14px_0_rgba(255,100,50,0.39)] text-[13px] font-bold flex items-center group">
                <svg class="w-4 h-4 ml-[-2px] mr-1.5 group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                {{ $t('Create Category') }}
            </Link>
        </div>

        <!-- Filter Bar -->
        <div class="mb-6 flex flex-wrap gap-3 items-center text-[13px] font-bold text-gray-700">
             <div class="relative max-w-xs w-full lg:w-64">
                <input 
                    v-model="form.search" 
                    @keyup.enter="applyFilters"
                    type="text" 
                    :placeholder="$t('Search categories...')" 
                    class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 shadow-sm font-medium text-[13px]" 
                />
                <svg @click="applyFilters" class="w-4 h-4 text-gray-400 absolute left-3 top-2.5 cursor-pointer hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
             </div>
             
             <div class="relative">
                  <select v-model="form.sort" @change="applyFilters" class="appearance-none bg-white border border-gray-200 pl-4 pr-10 py-2 rounded-lg shadow-sm hover:bg-gray-50 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 font-bold text-gray-700 text-[13px] pr-10 cursor-pointer">
                    <option value="name_asc">{{ $t('Sort by Name (A-Z)') }}</option>
                    <option value="name_desc">{{ $t('Sort by Name (Z-A)') }}</option>
                    <option value="id_asc">{{ $t('Sort by ID (Lowest)') }}</option>
                    <option value="id_desc">{{ $t('Sort by ID (Highest)') }}</option>
                    <option value="created_at_desc">{{ $t('Date Created (Newest)') }}</option>
                    <option value="created_at_asc">{{ $t('Date Created (Oldest)') }}</option>
                  </select>
             </div>
             
             <div class="flex-grow"></div>

             <button @click="resetFilters" class="px-4 py-2 bg-white border border-gray-200 text-gray-500 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm flex items-center group">
                 <svg class="w-3.5 h-3.5 mr-1.5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                 {{ $t('Reset') }}
             </button>
        </div>

        <div class="bg-white/60 backdrop-blur-xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] p-6 mb-12">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 border-b border-gray-100 font-bold text-[11px] uppercase tracking-wider text-gray-400">ID</th>
                            <th class="py-4 px-6 border-b border-gray-100 font-bold text-[11px] uppercase tracking-wider text-gray-400">{{ $t('Category Name') }}</th>
                            <th class="py-4 px-6 border-b border-gray-100 font-bold text-[11px] uppercase tracking-wider text-gray-400">{{ $t('Date Added') }}</th>
                            <th class="py-4 px-6 border-b border-gray-100 font-bold text-[11px] uppercase tracking-wider text-gray-400 text-right">{{ $t('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in categories.data" :key="category.id" class="hover:bg-gray-50/50 transition-colors group">
                            <td class="py-4 px-6 border-b border-gray-50 text-sm font-semibold text-gray-500">
                                #{{ category.id }}
                            </td>
                            <td class="py-4 px-6 border-b border-gray-50">
                                <span class="text-[13px] font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ category.name }}</span>
                            </td>
                            <td class="py-4 px-6 border-b border-gray-50 text-[13px] text-gray-500 font-medium">
                                {{ new Date(category.created_at).toLocaleDateString('en-GB') }}
                            </td>
                             <td class="py-4 px-6 border-b border-gray-50 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <Link :href="route('categories.edit', category.id)" class="px-4 py-1.5 bg-gradient-to-r from-orange-400 to-orange-600 text-white rounded-lg text-[10px] font-black uppercase tracking-widest hover:from-orange-500 hover:to-orange-700 transition-all shadow-sm shadow-orange-500/20 flex items-center">
                                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        {{ $t('Edit') }}
                                    </Link>
                                    <button @click="deleteCategory(category.id)" class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100/50 flex items-center group">
                                        <svg class="w-3 h-3 mr-1.5 text-red-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        {{ $t('Delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="categories.data.length === 0">
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                                    <p class="text-sm font-bold">{{ $t('No categories found.') }}</p>
                                    <p class="text-xs mt-1">{{ $t('Get started by creating a new category.') }}</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Component -->
            <div class="mt-6 flex justify-center" v-if="categories.links && categories.links.length > 3">
                <nav class="flex items-center space-x-1">
                    <template v-for="(link, p) in categories.links" :key="p">
                        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-2 text-sm leading-4 text-gray-400 border border-gray-100 rounded-lg bg-gray-50/50 opacity-60" v-html="link.label" />
                        <Link v-else :class="['mr-1 mb-1 px-4 py-2 text-sm leading-4 border rounded-lg hover:bg-orange-50 hover:text-orange-600 hover:border-orange-200 focus:border-orange-500 focus:text-orange-500 font-bold transition-colors', link.active ? 'bg-orange-500 text-white border-orange-500 hover:bg-orange-600 hover:text-white hover:border-orange-600 shadow-[0_2px_8px_rgb(255,100,50,0.4)]' : 'bg-white text-gray-700 border-gray-200']" :href="link.url" v-html="link.label" />
                    </template>
                </nav>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    categories: Object,
    filters: Object,
});

const form = ref({
    search: props.filters.search || '',
    sort: props.filters.sort_by ? `${props.filters.sort_by}_${props.filters.sort_dir}` : 'name_asc',
});

const applyFilters = () => {
    let parts = form.value.sort;
    let sort_by = 'name';
    let sort_dir = 'asc';
    
    if (parts === 'name_asc') { sort_by = 'name'; sort_dir = 'asc'; }
    if (parts === 'name_desc') { sort_by = 'name'; sort_dir = 'desc'; }
    if (parts === 'id_asc') { sort_by = 'id'; sort_dir = 'asc'; }
    if (parts === 'id_desc') { sort_by = 'id'; sort_dir = 'desc'; }
    if (parts === 'created_at_desc') { sort_by = 'created_at'; sort_dir = 'desc'; }
    if (parts === 'created_at_asc') { sort_by = 'created_at'; sort_dir = 'asc'; }

    router.get(route('categories.index'), {
        search: form.value.search,
        sort_by: sort_by,
        sort_dir: sort_dir,
    }, {
        preserveState: true,
        replace: true,
    });
};

const resetFilters = () => {
    form.value.search = '';
    form.value.sort = 'name_asc';
    applyFilters();
};

const deleteCategory = (id) => {
    if(confirm($t('Are you sure you want to delete this category?'))) {
        router.delete(route('categories.destroy', id), {
            preserveScroll: true
        });
    }
};
</script>
