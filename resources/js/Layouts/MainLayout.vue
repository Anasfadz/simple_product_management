<template>
    <div class="h-screen bg-white overflow-hidden flex w-full">
        <!-- Main App Container directly filling the screen -->
        <div class="flex-1 overflow-hidden flex relative w-full h-full">
            
            <!-- Unified Animated Sidebar -->
            <aside 
                :class="[
                    isSidebarOpen ? 'w-64 lg:w-72' : 'w-20',
                    isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'
                ]"
                class="bg-[#fdfdfd] border-r border-gray-100 flex flex-col fixed md:relative z-40 shrink-0 h-full transition-all duration-300 ease-in-out shadow-2xl md:shadow-none">
                
                <!-- Branding Header -->
                <div class="h-[72px] flex items-center border-b border-gray-50/50 justify-center shrink-0" :class="isSidebarOpen ? 'px-6 justify-between' : 'px-0 justify-center'">
                    <Link href="/" class="flex items-center" :class="isSidebarOpen ? 'space-x-2.5' : 'space-x-0'">
                        <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-600 block transition-transform group-hover:scale-105 drop-shadow-sm shrink-0">✦</span>
                        <span :class="{'w-0 opacity-0': !isSidebarOpen, 'w-auto opacity-100': isSidebarOpen}" class="text-lg font-black text-gray-900 tracking-tight transition-all duration-300 overflow-hidden whitespace-nowrap">StockOps</span>
                    </Link>
                </div>
                
                <!-- Main Create Action -->
                <!-- <div class="py-5" :class="isSidebarOpen ? 'px-6' : 'px-4'">
                    <Link :href="route('products.create')" class="w-full h-11 rounded-xl bg-orange-500 text-white flex items-center justify-center font-bold text-sm shadow-lg shadow-orange-500/30 hover:bg-orange-600 transition-all hover:-translate-y-0.5 group">
                        <svg class="w-4 h-4 shrink-0 transition-transform duration-300" :class="isSidebarOpen ? 'mr-2 group-hover:rotate-90' : 'group-hover:rotate-90'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        <span :class="{'w-0 opacity-0': !isSidebarOpen, 'w-auto opacity-100': isSidebarOpen}" class="transition-all duration-300 overflow-hidden whitespace-nowrap">Add Product</span>
                    </Link>
                </div> -->

                <!-- Navigation List -->
                <div class="pb-2 text-[11px] font-black text-gray-400 uppercase tracking-widest flex items-center" :class="isSidebarOpen ? 'px-6 justify-between' : 'px-0 justify-center'">
                    <span :class="{'w-0 opacity-0': !isSidebarOpen, 'w-auto opacity-100': isSidebarOpen}" class="transition-all duration-300 overflow-hidden whitespace-nowrap">{{ $t('Menu') }}</span>
                    <svg @click="isSidebarOpen = !isSidebarOpen" class="w-4 h-4 cursor-pointer hover:text-gray-900 transition-colors shrink-0" :class="isSidebarOpen ? '' : 'mx-auto'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </div>
                
                <nav class="flex-1 flex flex-col space-y-2 overflow-y-auto" :class="isSidebarOpen ? 'px-4' : 'px-3'">
                    <Link :href="route('dashboard')" class="flex items-center py-2.5 rounded-xl text-[13px] font-bold transition-colors w-full text-left overflow-hidden" :class="[route().current('dashboard') ? 'bg-orange-50 text-orange-600 shadow-sm border border-orange-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900', isSidebarOpen ? 'px-4' : 'px-0 justify-center h-11']">
                        <svg class="w-4 h-4 shrink-0" :class="[route().current('dashboard') ? 'text-orange-500' : 'text-gray-400', isSidebarOpen ? 'mr-3' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span :class="{'w-0 opacity-0': !isSidebarOpen, 'w-auto opacity-100': isSidebarOpen}" class="transition-all duration-300 whitespace-nowrap">{{ $t('Dashboard') }}</span>
                    </Link>
                    
                    <div class="space-y-1 w-full">
                        <Link :href="route('products.index')" class="flex items-center py-2.5 rounded-xl text-[13px] font-bold transition-colors w-full text-left overflow-hidden" :class="[route().current('products.index') || route().current('products.create') || route().current('products.edit') ? 'bg-orange-50 text-orange-600 shadow-sm border border-orange-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900', isSidebarOpen ? 'px-4' : 'px-0 justify-center h-11']">
                            <svg class="w-4 h-4 shrink-0" :class="[route().current('products.index') || route().current('products.create') || route().current('products.edit') ? 'text-orange-500' : 'text-gray-400', isSidebarOpen ? 'mr-3' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            <span :class="{'w-0 opacity-0': !isSidebarOpen, 'w-auto opacity-100': isSidebarOpen}" class="transition-all duration-300 whitespace-nowrap">{{ $t('Products') }}</span>
                        </Link>
                        <!-- Child Tab: Add Product (Only visible when open) -->
                        <Link v-if="isSidebarOpen" :href="route('products.create')" class="flex items-center py-2 rounded-xl text-xs font-bold transition-colors w-full text-left overflow-hidden" :class="[route().current('products.create') ? 'text-orange-600' : 'text-gray-400 hover:text-gray-900 hover:bg-gray-50', 'pl-[2.8rem] pr-4']">
                            <span class="w-1.5 h-1.5 shrink-0 rounded-full mr-2" :class="route().current('products.create') ? 'bg-orange-500' : 'bg-gray-300'"></span>
                            <span class="whitespace-nowrap opacity-100">{{ $t('Add Product') }}</span>
                        </Link>
                    </div>

                    <div class="space-y-1 w-full" :class="{'mt-1': isSidebarOpen}">
                        <Link :href="route('categories.index')" class="flex items-center py-2.5 rounded-xl text-[13px] font-bold transition-colors w-full text-left overflow-hidden" :class="[route().current('categories.index') || route().current('categories.create') || route().current('categories.edit') ? 'bg-orange-50 text-orange-600 shadow-sm border border-orange-100' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900', isSidebarOpen ? 'px-4' : 'px-0 justify-center h-11']">
                            <svg class="w-4 h-4 shrink-0" :class="[route().current('categories.index') || route().current('categories.create') || route().current('categories.edit') ? 'text-orange-500' : 'text-gray-400', isSidebarOpen ? 'mr-3' : '']" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10v10H7zM7 3h10M3 7v10M21 7v10M7 21h10"></path></svg>
                            <span :class="{'w-0 opacity-0': !isSidebarOpen, 'w-auto opacity-100': isSidebarOpen}" class="transition-all duration-300 whitespace-nowrap">{{ $t('Categories') }}</span>
                        </Link>
                        <!-- Child Tab: Add Category (Only visible when open) -->
                        <Link v-if="isSidebarOpen" :href="route('categories.create')" class="flex items-center py-2 rounded-xl text-xs font-bold transition-colors w-full text-left overflow-hidden" :class="[route().current('categories.create') ? 'text-orange-600' : 'text-gray-400 hover:text-gray-900 hover:bg-gray-50', 'pl-[2.8rem] pr-4']">
                            <span class="w-1.5 h-1.5 shrink-0 rounded-full mr-2" :class="route().current('categories.create') ? 'bg-orange-500' : 'bg-gray-300'"></span>
                            <span class="whitespace-nowrap opacity-100">{{ $t('Add Category') }}</span>
                        </Link>
                    </div>
                
                </nav>
                
                <!-- Sidebar Footer: User Settings -->
                <div class="mt-auto border-t border-gray-200/50 bg-gray-50/30" :class="isSidebarOpen ? 'p-4' : 'p-3'">
                    <Dropdown align="top" width="64" class="w-full">
                        <template #trigger>
                            <button class="w-full flex items-center p-2 rounded-xl hover:bg-orange-50 transition-all group overflow-hidden focus:outline-none">
                                <div class="w-9 h-9 rounded-lg bg-orange-500 text-white flex items-center justify-center font-black text-[11px] shrink-0 shadow-lg shadow-orange-500/20 group-hover:scale-105 transition-transform">
                                    {{ $page.props.auth.user.name.substring(0, 2).toUpperCase() }}
                                </div>
                                <div :class="{'w-0 opacity-0 ml-0': !isSidebarOpen, 'w-auto opacity-100 ml-3': isSidebarOpen}" class="flex items-center flex-1 transition-all duration-300 overflow-hidden whitespace-nowrap">
                                    <div class="flex flex-col text-left">
                                        <span class="text-[13px] font-black text-gray-900 leading-tight uppercase tracking-tight">{{ $page.props.auth.user.name }}</span>
                                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ $t('Store Admin') }}</span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-300 ml-auto group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                                </div>
                            </button>
                        </template>
                        <template #content>
                            <div class="px-4 py-2.5 border-b border-gray-100">
                                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest leading-none">{{ $t('Account') }}</p>
                                <p class="text-xs text-gray-900 font-bold mt-1 truncate">{{ $page.props.auth.user.email }}</p>
                            </div>
                            <div class="p-1">
                                <DropdownLink :href="route('profile.edit')" class="flex items-center rounded-lg px-3 py-2 text-[12px] font-bold text-gray-600 hover:text-orange-600 hover:bg-orange-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $t('Profile Settings') }}
                                </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button" class="w-full flex items-center rounded-lg px-3 py-2 text-[12px] font-bold text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    {{ $t('Log Out') }}
                                </DropdownLink>
                            </div>
                        </template>
                    </Dropdown>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 bg-[#ffffff] relative z-0 transition-all duration-300">
                <!-- Top Header -->
                <header class="h-[72px] border-b border-gray-100 flex items-center justify-between px-4 md:px-8 bg-[#ffffff] shrink-0 sticky top-0 z-30">
                    <div class="flex items-center">
                        <div class="flex items-center text-[13px] font-bold text-gray-900 group">
                            <template v-for="(crumb, index) in breadcrumbs" :key="index">
                                <svg v-if="index > 0" class="w-2.5 h-2.5 text-gray-300 mx-2 md:mx-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                <div class="flex items-center" :class="index === 0 ? 'hidden sm:flex' : 'flex'">
                                    <Link v-if="crumb.route" :href="crumb.route" class="text-gray-400 font-medium hover:text-gray-900 transition-colors whitespace-nowrap">{{ $t(crumb.label) }}</Link>
                                    <span v-else :class="crumb.active ? 'text-gray-900 font-black tracking-tight' : 'text-gray-400 font-medium'" class="whitespace-nowrap">{{ $t(crumb.label) }}</span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Search Input (Desktop only) -->
                    <div @click="$refs.commandPalette.open()" class="hidden md:flex max-w-md w-full mx-auto relative group pl-10 pr-10 cursor-pointer">
                        <div class="absolute inset-y-0 left-10 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div class="block w-full pl-10 pr-3 py-2 text-[13px] border border-gray-100 rounded-full bg-gray-50 text-gray-400 group-hover:bg-white group-hover:ring-2 group-hover:ring-orange-500/20 group-hover:border-orange-500 transition-all font-medium flex items-center justify-between">
                            <span>{{ $t("Press '⌘+K' for quick product search") }}</span>
                            <kbd class="hidden sm:inline-flex items-center text-[10px] font-black text-gray-400 bg-white border border-gray-200 px-1.5 py-0.5 rounded-md shadow-sm">⌘K</kbd>
                        </div>
                    </div>

                    <!-- Language Switcher & Post Search (Mobile) -->
                    <div class="flex items-center space-x-2">
                        <!-- Mobile Search Trigger -->
                        <button @click="$refs.commandPalette.open()" class="md:hidden p-2 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>

                        <div class="flex items-center bg-gray-50/50 p-1 rounded-xl border border-gray-100 shrink-0">
                            <button 
                                @click="setLanguage('en')"
                                :class="getActiveLanguage() === 'en' ? 'bg-white text-orange-600 shadow-sm ring-1 ring-black/5' : 'text-gray-400 hover:text-gray-600'"
                                class="px-2 md:px-3 py-1.5 rounded-lg text-[9px] md:text-[10px] font-black uppercase tracking-widest transition-all duration-200"
                            >
                                EN
                            </button>
                            <button 
                                @click="setLanguage('my')"
                                :class="getActiveLanguage() === 'my' ? 'bg-white text-orange-600 shadow-sm ring-1 ring-black/5' : 'text-gray-400 hover:text-gray-600'"
                                class="px-2 md:px-3 py-1.5 rounded-lg text-[9px] md:text-[10px] font-black uppercase tracking-widest transition-all duration-200"
                            >
                                MY
                            </button>
                        </div>
                    </div>
                </header>

                <!-- Mobile Overlay Backdrop -->
                <div v-if="isMobileMenuOpen" @click="isMobileMenuOpen = false" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-30 md:hidden transition-opacity"></div>

                <main class="flex-1 overflow-y-auto bg-white p-6 sm:p-8 lg:px-12 relative w-full">
                    <div v-if="$page.props.flash.success" class="mb-6 bg-green-50 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold flex items-center shadow-sm shadow-green-100">
                        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $page.props.flash.success }}
                    </div>

                    <!-- Page content injection slot -->
                    <slot />
                </main>

                <!-- Sticky Sidebar Footer -->
                <footer class="h-16 border-t border-gray-50 bg-white/80 backdrop-blur-md px-8 lg:px-12 flex flex-col md:flex-row items-center justify-between shrink-0 z-10">
                    <div class="flex items-center space-x-3">
                        <span class="text-sm font-black text-orange-500 opacity-20">✦</span>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ $t('© 2026 StockOps. All Rights Reserved.') }}</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <span class="w-1 h-1 rounded-full bg-green-500 animate-pulse"></span>
                            <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">{{ $t('System Operational') }}</span>
                        </div>
                        <span class="px-2.5 py-0.5 bg-gray-50 text-gray-400 text-[8px] font-black uppercase tracking-widest rounded-full border border-gray-100">v1.1.0-stable</span>
                    </div>
                </footer>
            </div>
        </div>
        <CommandPalette ref="commandPalette" />

        <!-- Floating Mobile Menu Button -->
        <button 
            @click="isMobileMenuOpen = !isMobileMenuOpen" 
            class="md:hidden fixed bottom-6 right-6 z-50 w-14 h-14 bg-orange-500 text-white rounded-full shadow-[0_8px_30px_rgba(249,115,22,0.4)] flex items-center justify-center hover:bg-orange-600 active:scale-95 transition-all outline-none border-none animate-bounce-subtle"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</template>

