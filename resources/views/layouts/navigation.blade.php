<nav class="bg-white border-b border-gray-200 px-4 py-3 shadow-sm flex items-center justify-between">
    <!-- Kiri: Bisa untuk Judul atau Sidebar Toggle -->
    <div class="flex items-center space-x-4">
        {{-- Contoh tombol toggle sidebar --}}
        <button
            @click="$dispatch('toggle-sidebar')"
            class="text-gray-500 hover:text-gray-700 focus:outline-none lg:hidden"
            title="Toggle Sidebar"
        >
            <i class="fas fa-bars text-lg"></i>
        </button>

        {{-- Slot judul halaman --}}
        <h1 class="text-lg font-semibold text-gray-700 hidden sm:block">
            @yield('page-title', 'Dashboard')
        </h1>
    </div>

    <!-- Kanan: User Dropdown -->
    <div class="relative">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-800 focus:outline-none transition"
                >
                    <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-semibold uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="hidden sm:inline-block">{{ Auth::user()->name }}</span>
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    <i class="fas fa-user mr-2 w-4 text-gray-400"></i>
                    {{ __('Profil') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt mr-2 w-4 text-gray-400"></i>
                        {{ __('Keluar') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>