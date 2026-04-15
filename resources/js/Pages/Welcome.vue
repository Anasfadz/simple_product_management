<template>
  <div class="min-h-screen bg-[#faf8f6] font-sans overflow-x-hidden selection:bg-orange-500 selection:text-white">
    <!-- Navbar with Glassmorphism -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" :class="{ 'backdrop-blur-md bg-white/70 shadow-sm py-4': scrolled, 'py-6': !scrolled }">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center space-x-2 group cursor-pointer hover:scale-105 transition-transform duration-300">
          <div class="relative w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm bg-gradient-to-br from-orange-400 to-orange-600 shadow-lg shadow-orange-500/30 overflow-hidden">
            <span class="relative z-10">✦</span>
            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
          </div>
          <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 tracking-tight">StockOps</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-gray-600">
          <a href="#" class="hover:text-orange-500 transition-colors flex items-center group">{{ $t('Products') }} <span class="group-hover:translate-y-[2px] transition-transform"><svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></span></a>
          <a href="#" class="hover:text-orange-500 transition-colors flex items-center group">{{ $t('Inventory') }} <span class="group-hover:translate-y-[2px] transition-transform"><svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></span></a>
          <a href="#" class="hover:text-orange-500 transition-colors flex items-center group">{{ $t('Suppliers') }} <span class="group-hover:translate-y-[2px] transition-transform"><svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></span></a>
          <a href="#" class="hover:text-orange-500 transition-colors flex items-center group">{{ $t('Reports') }} <span class="group-hover:translate-y-[2px] transition-transform"><svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></span></a>
        </div>

        <div class="flex items-center space-x-5">
          <!-- Language Switcher -->
          <div class="flex items-center bg-gray-100 rounded-full p-1 border border-gray-200">
             <a :href="route('language.switch', 'en')" class="px-3 py-1 text-xs font-bold rounded-full transition-colors" :class="$page.props.locale === 'en' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'">EN</a>
             <a :href="route('language.switch', 'my')" class="px-3 py-1 text-xs font-bold rounded-full transition-colors" :class="$page.props.locale === 'my' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700'">MY</a>
          </div>

          <template v-if="$page.props.auth.user">
            <Link :href="route('products.index')" class="relative inline-flex h-10 overflow-hidden rounded-full p-[1px] focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-gray-50 group hover:-translate-y-0.5 transition-transform duration-300">
              <span class="absolute inset-[-1000%] animate-[spin_2s_linear_infinite] bg-[conic-gradient(from_90deg_at_50%_50%,#E2CBFF_0%,#393BB2_50%,#E2CBFF_100%)] group-hover:bg-[conic-gradient(from_90deg_at_50%_50%,#ffb07a_0%,#f97316_50%,#ffb07a_100%)] transition-colors duration-500" />
              <span class="inline-flex h-full w-full cursor-pointer items-center justify-center rounded-full bg-white backdrop-blur-3xl px-6 py-1 text-sm font-semibold text-gray-900 group-hover:bg-gray-50 transition-colors">
                {{ $t('Go To App') }}
              </span>
            </Link>
          </template>
          <template v-else>
            <Link v-if="canLogin" :href="route('login')" class="font-semibold text-gray-600 hover:text-orange-500 transition-colors">{{ $t('Log in') }}</Link>
            <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold bg-gray-900 text-white hover:bg-gray-800 px-5 py-2.5 rounded-full shadow-lg shadow-gray-200 transition-all hover:-translate-y-0.5">{{ $t('Register') }}</Link>
          </template>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-32 pb-16 lg:pt-40 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">
      <!-- Animated Background Blobs -->
      <div class="absolute inset-0 pointer-events-none w-full h-full overflow-hidden flex justify-center items-center -z-10">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-orange-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-4000"></div>
      </div>

      <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-gray-900 tracking-tighter leading-[1.1] max-w-5xl mx-auto drop-shadow-sm fade-in-up">
        {{ $t('Streamline Your Inventory &') }}
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-red-500 to-orange-600 block mt-2 pb-2">{{ $t('Product Operations') }}</span>
      </h1>
      
      <p class="mt-8 text-xl text-gray-500 max-w-2xl mx-auto font-light fade-in-up animation-delay-100">
        {{ $t('StockOps connects your entire supply chain, empowering managers and ground staff to tackle key inventory challenges effortlessly.') }}
      </p>

      <div class="mt-10 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 fade-in-up animation-delay-200">
        <Link :href="route('products.index')" class="inline-flex items-center justify-center bg-gray-900 text-white px-8 py-4 rounded-full text-lg font-medium hover:bg-gray-800 hover:-translate-y-1 hover:shadow-2xl hover:shadow-orange-500/30 transition-all duration-300 group">
          {{ $t('Start managing products') }}
          <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </Link>
        <button class="inline-flex items-center justify-center bg-white border-2 border-gray-200 text-gray-900 px-8 py-4 rounded-full text-lg font-medium hover:border-gray-300 hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300">
          {{ $t('Book a Demo') }}
        </button>
      </div>

      <!-- Hero Image Visualization -->
      <div class="relative w-full max-w-5xl mx-auto mt-20 fade-in-up animation-delay-300 group">
        <!-- Floating Glass Pills - Left -->
        <div class="absolute left-[-5%] lg:left-[-10%] top-1/4 flex flex-col space-y-6 z-20">
            <span class="animate-float px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-md border border-white/50 shadow-xl shadow-gray-200/50 hover:bg-orange-50 hover:text-orange-600 transition-colors cursor-pointer">{{ $t('📦 Stock Tracking') }}</span>
            <span class="animate-float delay-100 px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-md border border-white/50 shadow-xl shadow-gray-200/50 hover:bg-orange-50 hover:text-orange-600 transition-colors cursor-pointer ml-8 sm:ml-12">{{ $t('🔍 Barcode Scanning') }}</span>
            <div class="flex space-x-3 ml-2 sm:ml-4">
                <span class="animate-float delay-200 px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-md border border-white/50 shadow-xl shadow-gray-200/50 hover:bg-orange-50 hover:text-orange-600 transition-colors cursor-pointer">{{ $t('🏷️ SKU Gen') }}</span>
            </div>
        </div>

        <!-- Floating Glass Pills - Right -->
        <div class="absolute right-[-5%] lg:right-[-10%] top-1/3 flex flex-col space-y-6 items-end z-20">
            <span class="animate-float delay-300 px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-md border border-white/50 shadow-xl shadow-gray-200/50 hover:bg-orange-50 hover:text-orange-600 transition-colors cursor-pointer">{{ $t('🤝 Vendor Mgmt') }}</span>
            <span class="animate-float delay-100 px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-md border border-white/50 shadow-xl shadow-gray-200/50 hover:bg-orange-50 hover:text-orange-600 transition-colors cursor-pointer mr-8 sm:mr-12">{{ $t('📊 Analytics') }}</span>
            <div class="flex space-x-3 mr-2 sm:mr-4">
                <span class="animate-float delay-200 px-5 py-3 rounded-2xl text-xs sm:text-sm font-semibold text-gray-700 bg-white/70 backdrop-blur-md border border-white/50 shadow-xl shadow-gray-200/50 hover:bg-orange-50 hover:text-orange-600 transition-colors cursor-pointer">{{ $t('⚡ API Sync') }}</span>
            </div>
        </div>

        <!-- Central Glow Effect -->
        <div class="absolute top-[40%] left-[50%] -translate-x-[50%] -translate-y-[50%] w-[600px] h-[600px] bg-gradient-to-r from-orange-400 to-pink-500 rounded-full blur-[120px] opacity-20 mix-blend-multiply group-hover:opacity-30 transition-opacity duration-700 z-0"></div>

        <div class="relative w-full rounded-3xl overflow-hidden shadow-2xl shadow-gray-400/20 bg-white/50 border border-white p-2 sm:p-4 backdrop-blur-sm transform group-hover:-translate-y-2 group-hover:scale-[1.01] transition-all duration-700 z-10">
           <img src="/images/hero.png" alt="Product Management Interface" class="w-full h-auto rounded-xl object-cover mix-blend-normal">
        </div>
      </div>
    </main>

    <!-- Infinite Marquee Logos -->
    <div class="w-full overflow-hidden mt-12 py-10 bg-gradient-to-b from-transparent to-white/50 border-b border-gray-100">
      <div class="flex w-[200%] animate-marquee">
        <div class="w-1/2 flex justify-around items-center opacity-50 grayscale gap-12 px-8">
            <span class="text-2xl font-black tracking-widest text-slate-800 transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">M MODE</span>
            <span class="text-2xl font-bold tracking-wide text-indigo-900 flex items-center transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer"><span class="text-3xl mr-1">▧</span> Mosaic</span>
            <span class="text-2xl font-bold tracking-tighter text-[#ff5a5f] transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">airbnb</span>
            <span class="text-3xl font-black tracking-tighter text-black transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">verizon</span>
            <span class="text-2xl font-medium tracking-tight text-red-500 transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">Alphabet</span>
            <span class="text-2xl font-extrabold tracking-widest text-[#0000FF] transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">VIACOM</span>
        </div>
        <div class="w-1/2 flex justify-around items-center opacity-50 grayscale gap-12 px-8">
            <!-- Duplicate for infinite scroll -->
            <span class="text-2xl font-black tracking-widest text-slate-800 transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">M MODE</span>
            <span class="text-2xl font-bold tracking-wide text-indigo-900 flex items-center transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer"><span class="text-3xl mr-1">▧</span> Mosaic</span>
            <span class="text-2xl font-bold tracking-tighter text-[#ff5a5f] transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">airbnb</span>
            <span class="text-3xl font-black tracking-tighter text-black transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">verizon</span>
            <span class="text-2xl font-medium tracking-tight text-red-500 transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">Alphabet</span>
            <span class="text-2xl font-extrabold tracking-widest text-[#0000FF] transition-all hover:grayscale-0 hover:opacity-100 cursor-pointer">VIACOM</span>
        </div>
      </div>
    </div>

    <!-- Feature Section 1: Dashboard -->
    <section class="max-w-7xl mx-auto px-4 py-28 text-center">
      <div class="inline-block bg-orange-100 text-orange-600 px-4 py-1.5 rounded-full text-sm font-bold mb-6 tracking-wide uppercase shadow-sm">{{ $t('Real-time Visibility') }}</div>
      <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2 tracking-tight">{{ $t('Meet StockOps. Your All-In-One') }}</h2>
      <h2 class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-500 mb-8 tracking-tight">{{ $t('Inventory Stack.') }}</h2>
      <p class="text-gray-500 mb-16 max-w-2xl mx-auto text-lg font-light">{{ $t('Empowering managers with gorgeous, analytical dashboards that simplify tracking, prevent shortages, and maximize ROI.') }}</p>
      
      <div class="relative w-full max-w-5xl mx-auto group">
        <!-- Glow behind dashboard -->
        <div class="absolute inset-0 bg-orange-400 blur-[80px] opacity-10 group-hover:opacity-20 transition-opacity duration-700 rounded-[3rem]"></div>
        
        <div class="relative bg-white/40 backdrop-blur-xl rounded-[2.5rem] p-4 sm:p-10 shadow-2xl shadow-gray-200/50 border border-white overflow-hidden transform group-hover:-translate-y-2 transition-transform duration-700">
          <div class="absolute inset-0 bg-gradient-to-br from-white/80 to-transparent -z-10"></div>
          
          <!-- Micro-interactions on Dashboard -->
          <div class="hidden md:block absolute top-[15%] left-[5%] bg-white/80 backdrop-blur-md p-4 rounded-xl shadow-xl border border-gray-100 animate-float z-20 hover:scale-105 transition-transform cursor-pointer">
            <p class="text-xs text-gray-500 font-bold mb-1">{{ $t('Live Metrics') }}</p>
            <p class="text-sm font-black text-gray-900 flex items-center"><span class="w-2 h-2 rounded-full bg-green-500 mr-2 pulse-dot"></span> {{ $t('Watch your stock') }}</p>
          </div>
          
          <div class="hidden md:block absolute bottom-[20%] right-[3%] bg-white/80 backdrop-blur-md p-4 rounded-xl shadow-xl border border-gray-100 animate-float delay-200 z-20 hover:scale-105 transition-transform cursor-pointer">
             <div class="flex items-center space-x-3">
                 <div class="bg-orange-100 p-2 rounded-full">📉</div>
                 <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">{{ $t('Alert') }}</p>
                    <p class="text-sm font-black text-gray-800">{{ $t('Low Stock Warning') }}</p>
                 </div>
             </div>
          </div>

          <img src="/images/chip.png" alt="Analytical Dashboard" class="mx-auto w-full h-auto rounded-xl drop-shadow-xl scale-100 group-hover:scale-[1.02] transition-transform duration-700 relative z-10">
        </div>
      </div>
    </section>

    <!-- Detailed Features Grid -->
    <section class="bg-white py-32 border-y border-gray-100 relative overflow-hidden">
      <!-- Background pattern -->
      <div class="absolute inset-0 opacity-[0.03] z-0" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 24px 24px;"></div>
      
      <div class="max-w-6xl mx-auto px-4 relative z-10">
        <div class="text-center mb-20 fade-in-up">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">{{ $t('Awesome Ways To Improve') }}</h2>
          <h2 class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-amber-500 mt-2 tracking-tight">{{ $t('Supply Chain!') }}</h2>
          <p class="mt-6 text-gray-500 text-lg max-w-2xl mx-auto font-light">{{ $t('Our user-friendly platform provides precision tracking for every single item, ensuring you are never out of sync.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Card 1 -->
          <div class="group bg-[#faf8f6] p-8 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-orange-100 transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-orange-200 relative overflow-hidden">
              <div class="absolute top-0 right-0 w-32 h-32 bg-orange-100 rounded-full blur-3xl opacity-0 group-hover:opacity-50 transition-opacity duration-500 translate-x-1/2 -translate-y-1/2"></div>
              <div class="text-orange-500 mb-6 bg-white w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">📄</div>
              <h4 class="font-bold text-gray-900 text-xl mb-3">{{ $t('Automated Reports') }}</h4>
              <p class="text-gray-500 text-sm leading-relaxed mb-6 font-light">{{ $t('Generate insights effortlessly for stakeholders and automatically distribute them via e-mail.') }}</p>
              <div class="bg-white rounded-xl p-4 flex justify-between items-center border border-gray-100 group-hover:border-orange-100 transition-colors">
                  <div class="text-xs font-semibold text-gray-600 flex items-center"><svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm8 6a1 1 0 10-2 0v2H8a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2v-2z" clip-rule="evenodd"/></svg> Export.pdf</div>
                  <span class="text-orange-500 text-xs font-bold bg-orange-50 px-2 py-1 rounded">1s</span>
              </div>
          </div>

          <!-- Card 2 -->
          <div class="group bg-[#faf8f6] p-8 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-blue-200 relative overflow-hidden">
              <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-0 group-hover:opacity-50 transition-opacity duration-500 translate-x-1/2 -translate-y-1/2"></div>
              <div class="text-blue-500 mb-6 bg-white w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">🏢</div>
              <h4 class="font-bold text-gray-900 text-xl mb-3">{{ $t('Vendor Notifications') }}</h4>
              <p class="text-gray-500 text-sm leading-relaxed mb-6 font-light">{{ $t('Quickly alert suppliers about low stock via automated Purchase Order requests routing.') }}</p>
              <div class="flex flex-col space-y-2">
                  <div class="bg-white px-3 py-2 rounded-lg text-xs font-medium text-gray-700 border border-gray-100 flex items-center shadow-sm group-hover:border-blue-100 transition-colors"><div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div> PO Sent to Vendor</div>
                  <div class="bg-white px-3 py-2 rounded-lg text-xs font-medium text-gray-700 border border-gray-100 flex items-center shadow-sm opacity-60"><div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div> Awaiting Acknowledgement</div>
              </div>
          </div>

          <!-- Card 3 -->
          <div class="group bg-[#faf8f6] p-8 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-pink-100 transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-pink-200 relative overflow-hidden">
              <div class="absolute top-0 right-0 w-32 h-32 bg-pink-100 rounded-full blur-3xl opacity-0 group-hover:opacity-50 transition-opacity duration-500 translate-x-1/2 -translate-y-1/2"></div>
              <div class="text-pink-500 mb-6 bg-white w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">⚖️</div>
              <h4 class="font-bold text-gray-900 text-xl mb-3">{{ $t('Stock Optimization') }}</h4>
              <p class="text-gray-500 text-sm leading-relaxed mb-6 font-light">{{ $t('Set min/max thresholds to perfectly balance your warehouse stock quantities dynamically.') }}</p>
              <div class="bg-white p-4 rounded-xl flex items-center shadow-sm border border-gray-100 group-hover:border-pink-100 transition-colors">
                  <div class="relative flex w-10 h-10 mr-4">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-20"></span>
                    <span class="relative inline-flex rounded-full w-10 h-10 bg-pink-50 items-center justify-center text-pink-500 text-xs font-bold">5%</span>
                  </div>
                  <div>
                      <div class="text-sm font-bold text-gray-800">Threshold Alert</div>
                      <div class="text-xs text-pink-500 font-medium mt-0.5">Auto-reordering triggered +150</div>
                  </div>
              </div>
          </div>

          <!-- Card 4 -->
          <div class="group bg-[#faf8f6] p-8 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-indigo-200 relative overflow-hidden">
              <div class="text-indigo-500 mb-6 bg-white w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">📅</div>
              <h4 class="font-bold text-gray-900 text-xl mb-3">{{ $t('Delivery Scheduling') }}</h4>
              <p class="text-gray-500 text-sm leading-relaxed mb-6 font-light">{{ $t('Coordinate incoming shipments on a unified calendar planner to avoid docking collisions.') }}</p>
              <div class="bg-white rounded-lg shadow-sm border-l-4 border-indigo-400 p-3 text-xs font-medium text-gray-700 mb-2 transition-transform group-hover:translate-x-1">Shipment A - 10:00 AM</div>
              <div class="bg-white rounded-lg shadow-sm border-l-4 border-orange-400 p-3 text-xs font-medium text-gray-700 opacity-80 h-10 overflow-hidden line-clamp-1 transition-transform group-hover:translate-x-1 duration-200 delay-75">Shipment B - 12:30 PM</div>
          </div>

          <!-- Card 5 -->
          <div class="group bg-[#faf8f6] p-8 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-green-100 transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-green-200 relative overflow-hidden">
              <div class="text-green-500 mb-6 bg-white w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">🚦</div>
              <h4 class="font-bold text-gray-900 text-xl mb-3">{{ $t('Avoid Overstocking') }}</h4>
              <p class="text-gray-500 text-sm leading-relaxed mb-6 font-light">{{ $t('Prevent tied-up capital by setting hard limits on specific SKUs or slow-moving items.') }}</p>
              <div class="text-xs font-semibold text-gray-800 mb-3 flex justify-between"><span>Capacity Limit</span> <span class="text-gray-500">1,000 max</span></div>
              <div class="bg-gray-200 h-2.5 rounded-full overflow-hidden shadow-inner">
                  <div class="bg-gradient-to-r from-green-400 to-green-500 h-full w-[85%] rounded-full relative group-hover:w-[95%] transition-all duration-1000 ease-out">
                     <span class="absolute right-0 top-0 h-full w-full bg-[linear-gradient(45deg,rgba(255,255,255,.15)_25%,transparent_25%,transparent_50%,rgba(255,255,255,.15)_50%,rgba(255,255,255,.15)_75%,transparent_75%,transparent)] bg-[length:1rem_1rem] animate-[stripes_1s_linear_infinite]"></span>
                  </div>
              </div>
              <div class="text-[10px] text-right text-green-600 mt-2 font-bold group-hover:text-amber-500 transition-colors">85% Full</div>
          </div>

          <!-- Card 6 -->
          <div class="group bg-[#faf8f6] p-8 rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-purple-100 transition-all duration-500 hover:-translate-y-2 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
              <div class="text-purple-500 mb-6 bg-white w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">🌍</div>
              <h4 class="font-bold text-gray-900 text-xl mb-3">{{ $t('Multi-Warehouse Sync') }}</h4>
              <p class="text-gray-500 text-sm leading-relaxed mb-6 font-light">{{ $t('Manage several locations concurrently with a single, synchronized source of truth.') }}</p>
              <div class="bg-white p-3 rounded-xl border border-gray-100 text-xs font-semibold text-gray-700 mb-2 flex justify-between items-center shadow-sm"><span class="flex items-center"><span class="w-2.5 h-2.5 bg-green-500 rounded-full mr-2 shadow-sm shadow-green-300 animate-pulse"></span> NY Warehouse</span> <span class="bg-green-50 text-green-600 px-2 py-0.5 rounded text-[10px]">Synced</span></div>
              <div class="bg-white p-3 rounded-xl border border-gray-100 text-xs font-semibold text-gray-700 flex justify-between items-center shadow-sm opacity-70"><span class="flex items-center"><span class="w-2.5 h-2.5 bg-gray-400 rounded-full mr-2 shadow-sm"></span> LA Warehouse</span> <span class="bg-gray-50 text-gray-500 px-2 py-0.5 rounded text-[10px]">Pending</span></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Network / Journey -->
    <section class="max-w-7xl mx-auto px-4 py-32 text-center relative">
      <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2 tracking-tight">{{ $t('Unify Your Warehouses') }}</h2>
      <h2 class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500 mb-6 tracking-tight pb-2">{{ $t('Simplify The Journey.') }}</h2>
      <p class="text-gray-500 mb-16 max-w-2xl mx-auto text-lg font-light">{{ $t('Eliminate vertical barriers. Track deliveries across states, enhance stocking transparency, and unify your disparate operations.') }}</p>
      
      <div class="w-full max-w-5xl mx-auto relative h-[600px] flex items-center justify-center p-8 bg-white shadow-2xl shadow-gray-200/50 rounded-[3rem] border border-gray-100 overflow-hidden group">
         <div class="absolute inset-0 bg-gradient-to-t from-gray-50 via-transparent to-white opacity-60 z-0"></div>
         <!-- Animated scanning line -->
         <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-orange-400 to-transparent opacity-50 z-20 group-hover:animate-scan hidden group-hover:block"></div>
         
         <img src="/images/network.png" alt="Supply Chain Diagram" class="max-w-full h-full mix-blend-darken object-contain group-hover:scale-[1.04] transition duration-1000 ease-out relative z-10 w-full">
      </div>
    </section>

    <!-- Bottom Deep Gradient CTA -->
    <section class="max-w-6xl mx-auto px-4 pb-32">
      <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-black rounded-[3rem] p-12 md:p-24 text-center text-white shadow-2xl shadow-gray-900/40 relative overflow-hidden group">
        
        <!-- Glowing dynamic orbs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3 group-hover:bg-orange-500/30 transition-colors duration-700"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/20 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/4 group-hover:bg-blue-500/30 transition-colors duration-700"></div>
        
        <!-- Subtle Grid Pattern overlay -->
        <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px); background-size: 40px 40px;"></div>

        <h2 class="text-4xl md:text-6xl font-black mb-8 relative z-10 leading-tight tracking-tight">{{ $t('Build your perfect') }} <br/> <span class="bg-clip-text text-transparent bg-gradient-to-r from-orange-300 to-orange-500">{{ $t('inventory system!') }}</span></h2>
        <p class="text-gray-300 max-w-2xl mx-auto mb-12 text-lg font-light relative z-10">
            {{ $t('Stop struggling with spreadsheets. Elevate your warehouse with StockOps unmatched accuracy, automation, and total flexibility.') }}
        </p>
        <Link :href="route('products.index')" class="bg-white text-gray-900 px-12 py-4 rounded-full font-bold shadow-lg shadow-white/10 hover:bg-orange-50 transition-all relative z-10 hover:shadow-xl hover:shadow-orange-500/20 hover:-translate-y-1 transform duration-300 inline-flex items-center text-lg">
            {{ $t('View Products Dashboard') }}
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
        </Link>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

const page = usePage();
const scrolled = ref(false);

const handleScroll = () => {
    scrolled.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<style>
/* Custom Keyframe Animations extending Tailwind seamlessly */
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 7s infinite;
}
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-12px); }
}
.animate-float {
  animation: float 4s ease-in-out infinite;
}
.delay-100 { animation-delay: 1.5s; }
.delay-200 { animation-delay: 0.7s; }
.delay-300 { animation-delay: 2.2s; }

@keyframes marquee {
  0% { transform: translateX(0%); }
  100% { transform: translateX(-50%); }
}
.animate-marquee {
  width: 200%;
  animation: marquee 25s linear infinite;
}
.animate-marquee:hover {
  animation-play-state: paused;
}

@keyframes fade-in-up {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}
.fade-in-up {
  opacity: 0;
  animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
.animation-delay-100 { animation-delay: 100ms; }
.animation-delay-200 { animation-delay: 200ms; }
.animation-delay-300 { animation-delay: 300ms; }

@keyframes scan {
  0% { transform: translateY(0); }
  100% { transform: translateY(600px); }
}
.animate-scan {
  animation: scan 3s linear infinite;
}

@keyframes stripes {
  from { background-position: 1rem 0; }
  to { background-position: 0 0; }
}

.pulse-dot {
  animation: pulse-dot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
@keyframes pulse-dot {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: .5; transform: scale(1.5); }
}
</style>
