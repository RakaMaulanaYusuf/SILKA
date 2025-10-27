@extends('main')

@section('title', 'Kode Akun')

@section('page')
<style>
/* Custom alert animations */
.alert-enter {
    animation: slideIn 0.3s ease-out;
}

.alert-exit {
    animation: slideOut 0.3s ease-in;
}

@keyframes slideIn {
    from {
        transform: translateY(-100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateY(0);
        opacity: 1;
    }
    to {
        transform: translateY(-100px);
        opacity: 0;
    }
}
</style>

<!-- Alert Container -->
<div id="alert-container" class="fixed top-4 left-1/2 -translate-x-1/2 z-50 space-y-3"></div>

<div class="bg-gray-50 min-h-screen flex flex-col" 
    x-data="{ 
    searchTerm: '',
    accounts: {{ Js::from($accounts) }},
    newRow: {
        kode_akun: '',
        nama_akun: '',
        tabel_bantuan : '',
        pos_saldo: 'DEBIT',
        pos_laporan: 'NERACA',
        debit: '',
        credit: ''
    },
    handleBalanceTypeChange(row) {
        if (row.pos_saldo === 'DEBIT') {
            row.credit = '';
        } else {
            row.debit = '';
        }
    },
    validateForm(row) {
        if (!row.kode_akun || !row.nama_akun) {
            showAlert('warning', 'Kode dan Nama Akun harus diisi');
            return false;
        }
        if (row.pos_saldo === 'DEBIT' && row.credit) {
            showAlert('warning', 'Kolom kredit harus kosong ketika pos saldo DEBIT');
            return false;
        }
        if (row.pos_saldo === 'CREDIT' && row.debit) {
            showAlert('warning', 'Kolom debit harus kosong ketika pos saldo CREDIT');
            return false;
        }
        // Set default value 0 if empty
        if (row.pos_saldo === 'DEBIT') {
            row.debit = row.debit || 0;
        }
        if (row.pos_saldo === 'CREDIT') {
            row.credit = row.credit || 0;
        }
        return true;
    },
    async saveData(url = '{{ route('kodeakun.store') }}', method = 'POST', data = null) {
        const rowData = data || this.newRow;
        if (!this.validateForm(rowData)) return;

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(rowData)
            });
            
            const result = await response.json();
            
            if (result.success) {
                if (method === 'POST') {
                    this.accounts.push({...result.account, isEditing: false});
                    this.newRow = {
                        kode_akun: '',
                        nama_akun: '',
                        tabel_bantuan : '',
                        pos_saldo: 'DEBIT',
                        pos_laporan: 'NERACA',
                        debit: '',
                        credit: ''
                    };
                }
                showAlert('success', 'Data berhasil disimpan');
            } else {
                showAlert('error', result.message || 'Terjadi kesalahan saat menyimpan data');
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        }
    },
    async deleteAccount(accountId) {
        showConfirm('Apakah Anda yakin ingin menghapus akun ini?', async () => {
            try {
                const response = await fetch(`/kodeakun/${accountId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    this.accounts = this.accounts.filter(account => account.id !== accountId);
                    showAlert('success', 'Akun berhasil dihapus');
                } else {
                    showAlert('error', result.message || 'Terjadi kesalahan saat menghapus data');
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat menghapus data');
            }
        });
    },
    startEdit(account) {
        account.originalData = { ...account };
        account.isEditing = true;
    },
    async saveEdit(account) {
        if (!this.validateForm(account)) return;

        try {
            const response = await fetch(`/kodeakun/${account.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(account)
            });
            
            const result = await response.json();
            
            if (result.success) {
                account.isEditing = false;
                delete account.originalData;
                Object.assign(account, result.account);
                showAlert('success', 'Data berhasil diperbarui');
            } else {
                showAlert('error', result.message || 'Terjadi kesalahan saat menyimpan perubahan');
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat menyimpan perubahan');
        }
    },
    cancelEdit(account) {
        if (account.originalData) {
            Object.assign(account, account.originalData);
            delete account.originalData;
        }
        account.isEditing = false;
    }
    }">
    <div class="flex overflow-hidden">
        <x-side-bar-menu></x-side-bar-menu>
        <div id="main-content" class="relative text-black font-poppins w-full h-full overflow-y-auto"
         :class="isOpen ? 'ml-72' : 'ml-16'">
            <x-nav-bar></x-nav-bar>
            <div class="bg-white p-6 mx-6 mt-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-black">Kode Akun</h1>
                        <p class="text-sm text-gray-600 mt-1">Kelola daftar kode akun perusahaan</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="relative">
                            <input type="text" 
                                x-model="searchTerm"
                                placeholder="Cari kode atau nama akun..." 
                                class="w-64 px-4 py-2 pr-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute right-3 top-2.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-blue-600 text-white text-sm">
                                <th class="py-3 px-4 text-left border-b border-r w-20">ACCOUNT ID</th>
                                <th class="py-3 px-4 text-left border-b border-r w-96">NAMA AKUN</th>
                                <th class="py-3 px-4 text-left border-b border-r w-24">TABEL BANTUAN</th>
                                <th class="py-3 px-4 text-left border-b border-r w-28">POS SALDO</th>
                                <th class="py-3 px-4 text-left border-b border-r w-28">POS LAPORAN</th>
                                <th class="py-3 px-4 text-center border-b" colspan="3">SALDO AWAL</th>
                            </tr>
                            <tr class="bg-blue-600 text-white text-sm">
                                <th class="py-3 px-4 border-r" colspan="5"></th>
                                <th class="py-3 px-4 text-center border-r w-36">DEBIT</th>
                                <th class="py-3 px-4 text-center border-r w-36">CREDIT</th>
                                <th class="py-3 px-4 text-center w-16">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            <!-- New Row Input -->
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-r">
                                    <input type="text" x-model="newRow.kode_akun" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm"
                                        placeholder="Kode"
                                        style="width: 60px;">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="text" x-model="newRow.nama_akun" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm"
                                        placeholder="Nama Akun">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="text" x-model="newRow.tabel_bantuan " 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm"
                                        placeholder="Tabel"
                                        style="width: 60px;">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <select x-model="newRow.pos_saldo" 
                                        @change="handleBalanceTypeChange(newRow)"
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm">
                                        <option value="DEBIT">DEBIT</option>
                                        <option value="CREDIT">CREDIT</option>
                                    </select>
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <select x-model="newRow.pos_laporan" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm">
                                        <option value="NERACA">NERACA</option>
                                        <option value="LABARUGI">LABA RUGI</option>
                                    </select>
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="number" x-model="newRow.debit" 
                                        :disabled="newRow.pos_saldo === 'CREDIT'"
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm text-right"
                                        :class="{'bg-gray-100': newRow.pos_saldo === 'CREDIT'}"
                                        placeholder="0">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="number" x-model="newRow.credit" 
                                        :disabled="newRow.pos_saldo === 'DEBIT'"
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm text-right"
                                        :class="{'bg-gray-100': newRow.pos_saldo === 'DEBIT'}"
                                        placeholder="0">
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <button @click="saveData()"
                                        class="p-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>

                            <!-- Existing Rows -->
                            <template x-for="(account, index) in accounts.filter(a => 
                                a.kode_akun.toString().includes(searchTerm.toLowerCase()) ||
                                a.nama_akun.toLowerCase().includes(searchTerm.toLowerCase())
                            )" :key="index">
                                <tr :class="{'bg-blue-50': account.isEditing}" class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!account.isEditing">
                                            <span x-text="account.kode_akun"></span>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <input type="text" x-model="account.kode_akun" 
                                                class="w-full px-2 py-1.5 border rounded text-sm"
                                                style="width: 60px;">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!account.isEditing">
                                            <span x-text="account.nama_akun"></span>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <input type="text" x-model="account.nama_akun" 
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!account.isEditing">
                                            <span x-text="account.tabel_bantuan "></span>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <input type="text" x-model="account.tabel_bantuan " 
                                                class="w-full px-2 py-1.5 border rounded text-sm"
                                                style="width: 60px;">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!account.isEditing">
                                            <span x-text="account.pos_saldo"></span>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <select x-model="account.pos_saldo" 
                                                @change="handleBalanceTypeChange(account)"
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                                <option value="DEBIT">DEBIT</option>
                                                <option value="CREDIT">CREDIT</option>
                                            </select>
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!account.isEditing">
                                            <span x-text="account.pos_laporan"></span>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <select x-model="account.pos_laporan" 
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                                <option value="NERACA">NERACA</option>
                                                <option value="LABARUGI">LABA RUGI</option>
                                            </select>
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r text-right">
                                        <template x-if="!account.isEditing">
                                            <span x-text="account.debit ? new Intl.NumberFormat('id-ID').format(account.debit) : '-'"></span>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <input type="number" x-model="account.debit" 
                                                :disabled="account.pos_saldo === 'CREDIT'"
                                                :class="{'bg-gray-100': account.pos_saldo === 'CREDIT'}"
                                                class="w-full px-2 py-1.5 border rounded text-sm text-right">
                                        </template>
                                    </td>

                                    <td class="py-2 px-4 border-r text-right">
                                        <template x-if="!account.isEditing">
                                            <span x-text="account.credit ? new Intl.NumberFormat('id-ID').format(account.credit) : '-'"></span>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <input type="number" x-model="account.credit" 
                                                :disabled="account.pos_saldo === 'DEBIT'"
                                                :class="{'bg-gray-100': account.pos_saldo === 'DEBIT'}"
                                                class="w-full px-2 py-1.5 border rounded text-sm text-right">
                                        </template>
                                    </td>
                                
                                    <td class="py-2 px-4 text-center">
                                        <template x-if="!account.isEditing">
                                            <div class="flex justify-center gap-2">
                                                <button @click="startEdit(account)" 
                                                    class="p-1 text-blue-600 hover:bg-blue-50 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </button>
                                                <button @click="deleteAccount(account.id)" 
                                                    class="p-1 text-red-600 hover:bg-red-50 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <template x-if="account.isEditing">
                                            <div class="flex justify-center gap-2">
                                                <button @click="saveEdit(account)" 
                                                    class="p-1 text-green-600 hover:bg-green-50 rounded">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                                <button @click="cancelEdit(account)" 
                                                    class="p-1 text-red-600 hover:bg-red-50 rounded">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <!-- Footer with Totals -->
                        <tfoot class="bg-gray-50 text-sm">
                            <tr>
                                <td colspan="5" class="py-2 px-4 text-right font-medium border-r">Total Saldo Awal:</td>
                                <td class="py-2 px-4 text-right font-medium border-r" 
                                    x-text="'Rp.' + new Intl.NumberFormat('id-ID').format(accounts.reduce((sum, account) => sum + (Number(account.debit) || 0), 0))">
                                </td>
                                <td class="py-2 px-4 text-right font-medium border-r"
                                    x-text="'Rp.' + new Intl.NumberFormat('id-ID').format(accounts.reduce((sum, account) => sum + (Number(account.credit) || 0), 0))">
                                </td>
                                <td class="py-2 px-4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button onclick="window.location.href='{{ route('pdf.kode-akun') }}'" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span>PRINT</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple alert function
function showAlert(type, message) {
    const container = document.getElementById('alert-container');
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
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        removeAlert(alertId);
    }, 4000);
}

// Simple confirm dialog
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
    
    // Add confirm action
    window.confirmAction = function() {
        overlay.remove();
        if (onConfirm) onConfirm();
        delete window.confirmAction;
    };
    
    document.body.appendChild(overlay);
}

// Remove alert function
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
@endsection