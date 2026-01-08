@extends('main')

@section('title', 'Daftar Perusahaan')

@section('page')
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
</style>
<div class="bg-gray-50 min-h-screen flex flex-col" x-data="{
    openDrawer: false,
    openPeriodModal: false,
    openEditDrawer: false,
    editingCompany: null,
    searchTerm: '',
    companies: {{ Js::from($companies) }},

    filteredCompanies() {
        return this.companies.filter(c => 
            c.nama.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
    }, 
}">
    <div class="flex overflow-hidden">
        <x-side-bar-admin></x-side-bar-admin>
        
        <div id="main-content" class="relative text-black font-poppins w-full h-full overflow-y-auto">
            <!-- Header Box -->
            <div class="bg-white p-6 mx-6 mt-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-black">Daftar Perusahaan</h1>
                        <p class="text-gray-600 mt-1">Data semua perusahaan yang terdaftar dalam sistem</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Perusahaan</p>
                            <p class="font-semibold">{{ $companies->count() }}</p>
                        </div>
                    </div>
                </div>
                <!-- Search Bar -->
                <div class="mt-6">
                    <input type="text"
                        x-model="searchTerm"
                        placeholder="Cari nama perusahaan..."
                        class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            

            <!-- Companies Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                <template x-for="company in filteredCompanies()" :key="company.company_id">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <!-- Company Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="p-3 bg-blue-100 rounded-lg">
                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-lg font-semibold text-gray-900" x-text="company.nama"></h3>
                                        <p class="text-sm text-gray-500">ID: <span x-text="company.company_id"></span></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Details -->
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Jasa:</span>
                                    <span class="text-sm font-medium" x-text="company.tipe || 'N/A'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <span class="text-sm font-medium text-gray-700" x-text="company.email || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Kontak:</span>
                                    <span class="text-sm font-medium" x-text="company.kontak || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Alamat:</span>
                                    <span class="text-sm font-medium text-right ml-2" x-text="company.alamat || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Total Periode:</span>
                                    <span class="text-sm font-medium" x-text="company.periods ? company.periods.length : 0"></span>
                                </div>
                            </div>

                            <!-- Periods List -->
                            <template x-if="company.periods && company.periods.length > 0">
                                <div class="border-t pt-4">
                                    <h4 class="text-sm font-medium text-gray-900 mb-2">Periode Tersedia:</h4>
                                    <div class="space-y-1 max-h-32 overflow-y-auto">
                                        <template x-for="period in company.periods.sort((a, b) => {
                                            const months = {
                                                'Januari': 1, 'Februari': 2, 'Maret': 3, 'April': 4, 'Mei': 5, 'Juni': 6,
                                                'Juli': 7, 'Agustus': 8, 'September': 9, 'Oktober': 10, 'November': 11, 'Desember': 12
                                            };
                                            if (b.period_year !== a.period_year) return b.period_year - a.period_year;
                                            return (months[b.period_month] || 0) - (months[a.period_month] || 0);
                                        })" :key="period.period_id">
                                            <div class="flex justify-between items-center text-xs">
                                                <span class="text-gray-600" x-text="period.period_month + ' ' + period.period_year"></span>
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full" 
                                                    x-text="period.period_month + ' ' + period.period_year">
                                                </span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Empty State -->
                <template x-if="filteredCompanies().length === 0">
                    <div class="col-span-full">
                        <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Perusahaan</h3>
                            <p class="text-gray-500">Belum ada perusahaan yang terdaftar dalam sistem.</p>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Summary Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-blue-600" x-text="companies.length"></div>
                    <div class="text-sm text-gray-600">Total Perusahaan</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-green-600" 
                        x-text="companies.reduce((sum, c) => sum + (c.periods ? c.periods.length : 0), 0)">
                    </div>
                    <div class="text-sm text-gray-600">Total Periode</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                    <div class="text-2xl font-bold text-gray-600"
                        x-text="companies.filter(c => new Date(c.created_at) >= new Date(new Date().getFullYear(), new Date().getMonth(), 1)).length">
                    </div>
                    <div class="text-sm text-gray-600">Baru Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection