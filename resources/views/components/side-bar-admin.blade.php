<!-- CSS untuk SweetAlert agar tombol terlihat -->
<style>
.swal2-confirm {
    color: white !important;
    background-color: #3085d6 !important;
}

.swal2-cancel {
    color: white !important;
    background-color: #d33 !important;
}

.swal2-styled {
    color: white !important;
}

/* Styling untuk dropdown menu */
.dropdown-menu {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
</style>

<div x-data="{ 
    isOpen: localStorage.getItem('sidebarOpen') === 'true' || localStorage.getItem('sidebarOpen') === null ? true : false,
    showProfileMenu: false,

    toggleSidebar() {
        this.isOpen = !this.isOpen;
        localStorage.setItem('sidebarOpen', this.isOpen);
    },

    // Fungsi SweetAlert untuk konfirmasi logout
    confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar dari sistem?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal',
            buttonsStyling: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading alert
                Swal.fire({
                    title: 'Logging out...',
                    text: 'Mohon tunggu sebentar',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit logout form
                document.getElementById('logout-form').submit();
            }
        });
    }
}" 
@click.away="showProfileMenu = false">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 h-full transform transition-all duration-300 ease-in-out z-40"
         :class="isOpen ? 'w-72' : 'w-16'">
        <div class="relative h-full bg-white shadow-lg rounded-r-3xl">
            <!-- Toggle Button -->
            <button 
                @click="toggleSidebar()"
                class="absolute -right-3 top-16 p-2 bg-white rounded-full shadow-lg text-gray-600 hover:text-blue-600 transform transition-all duration-300 hover:scale-105 z-50">
                <svg class="w-6 h-6 transform transition-transform duration-300" 
                     :class="isOpen ? 'rotate-0' : 'rotate-180'"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Logo & Header -->
            <div class="py-6 px-6 border-t bg-gray-50">
                <div class="flex items-center justify-center" :class="isOpen ? 'space-x-3' : ''">
                    <!-- Logo dengan background -->
                    <div class="relative flex-shrink-0">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 transition-all duration-300"
                             :class="isOpen ? 'w-16 h-16' : 'w-11 h-11'">
                            <img src="{{ asset('images/logobagus.png') }}"
                                alt="Logo"
                                class="w-full h-full object-contain">
                        </div>
                    </div>

                    <!-- Nama aplikasi & tagline -->
                    <div class="transition-all duration-300 overflow-hidden"
                         :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                        {{-- <h1 class="font-bold text-lg text-black tracking-tight leading-tight">SILKA</h1> --}}
                        <p class="text-xs text-black font-semibold">Sistem Informasi <br>Laporan Keuangan Akuntansi</p>
                    </div>
                </div>
            </div>
        
            <!-- Menu Items -->
            <nav class="mt-2" :class="isOpen ? 'px-3' : 'px-2'">
                <template x-for="(item, index) in [
                    {name: 'Dashboard Admin', route: '/admin/dashboard', icon: 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'},
                    {name: 'Kelola Akun', route: '/admin/manage-accounts', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z'},
                    {name: 'Daftar Perusahaan', route: '/admin/companies', icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'}
                ]">
                    <a :href="item.route" 
                       class="flex items-center text-gray-600 hover:bg-blue-200 hover:text-blue-600 transition-all duration-300 ease-in-out rounded-xl group relative mb-1"
                       :class="isOpen ? 'px-4 py-3' : 'px-3 py-3 justify-center'">
                        <div class="p-2 bg-blue-600 rounded-lg group-hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon"></path>
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                              :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                            <span x-text="item.name"></span>
                        </span>
                        <div x-show="!isOpen" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-x-1"
                             x-transition:enter-end="opacity-100 translate-x-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-x-0"
                             x-transition:leave-end="opacity-0 translate-x-1"
                             class="absolute left-14 ml-2 bg-gray-900 text-white px-2 py-1 rounded text-sm whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none z-50">
                            <span x-text="item.name"></span>
                        </div>
                    </a>
                </template>
            </nav>
        
            <!-- User Profile & Logout Section -->
            <div class="absolute bottom-0 w-full border-t bg-gray-50">
                <div class="p-4" :class="isOpen ? '' : 'flex flex-col items-center space-y-2'">
                    <!-- Profile Button with Dropdown -->
                    <div class="relative">
                        <button 
                            @click="showProfileMenu = !showProfileMenu"
                            class="flex items-center w-full group hover:bg-blue-200 rounded-lg p-2 transition-all duration-200 cursor-pointer"
                            :class="isOpen ? 'justify-between' : 'justify-center'">
                            <div class="flex items-center min-w-0">
                                <div class="relative flex-shrink-0">
                                    @if(auth()->user()->profile_photo)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                                             alt="Profile" 
                                             class="w-10 h-10 rounded-xl border-2 border-blue-200 transform transition-transform group-hover:scale-105 object-cover -ml-2">
                                    @else
                                        <div class="w-10 h-10 rounded-full border-2 border-blue-200 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center transform transition-transform group-hover:scale-105">
                                            <span class="text-sm font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                                </div>
                                <div class="ml-3 transition-all duration-300 overflow-hidden"
                                     :class="isOpen ? 'opacity-100 w-32' : 'opacity-0 w-0 hidden'">
                                    <p class="text-sm font-medium text-gray-700 truncate group-hover:text-blue-600">{{ auth()->user()->name }}</p>
                                    <p class="text-xs font-medium text-blue-500">{{ ucfirst(auth()->user()->nama) }}</p>
                                </div>
                            </div>
                            
                            <!-- Chevron Icon (only when sidebar open) -->
                            <svg x-show="isOpen" 
                                 class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                 :class="showProfileMenu ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="showProfileMenu && isOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute bottom-full left-0 right-0 mb-2 bg-white rounded-lg shadow-xl border border-gray-100 overflow-hidden dropdown-menu">
                            
                            <a href="{{ route('profile.show') }}" 
                               class="flex items-center px-4 py-3 hover:bg-blue-50 transition-colors duration-200 group">
                                <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-blue-600">Profil Saya</span>
                            </a>

                            <a href="/bantuanadmin" 
                               class="flex items-center px-4 py-3 hover:bg-blue-50 transition-colors duration-200 group">
                                <div class="p-2 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-green-600">Bantuan</span>
                            </a>
                        </div>

                        <!-- Tooltip untuk collapsed state -->
                        <div x-show="!isOpen && showProfileMenu" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-x-1"
                             x-transition:enter-end="opacity-100 translate-x-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-x-0"
                             x-transition:leave-end="opacity-0 translate-x-1"
                             class="absolute left-14 bottom-0 ml-2 bg-white rounded-lg shadow-xl border border-gray-100 overflow-hidden dropdown-menu w-48">
                            
                            <a href="{{ route('profile.show') }}" 
                               class="flex items-center px-4 py-3 hover:bg-blue-50 transition-colors duration-200 group">
                                <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-blue-600">Profil Saya</span>
                            </a>

                            <a href="/bantuanadmin" 
                               class="flex items-center px-4 py-3 hover:bg-blue-50 transition-colors duration-200 group">
                                <div class="p-2 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-green-600">Bantuan</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Hidden Form for Logout -->
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                        @csrf
                    </form>
                    
                    <!-- Logout Button -->
                    <button 
                        @click="confirmLogout()"
                        class="flex items-center justify-center w-full bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-all duration-300 group"
                        :class="isOpen ? 'px-4 py-3 mt-2' : 'w-10 h-10 mt-2'">
                        <svg class="w-5 h-5 transform transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="ml-3 font-medium text-sm transition-all duration-300"
                              :class="isOpen ? 'opacity-100' : 'opacity-0 hidden'">
                            Logout
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="transition-all duration-300 ease-in-out min-h-screen bg-gray-50"
         :class="isOpen ? 'ml-72' : 'ml-16'">
        {{ $slot ?? '' }}
    </div>
</div>

<!-- Pastikan SweetAlert2 library dimuat -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>