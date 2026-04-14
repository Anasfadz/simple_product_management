<template>
    <MainLayout>
        <template #header>
            <div class="flex items-center">
                <Link :href="route('products.index')" class="text-indigo-600 hover:text-indigo-900 mr-2">
                    &larr; Back
                </Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Product: {{ product.name }}</h2>
            </div>
        </template>

        <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto mt-6">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        v-model="form.name" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'border-red-500': form.errors.name}"
                    >
                    <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select 
                        id="category_id" 
                        v-model="form.category_id" 
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        :class="{'border-red-500': form.errors.category_id}"
                    >
                        <option value="">Select a Category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                    <div v-if="form.errors.category_id" class="text-red-500 text-xs mt-1">{{ form.errors.category_id }}</div>
                </div>

                <div class="mb-6">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input 
                        type="number" 
                        id="quantity" 
                        v-model="form.quantity" 
                        min="1"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'border-red-500': form.errors.quantity}"
                    >
                    <div v-if="form.errors.quantity" class="text-red-500 text-xs mt-1">{{ form.errors.quantity }}</div>
                </div>

                <div class="flex justify-end space-x-3">
                    <Link :href="route('products.index')" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </Link>
                    <button type="submit" :disabled="form.processing" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50">
                        Update Product
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
    product: Object,
    categories: Array,
});

const form = useForm({
    name: props.product.name,
    category_id: props.product.category_id,
    quantity: props.product.quantity,
});

const submit = () => {
    form.put(route('products.update', props.product.id));
};
</script>
