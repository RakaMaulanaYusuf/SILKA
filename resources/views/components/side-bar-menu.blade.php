<div x-data="{ 
    isOpen: true,
    confirmLogout() {
        showConfirm('Apakah Anda yakin ingin keluar dari sistem?', () => {
            showAlert('info', 'Logging out...');
            setTimeout(() => {
                document.getElementById('logout-form').submit();
            }, 500);
        });
    }
}">
    <div class="fixed left-0 top-0 h-full bg-white shadow-xl rounded-r-3xl flex flex-col transform transition-all duration-300 ease-in-out z-40"
        :class="isOpen ? 'w-72' : 'w-20'">
        
        <div class="flex items-center" :class="isOpen ? 'p-6' : 'py-6 px-4 justify-center'">
            <template x-if="isOpen">
                <div class="flex items-center w-full">
                    <img src="{{ asset('images/logosilka2.png') }}" alt="SILKA" class=" px-10">
                </div>
            </template>
            
            <button 
                @click="isOpen = !isOpen"
                class="absolute right-4 p-2 bg-gray-100 rounded-full text-gray-600 hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5 transform transition-transform duration-300" 
                    :class="isOpen ? 'rotate-180' : 'rotate-0'"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
        </div>
        
        <nav class="mt-8 flex-grow" :class="isOpen ? 'px-3' : 'px-2'">
            <a href="/dashboard"
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Dashboard
                </span>
            </a>
            
            <a href="/listP" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    List Perusahaan
                </span>
            </a>
            <a href="/kodeakun" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Kode Akun
                </span>
            </a>
            <a href="/kodebantu" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Kode Bantu
                </span>
            </a>
            <a href="/jurnalumum" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Jurnal Umum
                </span>
            </a>
            <a href="/bukubesar" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Buku Besar
                </span>
            </a>
            <a href="/bukubesarpembantu" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Buku Besar Pembantu
                </span>
            </a>
            <a href="/labarugi" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Laba Rugi
                </span>
            </a>
            <a href="/neraca" 
                class="flex items-center text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 rounded-xl p-3 mb-2"
                :class="isOpen ? '' : 'justify-center'">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="ml-4 font-semibold text-sm whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0 hidden'">
                    Neraca
                </span>
            </a>
        </nav>

        <div class="p-6">
            <div class="flex items-center justify-between border-t pt-4" :class="isOpen ? '' : 'flex-col'">
                <a href="{{ route('profile.show') }}" class="flex items-center min-w-0 group hover:bg-blue-50 rounded-lg p-2 transition-all duration-200 cursor-pointer" :class="!isOpen && 'mb-4'">
                    <div class="relative flex-shrink-0">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                                alt="Profile" 
                                class="w-10 h-10 rounded-full border-2 border-blue-200 transform transition-transform group-hover:scale-105 object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full border-2 border-blue-200 bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center transform transition-transform group-hover:scale-105">
                                <span class="text-sm font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                    <div class="ml-3 transition-all duration-300 overflow-hidden"
                        :class="isOpen ? 'opacity-100 w-32' : 'opacity-0 w-0 hidden'">
                        <p class="text-sm font-medium text-gray-700 truncate group-hover:text-blue-600">{{ auth()->user()->name }}</p>
                        <p class="text-xs font-medium text-blue-500">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </a>
                
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                
                <button 
                    @click="confirmLogout()"
                    class="flex items-center justify-center w-10 h-10 bg-red-50 hover:bg-red-100 text-red-600 rounded-full transition-all duration-300 group hover:rotate-12">
                    <svg class="w-5 h-5 transform transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m0-8v-1a3 3 0 016 0v1"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="transition-all duration-300 ease-in-out min-h-screen"
        :class="isOpen ? 'ml-72' : 'ml-20'">
        {{ $slot ?? '' }}
    </div>
</div>

<script>
// Simple alert function
function showAlert(type, message) {
    const container = document.getElementById('alert-container');
    if (!container) {
        console.error('Alert container not found!');
        return;
    }
    const alertId = 'alert-' + Date.now();
    
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500', 
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };
    
    const icons = {
        success: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>',
        error: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>',
        warning: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>',
        info: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>'
    };
    
    const alertHTML = `
        <div id="${alertId}" class="flex items-center p-4 text-white rounded-lg shadow-lg alert-enter ${colors[type]} min-w-80 max-w-md">
            <div class="flex-shrink-0">
                ${icons[type]}
            </div>
            <div class="ml-3 text-sm font-medium">
                ${message}
            </div>
            <button onclick="removeAlert('${alertId}')" class="ml-auto -mx-1.5 -my-1.5 text-white rounded-lg p-1.5 hover:bg-white hover:bg-opacity-20">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', alertHTML);
    
    setTimeout(() => {
        removeAlert(alertId);
    }, 4000);
}

function showConfirm(message, onConfirm) {
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
    
    overlay.innerHTML = `
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 alert-enter">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-gray-900">Konfirmasi</h3>
            </div>
            <p class="text-gray-700 mb-6">${message}</p>
            <div class="flex gap-3 justify-end">
                <button onclick="this.closest('.fixed').remove()" 
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </button>
                <button onclick="confirmAction()" 
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    `;
    
    window.confirmAction = function() {
        overlay.remove();
        if (onConfirm) onConfirm();
        delete window.confirmAction;
    };
    
    document.body.appendChild(overlay);
}

function removeAlert(alertId) {
    const alert = document.getElementById(alertId);
    if (alert) {
        alert.classList.remove('alert-enter');
        alert.classList.add('alert-exit');
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.remove();
            }
        }, 300);
    }
}
</script>