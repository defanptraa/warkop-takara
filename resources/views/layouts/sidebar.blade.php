<aside
    x-data="{ open: false }"
    :class="open ? 'w-64' : 'w-16'"
    class="flex flex-col h-full bg-white border-r shadow-lg transition-all duration-300 overflow-hidden"
    style="min-height: 100vh;"
>
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between px-4 py-5 border-b border-gray-200">
        <h2
            class="text-xl font-extrabold text-[#5B913B] truncate"
            x-show="open"
            x-transition
        >
            WARKOP TAKARA
        </h2>
        <button
            @click="open = !open"
            class="text-gray-500 hover:text-[#5B913B] focus:outline-none transition-colors"
            :aria-label="open ? 'Tutup sidebar' : 'Buka sidebar'"
        >
            <svg
                x-show="open"
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                x-transition
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <svg
                x-show="!open"
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                x-transition
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 py-6 space-y-1 px-2">
        @php
            $navItems = [
                ['label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'route' => 'dashboard', 'active' => request()->routeIs('dashboard')],
                ['label' => 'Kelola Produk', 'icon' => 'fas fa-box-open', 'route' => 'produk.index', 'active' => request()->is('produk*')],
                ['label' => 'Pesanan', 'icon' => 'fas fa-receipt', 'route' => 'orders.index', 'active' => request()->routeIs('orders.index')],
                ['label' => 'Laporan Pendapatan', 'icon' => 'fas fa-chart-line', 'route' => 'laporan.index', 'active' => request()->routeIs('laporan.index')],
                ['label' => 'Laporan Transaksi', 'icon' => 'fas fa-file-invoice-dollar', 'route' => 'transaksi.index', 'active' => request()->routeIs('transaksi.index')],
            ];
        @endphp

        @foreach ($navItems as $item)
            <a
                href="{{ route($item['route']) }}"
                class="group flex items-center gap-4 rounded-lg px-4 py-3 text-sm font-semibold transition-colors
                       {{ $item['active'] 
                            ? 'bg-[#77B254] text-white shadow-md' 
                            : 'text-gray-700 hover:bg-[#D99D81] hover:text-white' }}"
                x-tooltip="!open ? '{{ $item['label'] }}' : null"
            >
                <i class="{{ $item['icon'] }} w-6 text-center"></i>
                <span x-show="open" x-transition class="truncate">{{ $item['label'] }}</span>
            </a>
        @endforeach

        <form method="POST" action="{{ route('logout') }}" class="mt-6 px-1">
            @csrf
            <button
                type="submit"
                class="group flex items-center gap-4 w-full rounded-lg px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors"
                x-tooltip="!open ? 'Keluar' : null"
            >
                <i class="fas fa-sign-out-alt w-6 text-center"></i>
                <span x-show="open" x-transition>Keluar</span>
            </button>
        </form>
    </nav>
</aside>