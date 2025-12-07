@extends('main')

@section('title', 'Panduan Penggunaan')

@section('page')

<div class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen pb-20">

    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-blue-500 to-purple-700 text-white overflow-hidden mb-14">
        
        <!-- Decorative patterns -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 py-12">
            <div class="text-center">

                <!-- Logo (Clickable) -->
                <a href="{{ route('dashboard') }}" 
                class="inline-flex items-center justify-center mb-3 transition transform hover:scale-105">
                    
                    <img src="{{ asset('images/logobagus.png') }}" 
                        alt="Logo" 
                        class="w-32 h-32 object-contain rounded-3xl">
                </a>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Panduan Penggunaan Aplikasi
                </h1>

                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
                    Tutorial lengkap Sistem Informasi Laporan Keuangan dan Akuntansi
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-6 -mt-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Table of Contents -->
            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 border border-gray-100">
                <!-- Header -->
                <div class="flex items-center gap-3 mb-8 pb-4 border-b-2 border-gray-100">
                    <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-2.5 rounded-lg shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Isi</h2>
                </div>
                
                <!-- Grid Links -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <!-- Item 1 -->
                    <a href="#login" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100/50 hover:from-blue-100 hover:to-blue-200 border border-blue-200/50 hover:border-blue-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">01</span>
                        <span class="text-gray-700 group-hover:text-blue-700 font-medium text-sm">Halaman Login</span>
                    </a>
                    
                    <!-- Item 2 -->
                    <a href="#perusahaan" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-green-50 to-green-100/50 hover:from-green-100 hover:to-green-200 border border-green-200/50 hover:border-green-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">02</span>
                        <span class="text-gray-700 group-hover:text-green-700 font-medium text-sm">List Perusahaan</span>
                    </a>
                    
                    <!-- Item 3 -->
                    <a href="#kode-akun" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100/50 hover:from-purple-100 hover:to-purple-200 border border-purple-200/50 hover:border-purple-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">03</span>
                        <span class="text-gray-700 group-hover:text-purple-700 font-medium text-sm">Kode Akun</span>
                    </a>
                    
                    <!-- Item 4 -->
                    <a href="#kode-bantu" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-orange-50 to-orange-100/50 hover:from-orange-100 hover:to-orange-200 border border-orange-200/50 hover:border-orange-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">04</span>
                        <span class="text-gray-700 group-hover:text-orange-700 font-medium text-sm">Kode Bantu</span>
                    </a>
                    
                    <!-- Item 5 -->
                    <a href="#jurnal" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-cyan-50 to-cyan-100/50 hover:from-cyan-100 hover:to-cyan-200 border border-cyan-200/50 hover:border-cyan-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">05</span>
                        <span class="text-gray-700 group-hover:text-cyan-700 font-medium text-sm">Jurnal Umum</span>
                    </a>
                    
                    <!-- Item 6 -->
                    <a href="#buku-besar" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-emerald-50 to-emerald-100/50 hover:from-emerald-100 hover:to-emerald-200 border border-emerald-200/50 hover:border-emerald-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">06</span>
                        <span class="text-gray-700 group-hover:text-emerald-700 font-medium text-sm">Buku Besar</span>
                    </a>
                    
                    <!-- Item 7 -->
                    <a href="#buku-pembantu" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-violet-50 to-violet-100/50 hover:from-violet-100 hover:to-violet-200 border border-violet-200/50 hover:border-violet-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-violet-500 to-violet-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">07</span>
                        <span class="text-gray-700 group-hover:text-violet-700 font-medium text-sm">Buku Besar Pembantu</span>
                    </a>
                    
                    <!-- Item 8 -->
                    <a href="#laba-rugi" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-rose-50 to-rose-100/50 hover:from-rose-100 hover:to-rose-200 border border-rose-200/50 hover:border-rose-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-rose-500 to-rose-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">08</span>
                        <span class="text-gray-700 group-hover:text-rose-700 font-medium text-sm">Laporan Laba Rugi</span>
                    </a>
                    
                    <!-- Item 9 -->
                    <a href="#neraca" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-indigo-50 to-indigo-100/50 hover:from-indigo-100 hover:to-indigo-200 border border-indigo-200/50 hover:border-indigo-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">09</span>
                        <span class="text-gray-700 group-hover:text-indigo-700 font-medium text-sm">Neraca</span>
                    </a>
                    
                    <!-- Item 10 -->
                    <a href="#dashboard" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-gray-50 to-gray-100/50 hover:from-gray-100 hover:to-gray-200 border border-gray-200/50 hover:border-gray-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">10</span>
                        <span class="text-gray-700 group-hover:text-gray-700 font-medium text-sm">Dashboard</span>
                    </a>
                    
                    <!-- Item 11 -->
                    <a href="#profil" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-teal-50 to-teal-100/50 hover:from-teal-100 hover:to-teal-200 border border-teal-200/50 hover:border-teal-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">11</span>
                        <span class="text-gray-700 group-hover:text-teal-700 font-medium text-sm">Profil</span>
                    </a>
                    
                    <!-- Item 12 -->
                    <a href="#logout" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-red-50 to-red-100/50 hover:from-red-100 hover:to-red-200 border border-red-200/50 hover:border-red-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">12</span>
                        <span class="text-gray-700 group-hover:text-red-700 font-medium text-sm">Logout</span>
                    </a>
                </div>
            </div>

            <!-- Content Sections -->
            <div class="p-8">

                <!-- Section 1: Login -->
                <section id="login" class="mb-16 pt-8 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">1</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Login</h2>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border-l-4 border-blue-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Halaman login adalah pintu masuk pertama ke dalam aplikasi. Di sini Anda akan diminta untuk memasukkan kredensial akun Anda.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                                <p class="text-gray-700"><strong>Username:</strong> Masukkan email yang terdaftar sebagai username Anda</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                                <p class="text-gray-700"><strong>Password:</strong> Masukkan password akun Anda</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm flex-shrink-0 mt-0.5">✓</span>
                                <p class="text-gray-700">Setelah data benar, klik tombol <strong class="text-blue-600">Login</strong></p>
                            </div>
                        </div>
                        <div class="mt-4 bg-white rounded-lg p-4 border border-blue-200">
                            <p class="text-sm text-gray-600">💡 <strong>Tips:</strong> Pastikan username dan password yang dimasukkan sudah benar. Sistem akan mengarahkan Anda ke halaman List Perusahaan setelah login berhasil.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 2: List Perusahaan -->
                <section id="perusahaan" class="mb-16 pt-2 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">2</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman List Perusahaan</h2>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border-l-4 border-green-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Halaman ini merupakan pusat manajemen perusahaan dan periode akuntansi. Sebelum dapat mengakses menu lainnya, Anda harus memilih perusahaan dan periode terlebih dahulu.
                        </p>
                        
                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur yang Tersedia:</h3>
                        <div class="grid md:grid-cols-2 gap-3 mb-4">
                            <div class="bg-white rounded-lg p-4 shadow-sm border border-green-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-green-600">➕</span>
                                    <strong class="text-gray-800">Tambah Perusahaan</strong>
                                </div>
                                <p class="text-sm text-gray-600">Menambah data perusahaan baru beserta periode awalnya</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm border border-green-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-green-600">✏️</span>
                                    <strong class="text-gray-800">Edit Perusahaan</strong>
                                </div>
                                <p class="text-sm text-gray-600">Mengubah informasi perusahaan yang sudah ada</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm border border-green-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-green-600">🗑️</span>
                                    <strong class="text-gray-800">Hapus Perusahaan</strong>
                                </div>
                                <p class="text-sm text-gray-600">Menghapus data perusahaan beserta seluruh datanya</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm border border-green-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-green-600">📅</span>
                                    <strong class="text-gray-800">Pilih Periode</strong>
                                </div>
                                <p class="text-sm text-gray-600">Memilih tahun dan bulan periode akuntansi</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Memilih Perusahaan & Periode:</h3>
                        <div class="space-y-3">
                            <div class="flex gap-3">
                                <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Pilih perusahaan dari daftar yang tersedia</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Pilih tahun dan bulan periode melalui dropdown</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Klik tombol <strong class="text-green-600">"Pilih Perusahaan & Periode"</strong></p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                <p class="text-gray-700 pt-1">Navbar akan menampilkan perusahaan dan periode yang aktif</p>
                            </div>
                        </div>

                        <div class="mt-4 bg-white rounded-lg p-4 border border-green-200">
                            <p class="text-sm text-gray-600">⚠️ <strong>Penting:</strong> Anda harus memilih perusahaan dan periode terlebih dahulu sebelum dapat mengakses menu-menu lainnya seperti Kode Akun, Jurnal Umum, dan Laporan Keuangan.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 3: Kode Akun -->
                <section id="kode-akun" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">3</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Kode Akun</h2>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border-l-4 border-purple-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Halaman Kode Akun adalah tempat untuk mengelola Chart of Account (COA) yang akan digunakan untuk mengelompokkan transaksi dalam jurnal umum. Setiap akun memiliki karakteristik dan fungsi yang berbeda dalam laporan keuangan.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Struktur Tabel Kode Akun:</h3>
                        <div class="bg-white rounded-lg p-5 border border-purple-200 mb-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="flex items-start gap-2">
                                    <span class="text-purple-600 text-lg">📋</span>
                                    <div>
                                        <strong class="text-gray-800">Kode Akun</strong>
                                        <p class="text-sm text-gray-600">Nomor unik identifikasi akun</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-purple-600 text-lg">📝</span>
                                    <div>
                                        <strong class="text-gray-800">Nama Akun</strong>
                                        <p class="text-sm text-gray-600">Nama dari akun tersebut</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-purple-600 text-lg">⚖️</span>
                                    <div>
                                        <strong class="text-gray-800">Pos Saldo</strong>
                                        <p class="text-sm text-gray-600">Debit atau Kredit</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-purple-600 text-lg">📊</span>
                                    <div>
                                        <strong class="text-gray-800">Pos Laporan</strong>
                                        <p class="text-sm text-gray-600">Neraca atau Laba Rugi</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-purple-600 text-lg">💰</span>
                                    <div>
                                        <strong class="text-gray-800">Saldo Awal</strong>
                                        <p class="text-sm text-gray-600">Saldo awal Debit/Kredit</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-purple-600 text-lg">⚙️</span>
                                    <div>
                                        <strong class="text-gray-800">Aksi</strong>
                                        <p class="text-sm text-gray-600">Edit, Simpan, Hapus</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Menambah Data Baru:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Isi semua kolom yang tersedia (Kode Akun, Nama Akun, dll.)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Pos Saldo</strong> (Debit/Kredit) melalui dropdown</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Pos Laporan</strong> (Neraca/Laba Rugi) sesuai klasifikasi akun</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                <p class="text-gray-700 pt-1">Masukkan Saldo Awal sesuai dengan Pos Saldo yang dipilih</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">5</span>
                                <p class="text-gray-700 pt-1">Klik tombol <strong class="text-purple-600">Plus (+)</strong> untuk menyimpan</p>
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-lg p-4 border border-amber-200 mb-4">
                            <p class="text-sm text-gray-700"><strong>💡 Catatan Penting:</strong> Jika Pos Saldo yang dipilih adalah <strong>Debit</strong>, maka hanya kolom Saldo Awal Debit yang aktif. Begitu juga sebaliknya untuk Kredit.</p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur Tambahan:</h3>
                        <div class="grid md:grid-cols-3 gap-3">
                            <div class="bg-white rounded-lg p-4 border border-purple-200">
                                <div class="text-2xl mb-2">✏️</div>
                                <strong class="text-gray-800">Edit Data</strong>
                                <p class="text-sm text-gray-600 mt-1">Klik ikon pensil → ubah data → klik ikon centang untuk menyimpan atau ikon silang untuk batal</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-purple-200">
                                <div class="text-2xl mb-2">🗑️</div>
                                <strong class="text-gray-800">Hapus Data</strong>
                                <p class="text-sm text-gray-600 mt-1">Klik ikon sampah → konfirmasi penghapusan melalui popup</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-purple-200">
                                <div class="text-2xl mb-2">🔍</div>
                                <strong class="text-gray-800">Pencarian</strong>
                                <p class="text-sm text-gray-600 mt-1">Gunakan search bar untuk mencari berdasarkan kode atau nama akun</p>
                            </div>
                        </div>

                        <div class="mt-4 bg-white rounded-lg p-4 border border-purple-200">
                            <p class="text-sm text-gray-600">🖨️ Gunakan tombol <strong>Print</strong> untuk mencetak seluruh daftar Kode Akun dalam format laporan</p>
                        </div>
                    </div>
                </section>

                <!-- Section 4: Kode Bantu -->
                <section id="kode-bantu" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">4</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Kode Bantu</h2>
                    </div>
                    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-6 border-l-4 border-orange-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Kode Bantu adalah fitur khusus untuk mengelompokkan dan melacak transaksi <strong>Piutang</strong> dan <strong>Hutang</strong>. Dengan Kode Bantu, Anda dapat memantau posisi hutang-piutang dengan pelanggan atau supplier secara detail.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Struktur Tabel Kode Bantu:</h3>
                        <div class="bg-white rounded-lg p-5 border border-orange-200 mb-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">🔢</span>
                                    <div>
                                        <strong class="text-gray-800">Kode Bantu</strong>
                                        <p class="text-sm text-gray-600">Nomor identifikasi kode bantu</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">👤</span>
                                    <div>
                                        <strong class="text-gray-800">Nama</strong>
                                        <p class="text-sm text-gray-600">Nama pelanggan/supplier</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">📌</span>
                                    <div>
                                        <strong class="text-gray-800">Status</strong>
                                        <p class="text-sm text-gray-600">Piutang atau Hutang</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">💵</span>
                                    <div>
                                        <strong class="text-gray-800">Saldo Awal</strong>
                                        <p class="text-sm text-gray-600">Saldo awal hutang/piutang</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Menambah Kode Bantu:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Masukkan Kode Bantu (contoh: KB001, KB002)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Masukkan Nama pelanggan atau supplier</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Pilih Status melalui dropdown: <strong class="text-orange-600">Piutang</strong> (untuk pelanggan) atau <strong class="text-orange-600">Hutang</strong> (untuk supplier)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                <p class="text-gray-700 pt-1">Masukkan Saldo Awal (jika ada)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">5</span>
                                <p class="text-gray-700 pt-1">Klik tombol <strong class="text-orange-600">Plus (+)</strong> untuk menyimpan</p>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200 mb-4">
                            <p class="text-sm text-gray-700"><strong>💡 Kegunaan Kode Bantu:</strong></p>
                            <ul class="text-sm text-gray-600 mt-2 space-y-1 ml-4">
                                <li>• Melacak piutang dari setiap pelanggan secara terpisah</li>
                                <li>• Memantau hutang kepada setiap supplier</li>
                                <li>• Mempermudah rekonsiliasi hutang-piutang</li>
                                <li>• Menghasilkan laporan aging piutang/hutang</li>
                            </ul>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur yang Tersedia:</h3>
                        <div class="grid md:grid-cols-3 gap-3">
                            <div class="bg-white rounded-lg p-4 border border-orange-200">
                                <div class="text-2xl mb-2">✏️</div>
                                <strong class="text-gray-800">Edit Data</strong>
                                <p class="text-sm text-gray-600 mt-1">Klik ikon pensil untuk mengedit, centang untuk simpan, silang untuk batal</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-orange-200">
                                <div class="text-2xl mb-2">🗑️</div>
                                <strong class="text-gray-800">Hapus Data</strong>
                                <p class="text-sm text-gray-600 mt-1">Klik ikon sampah dan konfirmasi penghapusan</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-orange-200">
                                <div class="text-2xl mb-2">🔍</div>
                                <strong class="text-gray-800">Pencarian</strong>
                                <p class="text-sm text-gray-600 mt-1">Cari berdasarkan kode atau nama kode bantu</p>
                            </div>
                        </div>

                        <div class="mt-4 bg-white rounded-lg p-4 border border-orange-200">
                            <p class="text-sm text-gray-600">🖨️ Gunakan tombol <strong>Print</strong> untuk mencetak laporan daftar Kode Bantu</p>
                        </div>
                    </div>
                </section>

                <!-- Section 5: Jurnal Umum -->
                <section id="jurnal" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">5</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Jurnal Umum</h2>
                    </div>
                    <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl p-6 border-l-4 border-cyan-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Jurnal Umum adalah jantung dari sistem akuntansi. Di halaman ini, Anda akan mencatat <strong>semua transaksi keuangan</strong> baik transaksi masuk maupun keluar. Setiap transaksi harus dicatat dengan prinsip <strong>Double Entry</strong> dimana total Debit harus sama dengan total Kredit.
                        </p>

                        <div class="bg-amber-50 rounded-lg p-4 border border-amber-300 mb-4">
                            <p class="text-sm text-gray-700">⚖️ <strong>Prinsip Balance:</strong> Sistem akan menampilkan indikator apakah total Debit dan Kredit sudah seimbang. Pastikan selalu balance sebelum melanjutkan ke proses berikutnya.</p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Struktur Tabel Jurnal Umum:</h3>
                        <div class="bg-white rounded-lg p-5 border border-cyan-200 mb-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="flex items-start gap-2">
                                    <span class="text-cyan-600 text-lg">📅</span>
                                    <div>
                                        <strong class="text-gray-800">Tanggal</strong>
                                        <p class="text-sm text-gray-600">Tanggal terjadinya transaksi</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-cyan-600 text-lg">🧾</span>
                                    <div>
                                        <strong class="text-gray-800">Bukti Transaksi</strong>
                                        <p class="text-sm text-gray-600">Nomor nota/invoice/kwitansi</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-cyan-600 text-lg">📝</span>
                                    <div>
                                        <strong class="text-gray-800">Keterangan</strong>
                                        <p class="text-sm text-gray-600">Deskripsi transaksi</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-cyan-600 text-lg">📊</span>
                                    <div>
                                        <strong class="text-gray-800">Kode Akun</strong>
                                        <p class="text-sm text-gray-600">Akun yang digunakan</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-cyan-600 text-lg">🔖</span>
                                    <div>
                                        <strong class="text-gray-800">Kode Bantu</strong>
                                        <p class="text-sm text-gray-600">Untuk hutang/piutang (opsional)</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-cyan-600 text-lg">💰</span>
                                    <div>
                                        <strong class="text-gray-800">Debit & Kredit</strong>
                                        <p class="text-sm text-gray-600">Jumlah nominal transaksi</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Input Transaksi Baru:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Tanggal Transaksi</strong> melalui date picker (format kalender)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Masukkan <strong>Nomor Bukti Transaksi</strong> (contoh: INV-001, KWT-045)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Isi <strong>Keterangan</strong> transaksi dengan jelas</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Kode Akun</strong> dari dropdown (data dari halaman Kode Akun)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">5</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Kode Bantu</strong> jika transaksi melibatkan hutang/piutang</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">6</span>
                                <p class="text-gray-700 pt-1">Masukkan nominal di kolom <strong>Debit</strong> atau <strong>Kredit</strong></p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">7</span>
                                <p class="text-gray-700 pt-1">Klik tombol <strong class="text-cyan-600">Plus (+)</strong> untuk menyimpan transaksi</p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-lg p-4 border-l-4 border-red-500 mb-4">
                            <p class="text-sm text-gray-700 font-semibold mb-2">⚠️ Indikator Balance:</p>
                            <p class="text-sm text-gray-600">• Jika Total Debit ≠ Total Kredit → Sistem menampilkan <span class="text-red-600 font-bold">"BELUM BALANCE"</span></p>
                            <p class="text-sm text-gray-600">• Jika Total Debit = Total Kredit → Sistem menampilkan <span class="text-green-600 font-bold">"BALANCE ✓"</span></p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Contoh Transaksi:</h3>
                        <div class="bg-white rounded-lg p-5 border border-cyan-200 mb-4">
                            <p class="text-sm font-semibold text-gray-800 mb-3">Contoh: Penjualan Tunai Rp 5.000.000</p>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Tanggal</th>
                                            <th class="px-4 py-2 text-left">Keterangan</th>
                                            <th class="px-4 py-2 text-left">Akun</th>
                                            <th class="px-4 py-2 text-right">Debit</th>
                                            <th class="px-4 py-2 text-right">Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b">
                                            <td class="px-4 py-2">01/12/2024</td>
                                            <td class="px-4 py-2">Penjualan tunai</td>
                                            <td class="px-4 py-2">Kas</td>
                                            <td class="px-4 py-2 text-right text-green-600">5.000.000</td>
                                            <td class="px-4 py-2 text-right">-</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-2">01/12/2024</td>
                                            <td class="px-4 py-2">Penjualan tunai</td>
                                            <td class="px-4 py-2">Pendapatan Penjualan</td>
                                            <td class="px-4 py-2 text-right">-</td>
                                            <td class="px-4 py-2 text-right text-blue-600">5.000.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur Tambahan:</h3>
                        <div class="grid md:grid-cols-3 gap-3">
                            <div class="bg-white rounded-lg p-4 border border-cyan-200">
                                <div class="text-2xl mb-2">🔍</div>
                                <strong class="text-gray-800">Search Bar</strong>
                                <p class="text-sm text-gray-600 mt-1">Cari transaksi berdasarkan tanggal, keterangan, atau nomor bukti</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-cyan-200">
                                <div class="text-2xl mb-2">✏️</div>
                                <strong class="text-gray-800">Edit & Delete</strong>
                                <p class="text-sm text-gray-600 mt-1">Edit atau hapus transaksi yang sudah diinput</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-cyan-200">
                                <div class="text-2xl mb-2">🖨️</div>
                                <strong class="text-gray-800">Print</strong>
                                <p class="text-sm text-gray-600 mt-1">Cetak laporan Jurnal Umum lengkap</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 6: Buku Besar -->
                <section id="buku-besar" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">6</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Buku Besar</h2>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-6 border-l-4 border-emerald-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Buku Besar (General Ledger) menampilkan <strong>seluruh transaksi yang dikelompokkan berdasarkan Kode Akun</strong>. Halaman ini membantu Anda melihat riwayat pergerakan setiap akun secara detail, mulai dari saldo awal hingga saldo akhir.
                        </p>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200 mb-4">
                            <p class="text-sm text-gray-700"><strong>📖 Fungsi Buku Besar:</strong> Menyediakan ringkasan kronologis dari semua transaksi yang mempengaruhi akun tertentu, sehingga memudahkan analisis dan audit.</p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Menggunakan:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-emerald-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Kode Akun</strong> yang ingin dilihat melalui dropdown</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-emerald-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Sistem akan menampilkan <strong>semua transaksi</strong> yang terkait dengan akun tersebut</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-emerald-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Tabel akan menampilkan: Tanggal, Keterangan, Debit, Kredit, dan <strong>Saldo Running</strong></p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Informasi yang Ditampilkan:</h3>
                        <div class="grid md:grid-cols-2 gap-3 mb-4">
                            <div class="bg-white rounded-lg p-4 border border-emerald-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-emerald-600 text-xl">📊</span>
                                    <strong class="text-gray-800">Total Debit</strong>
                                </div>
                                <p class="text-sm text-gray-600">Jumlah seluruh transaksi Debit pada akun terpilih</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-emerald-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-emerald-600 text-xl">📈</span>
                                    <strong class="text-gray-800">Total Kredit</strong>
                                </div>
                                <p class="text-sm text-gray-600">Jumlah seluruh transaksi Kredit pada akun terpilih</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-emerald-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-emerald-600 text-xl">💰</span>
                                    <strong class="text-gray-800">Saldo Akhir</strong>
                                </div>
                                <p class="text-sm text-gray-600">Saldo Awal + Total Debit - Total Kredit</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-emerald-200">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-emerald-600 text-xl">📅</span>
                                    <strong class="text-gray-800">Periode</strong>
                                </div>
                                <p class="text-sm text-gray-600">Sesuai dengan periode yang dipilih di awal</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur yang Tersedia:</h3>
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="bg-white rounded-lg p-4 border border-emerald-200">
                                <div class="text-2xl mb-2">🔍</div>
                                <strong class="text-gray-800">Search Bar</strong>
                                <p class="text-sm text-gray-600 mt-1">Cari transaksi spesifik dalam buku besar</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-emerald-200">
                                <div class="text-2xl mb-2">🖨️</div>
                                <strong class="text-gray-800">Print Laporan</strong>
                                <p class="text-sm text-gray-600 mt-1">Cetak Buku Besar untuk akun yang dipilih</p>
                            </div>
                        </div>

                        <div class="mt-4 bg-white rounded-lg p-4 border border-emerald-200">
                            <p class="text-sm text-gray-600">💡 <strong>Tips:</strong> Gunakan Buku Besar untuk memeriksa detail transaksi ketika ada perbedaan saldo atau untuk keperluan audit internal.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 7: Buku Besar Pembantu -->
                <section id="buku-pembantu" class="mb-16 4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">7</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Buku Besar Pembantu</h2>
                    </div>
                    <div class="bg-gradient-to-br from-violet-50 to-purple-50 rounded-xl p-6 border-l-4 border-violet-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Buku Besar Pembantu (Subsidiary Ledger) berfungsi untuk melacak transaksi <strong>Hutang dan Piutang secara detail per pelanggan atau supplier</strong>. Konsepnya mirip dengan Buku Besar, namun menggunakan <strong>Kode Bantu</strong> sebagai dasar pengelompokan.
                        </p>

                        <div class="bg-amber-50 rounded-lg p-4 border border-amber-200 mb-4">
                            <p class="text-sm text-gray-700"><strong>🎯 Manfaat:</strong> Dengan Buku Besar Pembantu, Anda dapat dengan mudah melihat berapa hutang kepada supplier tertentu atau piutang dari pelanggan tertentu.</p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Menggunakan:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-violet-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Kode Bantu</strong> (nama pelanggan/supplier) dari dropdown</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-violet-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Sistem menampilkan <strong>seluruh transaksi hutang/piutang</strong> dengan kode bantu tersebut</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-violet-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Tabel menampilkan riwayat lengkap beserta saldo running</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Informasi yang Ditampilkan:</h3>
                        <div class="grid md:grid-cols-3 gap-3 mb-4">
                            <div class="bg-white rounded-lg p-4 border border-violet-200">
                                <div class="text-2xl mb-2 text-center">📊</div>
                                <strong class="text-gray-800 block text-center">Total Debit</strong>
                                <p class="text-sm text-gray-600 mt-1 text-center">Jumlah transaksi Debit</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-violet-200">
                                <div class="text-2xl mb-2 text-center">📈</div>
                                <strong class="text-gray-800 block text-center">Total Kredit</strong>
                                <p class="text-sm text-gray-600 mt-1 text-center">Jumlah transaksi Kredit</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-violet-200">
                                <div class="text-2xl mb-2 text-center">💵</div>
                                <strong class="text-gray-800 block text-center">Saldo Akhir</strong>
                                <p class="text-sm text-gray-600 mt-1 text-center">Posisi hutang/piutang</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Contoh Penggunaan:</h3>
                        <div class="bg-white rounded-lg p-5 border border-violet-200 mb-4">
                            <div class="space-y-3">
                                <div class="flex items-start gap-3">
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Piutang</span>
                                    <p class="text-gray-700">Untuk melihat berapa piutang dari PT. ABC → Pilih kode bantu "PT. ABC" → Lihat saldo akhir</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Hutang</span>
                                    <p class="text-gray-700">Untuk melihat berapa hutang ke CV. XYZ → Pilih kode bantu "CV. XYZ" → Lihat saldo akhir</p>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur yang Tersedia:</h3>
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="bg-white rounded-lg p-4 border border-violet-200">
                                <div class="text-2xl mb-2">🔍</div>
                                <strong class="text-gray-800">Search Bar</strong>
                                <p class="text-sm text-gray-600 mt-1">Cari transaksi dalam buku besar pembantu</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-violet-200">
                                <div class="text-2xl mb-2">🖨️</div>
                                <strong class="text-gray-800">Print Laporan</strong>
                                <p class="text-sm text-gray-600 mt-1">Cetak laporan buku besar pembantu</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 8: Laporan Laba Rugi -->
                <section id="laba-rugi" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">8</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Laporan Laba Rugi</h2>
                    </div>
                    <div class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-xl p-6 border-l-4 border-rose-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Laporan Laba Rugi (Income Statement) menampilkan <strong>kinerja keuangan perusahaan</strong> dalam periode tertentu. Laporan ini menghitung laba atau rugi dengan membandingkan total pendapatan dengan total biaya yang dikeluarkan.
                        </p>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200 mb-4">
                            <p class="text-sm text-gray-700"><strong>📊 Formula:</strong> Laba Bersih = Pendapatan - Harga Pokok Penjualan (HPP) - Biaya Operasional</p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Struktur Laporan (3 Tabel Utama):</h3>
                        <div class="space-y-3 mb-4">
                            <div class="bg-white rounded-lg p-4 border-l-4 border-green-500">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="bg-green-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">1</span>
                                    <strong class="text-gray-800 text-lg">Tabel Pendapatan</strong>
                                </div>
                                <p class="text-sm text-gray-600">Berisi semua akun yang menghasilkan pendapatan (Penjualan, Pendapatan Jasa, dll)</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border-l-4 border-orange-500">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="bg-orange-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">2</span>
                                    <strong class="text-gray-800 text-lg">Tabel Harga Pokok Penjualan (HPP)</strong>
                                </div>
                                <p class="text-sm text-gray-600">Berisi biaya langsung untuk menghasilkan barang/jasa yang dijual</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border-l-4 border-red-500">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">3</span>
                                    <strong class="text-gray-800 text-lg">Tabel Biaya Operasional</strong>
                                </div>
                                <p class="text-sm text-gray-600">Berisi biaya-biaya operasional (Gaji, Listrik, Sewa, Transportasi, dll)</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Menambah Akun ke Tabel:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-rose-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Pilih tabel yang ingin diisi (Pendapatan, HPP, atau Biaya Operasional)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-rose-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Kode Akun</strong> dari dropdown (hanya akun dengan pos laporan "Laba Rugi" yang muncul)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-rose-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Klik tombol <strong class="text-rose-600">Plus (+)</strong> untuk memasukkan akun ke tabel</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-rose-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                <p class="text-gray-700 pt-1">Sistem akan menampilkan <strong>Nama Akun</strong> dan <strong>Jumlah</strong> secara otomatis dari jurnal</p>
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-lg p-4 border-l-4 border-amber-500 mb-4">
                            <p class="text-sm text-gray-700"><strong>⚠️ Aturan Penting:</strong></p>
                            <ul class="text-sm text-gray-600 mt-2 space-y-1 ml-4">
                                <li>• Satu akun hanya bisa masuk ke <strong>SATU tabel</strong> saja</li>
                                <li>• Jika akun sudah dimasukkan ke tabel Pendapatan, tidak bisa dimasukkan ke HPP atau Biaya Operasional</li>
                                <li>• Untuk memindahkan akun, hapus dulu dari tabel sebelumnya dengan klik ikon <strong>Delete</strong></li>
                            </ul>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Hasil Perhitungan:</h3>
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-5 border-l-4 border-green-600 mb-4">
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 font-semibold">Total Pendapatan</span>
                                    <span class="text-green-600 font-bold">+ Rp XXX</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 font-semibold">Harga Pokok Penjualan</span>
                                    <span class="text-orange-600 font-bold">- Rp XXX</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 font-semibold">Biaya Operasional</span>
                                    <span class="text-red-600 font-bold">- Rp XXX</span>
                                </div>
                                <div class="border-t-2 border-gray-300 pt-2 mt-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-800 font-bold text-lg">Laba/Rugi Bersih</span>
                                        <span class="text-blue-600 font-bold text-lg">= Rp XXX</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4 border border-rose-200">
                            <p class="text-sm text-gray-600">🖨️ Gunakan tombol <strong>Print</strong> untuk mencetak Laporan Laba Rugi dalam format yang profesional dan siap dijadikan laporan resmi.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 9: Neraca -->
                <section id="neraca" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">9</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Neraca</h2>
                    </div>
                    <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl p-6 border-l-4 border-indigo-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Neraca (Balance Sheet) adalah laporan yang menunjukkan <strong>posisi keuangan perusahaan</strong> pada suatu periode tertentu. Neraca menampilkan <strong>Aset (Aktiva)</strong> yang dimiliki perusahaan dan bagaimana aset tersebut dibiayai melalui <strong>Hutang (Kewajiban)</strong> dan <strong>Modal (Ekuitas)</strong>.
                        </p>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200 mb-4">
                            <p class="text-sm text-gray-700"><strong>⚖️ Prinsip Neraca:</strong> Total Aktiva = Total Pasiva (Kewajiban + Ekuitas). Kedua sisi harus SELALU seimbang!</p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Struktur Neraca (4 Tabel):</h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-4 border-l-4 border-green-600">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">1</span>
                                    <strong class="text-gray-800 text-lg">Aktiva Lancar</strong>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Aset yang mudah dicairkan dalam waktu kurang dari 1 tahun</p>
                                <div class="text-xs text-gray-500 space-y-1">
                                    <p>• Kas & Bank</p>
                                    <p>• Piutang Usaha</p>
                                    <p>• Persediaan Barang</p>
                                    <p>• Perlengkapan</p>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-4 border-l-4 border-blue-600">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">2</span>
                                    <strong class="text-gray-800 text-lg">Aktiva Tetap</strong>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Aset jangka panjang yang digunakan untuk operasional</p>
                                <div class="text-xs text-gray-500 space-y-1">
                                    <p>• Tanah</p>
                                    <p>• Bangunan</p>
                                    <p>• Kendaraan</p>
                                    <p>• Peralatan & Mesin</p>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-lg p-4 border-l-4 border-orange-600">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">3</span>
                                    <strong class="text-gray-800 text-lg">Kewajiban</strong>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Hutang atau kewajiban yang harus dibayar perusahaan</p>
                                <div class="text-xs text-gray-500 space-y-1">
                                    <p>• Hutang Usaha</p>
                                    <p>• Hutang Bank</p>
                                    <p>• Hutang Gaji</p>
                                    <p>• Hutang Pajak</p>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-4 border-l-4 border-purple-600">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">4</span>
                                    <strong class="text-gray-800 text-lg">Ekuitas</strong>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Modal pemilik dan laba yang ditahan</p>
                                <div class="text-xs text-gray-500 space-y-1">
                                    <p>• Modal Pemilik</p>
                                    <p>• Laba Ditahan</p>
                                    <p>• Laba Tahun Berjalan</p>
                                    <p>• Prive</p>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Menambah Akun ke Neraca:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Pilih salah satu dari 4 tabel (Aktiva Lancar, Aktiva Tetap, Kewajiban, atau Ekuitas)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Pilih <strong>Kode Akun</strong> dari dropdown (hanya akun dengan pos laporan "Neraca" yang muncul)</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Klik tombol <strong class="text-indigo-600">Plus (+)</strong> untuk memasukkan akun</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                <p class="text-gray-700 pt-1">Nama akun dan jumlah saldo akan muncul otomatis</p>
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-lg p-4 border-l-4 border-amber-500 mb-4">
                            <p class="text-sm text-gray-700"><strong>⚠️ Aturan Penting:</strong></p>
                            <ul class="text-sm text-gray-600 mt-2 space-y-1 ml-4">
                                <li>• Satu akun hanya bisa masuk ke <strong>SATU tabel</strong></li>
                                <li>• Jika sudah di Aktiva Lancar, tidak bisa masuk ke tabel lain</li>
                                <li>• Untuk memindahkan, hapus dulu dari tabel sebelumnya</li>
                            </ul>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Perhitungan Balance:</h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-5 border-l-4 border-green-600">
                                <div class="text-center mb-2">
                                    <span class="text-3xl">📊</span>
                                </div>
                                <strong class="text-gray-800 block text-center text-lg mb-2">TOTAL AKTIVA</strong>
                                <p class="text-center text-sm text-gray-600 mb-3">Aktiva Lancar + Aktiva Tetap</p>
                                <div class="bg-white rounded-lg p-3 text-center">
                                    <span class="text-green-600 font-bold text-xl">Rp XXX.XXX</span>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-5 border-l-4 border-blue-600">
                                <div class="text-center mb-2">
                                    <span class="text-3xl">📈</span>
                                </div>
                                <strong class="text-gray-800 block text-center text-lg mb-2">TOTAL PASIVA</strong>
                                <p class="text-center text-sm text-gray-600 mb-3">Kewajiban + Ekuitas</p>
                                <div class="bg-white rounded-lg p-3 text-center">
                                    <span class="text-blue-600 font-bold text-xl">Rp XXX.XXX</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg p-5 border-l-4 border-emerald-600 mb-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Status Balance:</p>
                                    <p class="text-lg font-bold text-gray-800">Total Aktiva = Total Pasiva</p>
                                </div>
                                <div class="text-right">
                                    <span class="bg-green-600 text-white px-4 py-2 rounded-full font-bold text-lg">✓ BALANCE</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4 border border-indigo-200">
                            <p class="text-sm text-gray-600">🖨️ Gunakan tombol <strong>Print</strong> untuk mencetak Laporan Neraca dalam format profesional.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 10: Dashboard -->
                <section id="dashboard" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">10</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Dashboard</h2>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50 to-gray-50 rounded-xl p-6 border-l-4 border-gray-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Dashboard adalah <strong>pusat informasi</strong> yang menampilkan ringkasan dan statistik keuangan perusahaan secara visual. Halaman ini memberikan <strong>overview cepat</strong> tentang kondisi keuangan perusahaan pada periode yang dipilih.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Informasi yang Ditampilkan:</h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-5 border-l-4 border-green-600">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">💰</span>
                                    <strong class="text-gray-800 text-lg">Total Pendapatan</strong>
                                </div>
                                <p class="text-sm text-gray-600">Jumlah seluruh pendapatan dalam periode berjalan</p>
                            </div>
                            
                            <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-lg p-5 border-l-4 border-red-600">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">💸</span>
                                    <strong class="text-gray-800 text-lg">Total Pengeluaran</strong>
                                </div>
                                <p class="text-sm text-gray-600">Jumlah seluruh biaya dan pengeluaran yang terjadi</p>
                            </div>
                            
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-5 border-l-4 border-blue-600">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">📊</span>
                                    <strong class="text-gray-800 text-lg">Laba Bersih</strong>
                                </div>
                                <p class="text-sm text-gray-600">Selisih antara total pendapatan dan pengeluaran</p>
                            </div>
                            
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 rounded-lg p-5 border-l-4 border-purple-600">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">🏦</span>
                                    <strong class="text-gray-800 text-lg">Total Aset</strong>
                                </div>
                                <p class="text-sm text-gray-600">Total keseluruhan aset yang dimiliki perusahaan</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur Dashboard:</h3>
                        <div class="space-y-4 mb-4">
                            <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
                                <div class="flex items-start gap-3">
                                    <span class="bg-blue-600 text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 text-xl">📋</span>
                                    <div>
                                        <strong class="text-gray-800 text-lg block mb-1">Transaksi Terbaru</strong>
                                        <p class="text-sm text-gray-600">Menampilkan daftar transaksi yang baru saja diinput ke dalam Jurnal Umum. Anda dapat melihat aktivitas terkini dengan cepat.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
                                <div class="flex items-start gap-3">
                                    <span class="bg-green-600 text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 text-xl">📈</span>
                                    <div>
                                        <strong class="text-gray-800 text-lg block mb-1">Grafik Tren 6 Bulan</strong>
                                        <p class="text-sm text-gray-600 mb-2">Menampilkan grafik perbandingan <strong>Pendapatan vs Pengeluaran</strong> selama 6 bulan terakhir.</p>
                                        <div class="bg-blue-50 rounded p-3 mt-2">
                                            <p class="text-xs text-gray-700"><strong>💡 Manfaat:</strong> Anda dapat melihat tren kenaikan atau penurunan, mengidentifikasi pola musiman, dan membuat prediksi untuk periode mendatang.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg p-4 border-l-4 border-amber-600">
                            <p class="text-sm text-gray-700"><strong>🎯 Kegunaan Dashboard:</strong> Dashboard membantu Anda membuat keputusan bisnis dengan cepat berdasarkan data real-time tanpa perlu membuka setiap laporan secara terpisah.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 11: Profil -->
                <section id="profil" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">11</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Profil</h2>
                    </div>
                    <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-xl p-6 border-l-4 border-teal-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Halaman Profil adalah tempat untuk mengelola <strong>informasi akun pengguna</strong>. Anda dapat mengubah data pribadi, foto profil, dan password akun. Akses halaman profil melalui <strong>menu di sidebar</strong> dengan klik foto profil Anda.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur yang Tersedia:</h3>
                        <div class="space-y-4 mb-4">
                            <div class="bg-white rounded-lg p-5 border-l-4 border-blue-500 shadow-sm">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-2xl">📸</span>
                                    <strong class="text-gray-800 text-lg">Foto Profil</strong>
                                </div>
                                <div class="space-y-2 text-sm text-gray-600 ml-8">
                                    <div class="flex items-start gap-2">
                                        <span class="text-blue-600">•</span>
                                        <p><strong>Upload Foto:</strong> Klik tombol "Pilih File" → Pilih foto dari komputer → Klik "Upload Foto"</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-blue-600">•</span>
                                        <p><strong>Hapus Foto:</strong> Klik tombol "Hapus Foto" untuk menghapus foto profil dan kembali ke avatar default</p>
                                    </div>
                                    <div class="bg-blue-50 rounded p-2 mt-2">
                                        <p class="text-xs text-gray-600">💡 Format yang didukung: JPG, PNG, GIF (maksimal 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg p-5 border-l-4 border-green-500 shadow-sm">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-2xl">📝</span>
                                    <strong class="text-gray-800 text-lg">Informasi Profil</strong>
                                </div>
                                <div class="space-y-2 text-sm text-gray-600 ml-8">
                                    <div class="flex items-start gap-2">
                                        <span class="text-green-600">•</span>
                                        <p><strong>Nama Lengkap:</strong> Dapat diubah sesuai kebutuhan</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-green-600">•</span>
                                        <p><strong>Email:</strong> Dapat diubah (akan digunakan sebagai username untuk login)</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-green-600">•</span>
                                        <p><strong>Role:</strong> Informasi peran pengguna (tidak dapat diubah)</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="text-green-600">•</span>
                                        <p><strong>Bergabung Sejak:</strong> Tanggal akun dibuat (tidak dapat diubah)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg p-5 border-l-4 border-purple-500 shadow-sm">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-2xl">🔐</span>
                                    <strong class="text-gray-800 text-lg">Ubah Password</strong>
                                </div>
                                <div class="space-y-3 text-sm text-gray-600 ml-8">
                                    <div class="flex gap-3">
                                        <span class="bg-purple-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs flex-shrink-0">1</span>
                                        <p>Masukkan <strong>Password Saat Ini</strong> untuk verifikasi</p>
                                    </div>
                                    <div class="flex gap-3">
                                        <span class="bg-purple-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs flex-shrink-0">2</span>
                                        <p>Masukkan <strong>Password Baru</strong> yang diinginkan</p>
                                    </div>
                                    <div class="flex gap-3">
                                        <span class="bg-purple-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs flex-shrink-0">3</span>
                                        <p>Masukkan ulang password baru di <strong>Konfirmasi Password Baru</strong></p>
                                    </div>
                                    <div class="flex gap-3">
                                        <span class="bg-purple-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs flex-shrink-0">4</span>
                                        <p>Klik tombol <strong class="text-purple-600">"Ubah Password"</strong></p>
                                    </div>
                                    <div class="bg-amber-50 rounded p-3 mt-2 border border-amber-200">
                                        <p class="text-xs text-gray-700"><strong>⚠️ Perhatian:</strong> Pastikan password baru minimal 8 karakter dan kombinasikan huruf, angka, serta simbol untuk keamanan maksimal.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Mengakses Menu Profil:</h3>
                        <div class="bg-white rounded-lg p-5 border border-teal-200 mb-4">
                            <div class="space-y-3">
                                <div class="flex gap-3">
                                    <span class="bg-teal-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                    <p class="text-gray-700 pt-1">Lihat di bagian <strong>sidebar</strong> (menu samping)</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-teal-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                    <p class="text-gray-700 pt-1">Klik pada <strong>foto profil dan nama Anda</strong> di bagian bawah sidebar</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-teal-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                    <p class="text-gray-700 pt-1">Akan muncul dropdown menu dengan 2 pilihan:</p>
                                </div>
                                <div class="ml-12 space-y-2">
                                    <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                                        <p class="font-semibold text-gray-800">👤 Profil Saya</p>
                                        <p class="text-sm text-gray-600">Menuju halaman profil untuk edit data</p>
                                    </div>
                                    <div class="bg-red-50 rounded-lg p-3 border border-red-200">
                                        <p class="font-semibold text-gray-800">🚪 Logout</p>
                                        <p class="text-sm text-gray-600">Keluar dari sistem</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-600">
                            <p class="text-sm text-gray-700"><strong>✅ Notifikasi Berhasil:</strong> Setiap kali Anda melakukan perubahan pada profil (upload foto, ubah nama, ubah email, atau ubah password), sistem akan menampilkan pesan konfirmasi keberhasilan.</p>
                        </div>

                        <div class="mt-4 bg-white rounded-lg p-4 border border-teal-200">
                            <p class="text-sm text-gray-600">🔙 Gunakan tombol <strong>"Kembali"</strong> untuk kembali ke halaman Dashboard setelah selesai mengelola profil.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 12: Logout -->
                <section id="logout" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">12</div>
                        <h2 class="text-3xl font-bold text-gray-800">Logout dari Sistem</h2>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-xl p-6 border-l-4 border-red-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Logout adalah proses untuk <strong>keluar dari sistem</strong> dengan aman. Fitur ini penting untuk menjaga keamanan data Anda, terutama jika menggunakan komputer atau perangkat yang dipakai bersama.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Melakukan Logout:</h3>
                        <div class="space-y-3 mb-4">
                            <div class="flex gap-3">
                                <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                <p class="text-gray-700 pt-1">Klik <strong>foto profil dan nama Anda</strong> di bagian bawah sidebar</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                <p class="text-gray-700 pt-1">Pilih menu <strong class="text-red-600">"Logout"</strong> dari dropdown</p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                <p class="text-gray-700 pt-1">Sistem akan menampilkan <strong>popup konfirmasi</strong></p>
                            </div>
                            <div class="flex gap-3">
                                <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                <p class="text-gray-700 pt-1">Pilih salah satu:</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mb-4 ml-12">
                            <div class="bg-white rounded-lg p-5 border-l-4 border-red-600 shadow-sm">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-2xl">✅</span>
                                    <strong class="text-gray-800">Ya, Logout</strong>
                                </div>
                                <p class="text-sm text-gray-600">Konfirmasi untuk keluar dari sistem. Anda akan diarahkan kembali ke halaman Login.</p>
                            </div>
                            <div class="bg-white rounded-lg p-5 border-l-4 border-gray-400 shadow-sm">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-2xl">❌</span>
                                    <strong class="text-gray-800">Batal</strong>
                                </div>
                                <p class="text-sm text-gray-600">Membatalkan proses logout dan tetap berada di halaman saat ini.</p>
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-lg p-4 border-l-4 border-amber-500 mb-4">
                            <p class="text-sm text-gray-700"><strong>⚠️ Penting:</strong></p>
                            <ul class="text-sm text-gray-600 mt-2 space-y-1 ml-4">
                                <li>• Pastikan semua pekerjaan sudah disimpan sebelum logout</li>
                                <li>• Jangan tinggalkan sistem dalam keadaan login di komputer publik</li>
                                <li>• Selalu logout setelah selesai menggunakan aplikasi untuk keamanan</li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-5 border border-blue-200">
                            <div class="flex items-start gap-3">
                                <span class="text-3xl">🔒</span>
                                <div>
                                    <strong class="text-gray-800 block mb-2">Keamanan Data</strong>
                                    <p class="text-sm text-gray-600">Setelah logout, sesi Anda akan dihapus dari sistem dan Anda perlu login kembali untuk mengakses aplikasi. Ini memastikan tidak ada orang lain yang dapat mengakses data keuangan perusahaan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Closing Section -->
                <section class="mb-12 pt-4">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-700 rounded-xl p-8 text-white text-center shadow-lg">
                        <div class="mb-4">
                            <span class="text-4xl">🎉</span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold mb-3">Selamat!</h2>
                        <p class="text-white mb-2">
                            Anda telah menyelesaikan panduan lengkap penggunaan
                        </p>
                        <p class="text-xl md:text-2xl font-bold mb-5">
                            Sistem Informasi Laporan Keuangan dan Akuntansi
                        </p>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 max-w-2xl mx-auto">
                            <p class="text-white text-sm">
                                Dengan memahami setiap fitur yang ada, Anda kini dapat mengelola laporan keuangan perusahaan dengan lebih efisien dan akurat.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Support Section -->
                <section class="mb-8 pt-4">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-700 rounded-xl p-6 border border-gray-200">
                        <div class="text-center mb-4">
                            <span class="text-4xl">💬</span>
                        </div>
                        <h3 class="text-xl font-bold text-white text-center mb-2">Butuh Bantuan?</h3>
                        <p class="text-white text-center mb-4">
                            Jika Anda memiliki pertanyaan atau mengalami kendala dalam menggunakan aplikasi, jangan ragu untuk menghubungi tim support kami.
                        </p>
                        <div class="grid md:grid-cols-3 gap-3">
                            <div class="bg-white rounded-lg p-4 text-center border border-gray-200">
                                <span class="text-2xl mb-2 block">📧</span>
                                <strong class="text-gray-800 block mb-1">Email</strong>
                                <p class="text-sm text-gray-600">support@example.com</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center border border-gray-200">
                                <span class="text-2xl mb-2 block">📞</span>
                                <strong class="text-gray-800 block mb-1">Telepon</strong>
                                <p class="text-sm text-gray-600">(021) 1234-5678</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center border border-gray-200">
                                <span class="text-2xl mb-2 block">💬</span>
                                <strong class="text-gray-800 block mb-1">WhatsApp</strong>
                                <p class="text-sm text-gray-600">+62 812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </div>
    </div>
</div>

<style>
    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #3b82f6;
        border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #2563eb;
    }

    /* Hover Effect for Links */
    a {
        transition: all 0.3s ease;
    }

    /* Section Spacing */
    section {
        /* animation: fadeIn 0.6s ease-in; */
        scroll-margin-top: 100px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endsection