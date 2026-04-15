<template>
    <MainLayout>
        <Head title="Dashboard" />

        <!-- Welcome Banner -->
        <div class="mb-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-3xl p-8 lg:p-10 text-white relative overflow-hidden shadow-xl shadow-orange-500/20">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h2 class="text-3xl font-black mb-2 tracking-tight">
                        {{ $t('Hello') }}, {{ $page.props.auth.user.name }}! 👋
                    </h2>
                    <p class="text-white/80 font-medium max-w-lg leading-relaxed text-sm">
                        {{ $t("Welcome back to StockOps. Here's what's happening with your inventory and products today.") }}
                    </p>
                </div>
                <div class="mt-6 md:mt-0 flex space-x-3">
                    <Link :href="route('products.create')" class="bg-white text-orange-600 px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center group">
                        <svg class="w-4 h-4 mr-2 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        {{ $t('New Product') }}
                    </Link>
                </div>
            </div>
            <!-- Background Decorations -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 right-[20%] w-32 h-32 bg-purple-500/20 rounded-full blur-2xl translate-y-1/2"></div>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <span class="text-6xl">📦</span>
                </div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">{{ $t('Total Products') }}</h3>
                <p class="text-3xl font-black text-gray-900 mb-4">{{ stats.total_products }}</p>
                <div class="flex items-center text-xs font-bold">
                    <span class="text-green-500 bg-green-50 px-2 py-1 rounded flex items-center mr-2">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        +0%
                    </span>
                    <span class="text-gray-400">{{ $t('vs yesterday') }}</span>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <span class="text-6xl">💸</span>
                </div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">{{ $t('Inventory Value') }}</h3>
                <p class="text-3xl font-black text-gray-900 mb-4"><span class="text-gray-300 text-2xl mr-1">RM</span>{{ new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(stats.total_value) }}</p>
                <div class="flex items-center text-xs font-bold">
                    <span class="text-green-500 bg-green-50 px-2 py-1 rounded flex items-center mr-2">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        +0.0%
                    </span>
                    <span class="text-gray-400">{{ $t('tracked live') }}</span>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-6 opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <span class="text-6xl">⚠️</span>
                </div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">{{ $t('Low Stock Alerts') }}</h3>
                <p class="text-3xl font-black text-red-500 mb-4">{{ stats.low_stock_count }}</p>
                <div class="flex items-center text-xs font-bold">
                    <span class="text-red-500 bg-red-50 px-2 py-1 rounded flex items-center mr-2">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        {{ $t('Limit < 5') }}
                    </span>
                    <span class="text-gray-400">{{ $t('requires attention') }}</span>
                </div>
            </div>
        </div>

        <!-- Top Products Chart -->
        <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm mb-12">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-lg font-black text-gray-900 tracking-tight">{{ $t('Top 10 High-Value Products') }}</h3>
                    <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-widest">{{ $t('Cumulative Inventory Value (Price × Stock)') }}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-3 h-3 bg-orange-500 rounded-full"></span>
                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">{{ $t('Total Value (RM)') }}</span>
                </div>
            </div>
            
            <div class="h-[400px] w-full relative">
                <Bar 
                    :data="chartData" 
                    :options="chartOptions" 
                />
            </div>
        </div>

    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Bar } from 'vue-chartjs';
import { 
    Chart as ChartJS, 
    Title, 
    Tooltip, 
    Legend, 
    BarElement, 
    CategoryScale, 
    LinearScale 
} from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const props = defineProps({
    stats: Object,
    topProducts: Array,
});

const chartData = computed(() => ({
    labels: props.topProducts.map(p => p.name.length > 20 ? p.name.substring(0, 17) + '...' : p.name),
    datasets: [
        {
            label: 'Total Value',
            backgroundColor: '#f97316', // orange-500
            borderRadius: 12,
            maxBarThickness: 45,
            data: props.topProducts.map(p => p.total_value),
        },
    ],
}));

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: false,
        },
        tooltip: {
            backgroundColor: '#1e1b4b',
            titleFont: { size: 13, weight: 'bold', family: 'Inter' },
            bodyFont: { size: 12, family: 'Inter' },
            padding: 12,
            cornerRadius: 12,
            displayColors: false,
            callbacks: {
                label: function(context) {
                    let label = context.dataset.label || '';
                    if (label) {
                        label += ': ';
                    }
                    if (context.parsed.y !== null) {
                        label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'MYR' }).format(context.parsed.y);
                    }
                    return label;
                }
            }
        }
    },
    scales: {
        x: {
            grid: {
                display: false,
                drawBorder: false,
            },
            ticks: {
                font: { size: 11, weight: 'bold', family: 'Inter' },
                color: '#94a3b8',
            }
        },
        y: {
            grid: {
                color: '#f1f5f9',
                drawBorder: false,
            },
            ticks: {
                font: { size: 10, weight: 'bold', family: 'Inter' },
                color: '#94a3b8',
                callback: function(value) {
                    return 'RM ' + value.toLocaleString();
                }
            }
        }
    }
};
</script>
