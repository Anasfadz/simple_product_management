<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-2xl border-gray-200/60 shadow-sm focus:border-orange-400 focus:ring-orange-400 focus:ring-opacity-50 bg-white/70 backdrop-blur-md px-5 py-3.5 transition-all w-full"
        v-model="model"
        ref="input"
    />
</template>
