<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen bg-[#faf8f6] font-sans selection:bg-orange-500 selection:text-white flex flex-col justify-center items-center relative overflow-hidden">
    
    <!-- Top Right Language Switcher -->
    <div class="absolute top-6 right-6 lg:top-8 lg:right-10 z-50 flex items-center bg-white/80 backdrop-blur-md rounded-full p-1 border border-white shadow-xl shadow-gray-200/50 hover:shadow-orange-200 transition-shadow">
        <a :href="route('language.switch', 'en')" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all" :class="$page.props.locale === 'en' ? 'bg-orange-500 text-white shadow-md' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50'">EN</a>
        <a :href="route('language.switch', 'my')" class="px-3 py-1.5 text-xs font-bold rounded-full transition-all" :class="$page.props.locale === 'my' ? 'bg-orange-500 text-white shadow-md' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50'">MY</a>
    </div>

    <!-- Animated Background Blobs -->
    <div class="absolute inset-0 pointer-events-none w-full h-full overflow-hidden flex justify-center items-center z-0">
      <div class="absolute top-1/4 -left-10 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-[blob_7s_infinite]"></div>
      <div class="absolute top-1/4 right-0 w-96 h-96 bg-orange-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-[blob_7s_infinite] animation-delay-[2000ms]"></div>
      <div class="absolute -bottom-20 left-1/3 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-[blob_7s_infinite] animation-delay-[4000ms]"></div>
    </div>

    <!-- Floating Background Elements -->
    <div class="absolute left-[15%] top-[25%] animate-[float_4s_ease-in-out_infinite] hidden lg:block opacity-80 z-0">
        <span class="text-5xl shadow-2xl shadow-orange-500/20 rounded-full bg-white/70 backdrop-blur-md p-4 border border-white">📦</span>
    </div>
    <div class="absolute right-[15%] bottom-[20%] animate-[float_5s_ease-in-out_infinite] hidden lg:block opacity-80 z-0" style="animation-delay: 1.5s;">
        <span class="text-5xl shadow-2xl shadow-blue-500/20 rounded-full bg-white/70 backdrop-blur-md p-4 border border-white">📊</span>
    </div>
    <div class="absolute right-[20%] top-[15%] animate-[float_6s_ease-in-out_infinite] hidden lg:block opacity-60 z-0" style="animation-delay: 0.5s;">
        <span class="text-3xl shadow-xl shadow-pink-500/20 rounded-full bg-white/70 backdrop-blur-md p-3 border border-white">✨</span>
    </div>

    <div class="relative z-10 mb-8 mt-10">
      <Link href="/" class="flex flex-col items-center group cursor-pointer hover:scale-105 transition-transform duration-300">
        <div class="relative w-14 h-14 rounded-2xl flex items-center justify-center text-white font-bold text-2xl bg-gradient-to-br from-orange-400 to-orange-600 shadow-xl shadow-orange-500/40 overflow-hidden mb-4 border border-orange-300">
          <span class="relative z-10 group-hover:rotate-12 transition-transform duration-300">✦</span>
          <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
        </div>
        <span class="text-3xl font-black bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 tracking-tight">StockOps</span>
      </Link>
    </div>

    <div class="relative z-10 w-full sm:max-w-md bg-white/50 backdrop-blur-3xl px-10 py-12 shadow-2xl shadow-gray-300/40 sm:rounded-[3rem] border border-white overflow-hidden transform transition-all group hover:shadow-orange-200/50 duration-700">
      <div class="absolute inset-0 bg-gradient-to-b from-white/90 to-white/40 -z-10"></div>
      
      <!-- Top edge glow inside the card -->
      <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-orange-400 to-transparent opacity-50"></div>
      
      <slot />
    </div>
  </div>
</template>

<style>
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
@keyframes float {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-15px) rotate(3deg); }
}
</style>
