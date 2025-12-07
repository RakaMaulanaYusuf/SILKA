@extends('main')

@section('title', 'Jurnal Umum')

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

<div id="alert-container" class="fixed top-4 left-1/2 -translate-x-1/2 z-50 space-y-3"></div>

<div class="bg-gray-50 min-h-screen flex flex-col" x-data="{ 
    searchTerm: '',
    transactions: {{ Js::from($journals) }},
    accounts: {{ Js::from($accounts) }},
    helpers: {{ Js::from($helpers) }},
    balanceStatus: {{ Js::from($balanceStatus) }},
    newRow: {
        tanggal: '',
        bukti_transaksi: '',
        keterangan: '',
        kode_akun: '',
        kode_bantu: '',
        debit: '',
        credit: ''
    },
    validateForm(data) {
        if (!data.tanggal || !data.keterangan || !data.kode_akun) {
            showAlert('warning', 'Tanggal, Keterangan, dan Akun harus diisi');
            return false;
        }
        if (!data.debit && !data.credit) {
            showAlert('warning', 'Nilai Debet atau Kredit harus diisi');
            return false;
        }
        return true;
    },
    async saveData(url = '{{ route('jurnalumum.store') }}', method = 'POST', data = null) {
        if (!this.validateForm(data || this.newRow)) return;
        
        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data || this.newRow)
            });
            
            const result = await response.json();
            
            if (result.success) {
                if (method === 'POST') {
                    this.transactions.unshift({...result.journal, isEditing: false});
                    this.resetForm();
                }
                
                showAlert('success', 'Data berhasil disimpan. Halaman akan dimuat ulang.');
                setTimeout(() => location.reload(), 2000);
            } else {
                showAlert('error', result.message || 'Terjadi kesalahan saat menyimpan data');
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        }
    },
    
    resetForm() {
        this.newRow = {
            tanggal: '',
            bukti_transaksi: '',
            keterangan: '',
            kode_akun: '',
            kode_bantu: '',
            debit: '',
            credit: ''
        };
    },
    
    async deleteTransaction(id) {
        showConfirm('Apakah Anda yakin ingin menghapus transaksi ini?', async () => {
            try {
                const response = await fetch(`/jurnalumum/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    this.transactions = this.transactions.filter(t => t.id !== id);
                    showAlert('success', 'Data berhasil dihapus. Halaman akan dimuat ulang.');
                    setTimeout(() => location.reload(), 2000);
                } else {
                    showAlert('error', result.message || 'Terjadi kesalahan saat menghapus data');
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat menghapus data');
            }
        });
    },
    
    startEdit(transaction) {
        transaction.originalData = { ...transaction };
        transaction.isEditing = true;
    },
    
    async saveEdit(transaction) {
        if (!this.validateForm(transaction)) return;

        try {
            const response = await fetch(`/jurnalumum/${transaction.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(transaction)
            });
            
            const result = await response.json();
            
            if (result.success) {
                transaction.isEditing = false;
                delete transaction.originalData;
                Object.assign(transaction, result.journal);
                
                showAlert('success', 'Data berhasil diperbarui. Halaman akan dimuat ulang.');
                setTimeout(() => location.reload(), 2000);
            } else {
                showAlert('error', result.message || 'Terjadi kesalahan saat menyimpan perubahan');
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat menyimpan perubahan');
        }
    },
    
    cancelEdit(transaction) {
        if (transaction.originalData) {
            Object.assign(transaction, transaction.originalData);
            delete transaction.originalData;
        }
        transaction.isEditing = false;
    },
    
    getAccountName(kode_akun) {
        const account = this.accounts.find(a => a.kode_akun === kode_akun);
        return account ? account.nama_akun : '-';
    },

    getAccountCode(kode_akun) {
        const account = this.accounts.find(a => a.kode_akun === kode_akun);
        return account ? account.kode_akun : '-';
    },

    getHelperName(kode_bantu) {
        const helper = this.helpers.find(h => h.kode_bantu === kode_bantu);
        return helper ? helper.nama_bantu : '-';
    },

    getHelperCode(kode_bantu) {
        const helper = this.helpers.find(h => h.kode_bantu === kode_bantu);
        return helper ? helper.kode_bantu : '-';
    }
}">
    <div class="flex overflow-hidden">
        <x-side-bar-menu></x-side-bar-menu>
        <div id="main-content" class="relative text-black font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            
            <div class="bg-white p-6 mx-6 mt-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-black">Jurnal Umum</h1>
                        <p class="text-sm text-gray-600 mt-1">Kelola jurnal umum perusahaan</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="relative">
                            <input type="text" 
                                x-model="searchTerm"
                                placeholder="Cari transaksi..." 
                                class="w-64 px-4 py-2 pr-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute right-3 top-2.5 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="balanceStatus" class="mb-6">
                    <div :class="balanceStatus.is_balanced ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'" 
                         class="border-l-4 p-4 mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg x-show="balanceStatus.is_balanced" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <svg x-show="!balanceStatus.is_balanced" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm leading-5 font-medium" x-text="balanceStatus.message"></p>
                                <p class="text-sm leading-5 mt-1">
                                    Total Debit: <span class="font-semibold" x-text="new Intl.NumberFormat('id-ID').format(balanceStatus.total_debit)"></span> | 
                                    Total Kredit: <span class="font-semibold" x-text="new Intl.NumberFormat('id-ID').format(balanceStatus.total_credit)"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-blue-600 text-white text-sm">
                                <th class="border border-blue-500 px-4 py-2 w-24">TANGGAL</th>
                                <th class="border border-blue-500 px-4 py-2 w-32">BUKTI TRANSAKSI</th>
                                <th class="border border-blue-500 px-4 py-2">KETERANGAN</th>
                                <th colspan="2" class="border border-blue-500 px-4 py-2">POS AKUN</th>
                                <th colspan="2" class="border border-blue-500 px-4 py-2">KODE BANTU</th>
                                <th class="border border-blue-500 px-4 py-2 w-32">DEBIT</th>
                                <th class="border border-blue-500 px-4 py-2 w-32">KREDIT</th>
                                <th class="border border-blue-500 px-4 py-2 w-16">AKSI</th>
                            </tr>
                            <tr class="bg-blue-600 text-white text-sm">
                                <th colspan="3" class="border border-blue-500 px-4 py-2"></th>
                                <th class="border border-blue-500 px-4 py-2">NAMA AKUN</th>
                                <th class="border border-blue-500 px-4 py-2">KODE AKUN</th>
                                <th class="border border-blue-500 px-4 py-2">NAMA BANTU</th>
                                <th class="border border-blue-500 px-4 py-2">KODE BANTU</th>
                                <th colspan="3" class="border border-blue-500 px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-r">
                                    <input type="date" x-model="newRow.tanggal" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="text" x-model="newRow.bukti_transaksi" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm"
                                        placeholder="Bukti Transaksi">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="text" x-model="newRow.keterangan" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm"
                                        placeholder="Keterangan">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <select x-model="newRow.kode_akun" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm">
                                        <option value="">Pilih Akun</option>
                                        <template x-for="account in accounts" :key="account.kode_akun">
                                            <option :value="account.kode_akun" x-text="account.nama_akun"></option>
                                        </template>
                                    </select>
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="text" 
                                        :value="getAccountCode(newRow.kode_akun)"
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm bg-gray-100"
                                        readonly>
                                </td>

                                <td class="py-2 px-4 border-r">
                                    <select x-model="newRow.kode_bantu" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm">
                                        <option value="">Pilih Kode Bantu</option>
                                        <template x-for="helper in helpers" :key="helper.kode_bantu">
                                            <option :value="helper.kode_bantu" x-text="helper.nama_bantu"></option>
                                        </template>
                                    </select>
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="text" 
                                        :value="getHelperCode(newRow.kode_bantu)"
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm bg-gray-100"
                                        readonly>
                                </td>
                                
                                <td class="py-2 px-4 border-r">
                                    <input type="number" x-model="newRow.debit" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm text-right"
                                        placeholder="0">
                                </td>
                                <td class="py-2 px-4 border-r">
                                    <input type="number" x-model="newRow.credit" 
                                        class="w-full px-2 py-1.5 border rounded focus:ring-2 focus:ring-blue-500 text-sm text-right"
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

                            <template x-for="transaction in transactions.filter(t => 
                                t.keterangan?.toLowerCase().includes(searchTerm.toLowerCase()) ||
                                t.bukti_transaksi?.toLowerCase().includes(searchTerm.toLowerCase()))"
                                :key="transaction.id">
                                <tr :class="{'bg-blue-50': transaction.isEditing}" class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="transaction.tanggal"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <input type="date" x-model="transaction.tanggal" 
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="transaction.bukti_transaksi"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <input type="text" x-model="transaction.bukti_transaksi" 
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="transaction.keterangan"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <input type="text" x-model="transaction.keterangan" 
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="getAccountName(transaction.kode_akun)"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <select x-model="transaction.kode_akun" 
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                                <option value="">Pilih Akun</option>
                                                <template x-for="account in accounts" :key="account.kode_akun">
                                                    <option :value="account.kode_akun" x-text="account.nama_akun"></option>
                                                </template>
                                            </select>
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="getAccountCode(transaction.kode_akun)"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <input type="text" 
                                                :value="getAccountCode(transaction.kode_akun)"
                                                class="w-full px-2 py-1.5 border rounded text-sm bg-gray-100"
                                                readonly>
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="getHelperName(transaction.kode_bantu)"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <select x-model="transaction.kode_bantu" 
                                                class="w-full px-2 py-1.5 border rounded text-sm">
                                                <option value="">Pilih Kode Bantu</option>
                                                <template x-for="helper in helpers" :key="helper.kode_bantu">
                                                    <option :value="helper.kode_bantu" x-text="helper.nama_bantu"></option>
                                                </template>
                                            </select>
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="getHelperCode(transaction.kode_bantu)"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <input type="text" 
                                                :value="getHelperCode(transaction.kode_bantu)"
                                                class="w-full px-2 py-1.5 border rounded text-sm bg-gray-100"
                                                readonly>
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r text-right">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="transaction.debit ? new Intl.NumberFormat('id-ID').format(transaction.debit) : '-'"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <input type="number" x-model="transaction.debit" 
                                                class="w-full px-2 py-1.5 border rounded text-sm text-right">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 border-r text-right">
                                        <template x-if="!transaction.isEditing">
                                            <span x-text="transaction.credit ? new Intl.NumberFormat('id-ID').format(transaction.credit) : '-'"></span>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <input type="number" x-model="transaction.credit" 
                                                class="w-full px-2 py-1.5 border rounded text-sm text-right">
                                        </template>
                                    </td>
                                    
                                    <td class="py-2 px-4 text-center">
                                        <template x-if="!transaction.isEditing">
                                            <div class="flex justify-center gap-2">
                                                <button @click="startEdit(transaction)" 
                                                    class="p-1 text-blue-600 hover:bg-blue-50 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </button>
                                                <button @click="deleteTransaction(transaction.id)" 
                                                    class="p-1 text-red-600 hover:bg-red-50 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <template x-if="transaction.isEditing">
                                            <div class="flex justify-center gap-2">
                                                <button @click="saveEdit(transaction)" 
                                                    class="p-1 text-green-600 hover:bg-green-50 rounded">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                                <button @click="cancelEdit(transaction)" 
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
                        
                        <tfoot class="bg-gray-50 text-sm">
                            <tr>
                                <td colspan="7" class="py-2 px-4 text-right font-medium border-r">Total:</td>
                                <td class="py-2 px-4 text-right font-medium border-r" 
                                    x-text="'Rp.' + new Intl.NumberFormat('id-ID').format(
                                        transactions.reduce((sum, t) => sum + (parseFloat(t.debit) || 0), 0)
                                    )">
                                </td>
                                <td class="py-2 px-4 text-right font-medium border-r"
                                    x-text="new Intl.NumberFormat('id-ID').format(
                                        transactions.reduce((sum, t) => sum + (parseFloat(t.credit) || 0), 0)
                                    )">
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="flex justify-between mt-6">
                    <button onclick="window.location.href='{{ route('pdf.jurnal-umum') }}'" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        <span>Print PDF</span>
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