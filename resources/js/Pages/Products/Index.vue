<template>
    <MainLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
                <Link :href="route('products.create')" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                    Create Product
                </Link>
            </div>
        </template>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-4 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="w-full md:w-1/3 mb-4 md:mb-0">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Category</label>
                    <select 
                        v-model="form.category_id" 
                        @change="applyFilters"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    >
                        <option value="">All Categories</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('name')">
                                Name
                                <span v-if="form.sort_by === 'name'">
                                    {{ form.sort_dir === 'asc' ? '↑' : '↓' }}
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('quantity')">
                                Quantity
                                <span v-if="form.sort_by === 'quantity'">
                                    {{ form.sort_dir === 'asc' ? '↑' : '↓' }}
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="product in products.data" :key="product.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ product.category?.name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ product.quantity }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link :href="route('products.edit', product.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</Link>
                                <button @click="deleteProduct(product.id)" class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                        <tr v-if="products.data.length === 0">
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500 text-sm">
                                No products found. Create one to get started!
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center" v-if="products.links && products.data.length > 0">
                <div class="text-sm text-gray-700">
                    Showing {{ products.from }} to {{ products.to }} of {{ products.total }} results
                </div>
                <div class="flex items-center space-x-1">
                    <template v-for="(link, i) in products.links" :key="i">
                        <Link 
                            v-if="link.url"
                            :href="link.url"
                            v-html="link.label"
                            class="px-3 py-1 border rounded-md text-sm"
                            :class="[link.active ? 'bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50']"
                        />
                        <span v-else v-html="link.label" class="px-3 py-1 border rounded-md text-sm bg-white border-gray-300 text-gray-400 cursor-not-allowed"></span>
                    </template>
                </div>
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
    category_id: props.filters.category_id || '',
    sort_by: props.filters.sort_by || 'name',
    sort_dir: props.filters.sort_dir || 'asc',
});

const applyFilters = () => {
    router.get(route('products.index'), {
        category_id: form.category_id,
        sort_by: form.sort_by,
        sort_dir: form.sort_dir,
    }, { preserveState: true, preserveScroll: true });
};

const sortBy = (column) => {
    if (form.sort_by === column) {
        form.sort_dir = form.sort_dir === 'asc' ? 'desc' : 'asc';
    } else {
        form.sort_by = column;
        form.sort_dir = 'asc';
    }
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