<style>
@keyframes bounce-subtle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}
.animate-bounce-subtle {
    animation: bounce-subtle 3s infinite ease-in-out;
}
</style>

<script setup>
import { ref, computed, watch } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import CommandPalette from '@/Components/CommandPalette.vue';
import { loadLanguageAsync, getActiveLanguage } from 'laravel-vue-i18n';

const isSidebarOpen = ref(true);
const isMobileMenuOpen = ref(false);
const commandPalette = ref(null);
const page = usePage();

const setLanguage = (lang) => {
    loadLanguageAsync(lang);
};

// Premium Toast Configuration
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

watch(() => page.props.flash.alert, (message) => {
    if (message) {
        Swal.fire({
            title: $t('Information'),
            text: message,
            icon: 'info',
            confirmButtonText: $t('Got it'),
            confirmButtonColor: '#f97316',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-[1.5rem] shadow-2xl border border-gray-100',
                confirmButton: 'rounded-xl font-bold px-8 py-3 text-[12px] uppercase tracking-widest'
            }
        });
    }
}, { immediate: true });

watch(() => page.props.flash.success, (message) => {
    if (message) {
        Toast.fire({
            icon: 'success',
            title: message,
            background: '#ffffff',
            color: '#111827',
        });
    }
}, { immediate: true });

// Auto-close mobile menu on route change
watch(() => page.url, () => {
    isMobileMenuOpen.value = false;
});

const breadcrumbs = computed(() => {
    const crumbs = [{ label: 'StockOps Store', route: null, active: false }];
    
    if (route().current('dashboard')) {
        crumbs.push({ label: 'Dashboard', route: null, active: true });
    } else if (route().current('products.*')) {
        const isIndex = route().current('products.index');
        crumbs.push({ label: 'Products', route: isIndex ? null : route('products.index'), active: isIndex });
        if (route().current('products.create')) crumbs.push({ label: 'Create', route: null, active: true });
        if (route().current('products.edit')) crumbs.push({ label: 'Edit', route: null, active: true });
    } else if (route().current('categories.*')) {
        const isIndex = route().current('categories.index');
        crumbs.push({ label: 'Categories', route: isIndex ? null : route('categories.index'), active: isIndex });
        if (route().current('categories.create')) crumbs.push({ label: 'Create', route: null, active: true });
        if (route().current('categories.edit')) crumbs.push({ label: 'Edit', route: null, active: true });
    } else if (route().current('profile.*')) {
        crumbs.push({ label: 'Profile Settings', route: null, active: true });
    }
    
    return crumbs;
});
</script>
