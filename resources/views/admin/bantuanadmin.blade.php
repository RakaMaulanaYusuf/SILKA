@extends('main')

@section('title', 'Panduan Penggunaan Staff')

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
                <a href="{{ route('admin.dashboard') }}" 
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
                    Tutorial lengkap untuk Staff - Sistem Informasi Laporan Keuangan dan Akuntansi
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
                    <a href="#dashboard" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-green-50 to-green-100/50 hover:from-green-100 hover:to-green-200 border border-green-200/50 hover:border-green-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">02</span>
                        <span class="text-gray-700 group-hover:text-green-700 font-medium text-sm">Dashboard</span>
                    </a>
                    
                    <!-- Item 3 -->
                    <a href="#kelola-akun" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100/50 hover:from-purple-100 hover:to-purple-200 border border-purple-200/50 hover:border-purple-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">03</span>
                        <span class="text-gray-700 group-hover:text-purple-700 font-medium text-sm">Kelola Akun</span>
                    </a>
                    
                    <!-- Item 4 -->
                    <a href="#daftar-company" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-orange-50 to-orange-100/50 hover:from-orange-100 hover:to-orange-200 border border-orange-200/50 hover:border-orange-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">04</span>
                        <span class="text-gray-700 group-hover:text-orange-700 font-medium text-sm">Daftar Company</span>
                    </a>
                    
                    <!-- Item 5 -->
                    <a href="#profil" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-teal-50 to-teal-100/50 hover:from-teal-100 hover:to-teal-200 border border-teal-200/50 hover:border-teal-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">05</span>
                        <span class="text-gray-700 group-hover:text-teal-700 font-medium text-sm">Profil</span>
                    </a>
                    
                    <!-- Item 6 -->
                    <a href="#logout" class="group flex items-center gap-3 p-3.5 rounded-lg bg-gradient-to-br from-red-50 to-red-100/50 hover:from-red-100 hover:to-red-200 border border-red-200/50 hover:border-red-400 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                        <span class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm">06</span>
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
                            Halaman login adalah pintu masuk pertama ke dalam aplikasi. Di sini Anda akan diminta untuk memasukkan kredensial akun Anda sebagai Staff.
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
                            <p class="text-sm text-gray-600">💡 <strong>Tips:</strong> Pastikan username dan password yang dimasukkan sudah benar. Sistem akan mengarahkan Anda ke Dashboard setelah login berhasil.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 2: Dashboard -->
                <section id="dashboard" class="mb-16 pt-2 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">2</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Dashboard</h2>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border-l-4 border-green-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Dashboard adalah pusat informasi yang menampilkan statistik pengguna dan memberikan akses cepat ke berbagai fitur aplikasi. Sebagai Staff, Anda dapat melihat ringkasan data penting di halaman ini.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Informasi yang Ditampilkan:</h3>
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="bg-white rounded-lg p-5 border border-green-200 shadow-sm">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">👥</span>
                                    <strong class="text-gray-800 text-lg">Jumlah Pengguna Staff</strong>
                                </div>
                                <p class="text-sm text-gray-600">Menampilkan total pengguna dengan role Staff yang terdaftar dalam sistem</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-5 border border-green-200 shadow-sm">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">🏢</span>
                                    <strong class="text-gray-800 text-lg">Jumlah Perusahaan</strong>
                                </div>
                                <p class="text-sm text-gray-600">Menampilkan total perusahaan yang terdaftar dalam sistem</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-5 border border-green-200 shadow-sm">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">✨</span>
                                    <strong class="text-gray-800 text-lg">Pengguna Terbaru</strong>
                                </div>
                                <p class="text-sm text-gray-600">Menampilkan daftar pengguna yang baru saja mendaftar atau ditambahkan</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-5 border border-green-200 shadow-sm">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-3xl">⚡</span>
                                    <strong class="text-gray-800 text-lg">Akses Cepat</strong>
                                </div>
                                <p class="text-sm text-gray-600">Tombol shortcut untuk mengakses fitur-fitur penting seperti Kelola Akun dan Daftar Company</p>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <p class="text-sm text-gray-700"><strong>📊 Fungsi Dashboard:</strong> Memberikan gambaran umum tentang aktivitas sistem dan memudahkan navigasi ke menu-menu utama dengan cepat.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 3: Kelola Akun -->
                <section id="kelola-akun" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">3</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Kelola Akun</h2>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border-l-4 border-purple-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Halaman Kelola Akun adalah tempat untuk mengelola seluruh pengguna yang terdaftar dalam sistem. Sebagai Staff, Anda memiliki akses penuh untuk menambah, mengedit, reset password, mengubah role, dan menghapus akun pengguna.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur yang Tersedia:</h3>

                        <!-- 1. Tambah Akun Baru -->
                        <div class="bg-white rounded-lg p-5 border-l-4 border-green-500 mb-4 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-2xl">➕</span>
                                <strong class="text-gray-800 text-lg">1. Tambah Akun Pengguna Baru</strong>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Menambahkan pengguna baru ke dalam sistem</p>
                            
                            <div class="space-y-3 ml-4">
                                <div class="flex gap-3">
                                    <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                    <p class="text-gray-700 pt-1">Klik tombol <strong class="text-green-600">"Tambah User"</strong></p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                    <p class="text-gray-700 pt-1">Isi form yang muncul dengan data lengkap:</p>
                                </div>
                                <div class="ml-12 space-y-2">
                                    <div class="bg-gray-50 rounded p-3">
                                        <p class="text-sm text-gray-700"><strong>• Nama Lengkap:</strong> Masukkan nama lengkap pengguna</p>
                                    </div>
                                    <div class="bg-gray-50 rounded p-3">
                                        <p class="text-sm text-gray-700"><strong>• Email:</strong> Masukkan alamat email (akan digunakan sebagai username)</p>
                                    </div>
                                    <div class="bg-gray-50 rounded p-3">
                                        <p class="text-sm text-gray-700"><strong>• Password:</strong> Masukkan password untuk akun baru</p>
                                    </div>
                                    <div class="bg-gray-50 rounded p-3">
                                        <p class="text-sm text-gray-700"><strong>• Role:</strong> Pilih role (Admin atau Staff)</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-green-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                    <p class="text-gray-700 pt-1">Klik tombol <strong class="text-green-600">"Simpan"</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Edit Data Pengguna -->
                        <div class="bg-white rounded-lg p-5 border-l-4 border-blue-500 mb-4 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-2xl">✏️</span>
                                <strong class="text-gray-800 text-lg">2. Edit Data Pengguna</strong>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Mengubah informasi pengguna yang sudah terdaftar</p>
                            
                            <div class="space-y-3 ml-4">
                                <div class="flex gap-3">
                                    <span class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                    <p class="text-gray-700 pt-1">Cari pengguna yang ingin diedit di tabel</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                    <p class="text-gray-700 pt-1">Klik ikon <strong class="text-blue-600">pensil/edit</strong> pada baris pengguna tersebut</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                    <p class="text-gray-700 pt-1">Ubah data yang diperlukan (Nama, Email, Role)</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                    <p class="text-gray-700 pt-1">Klik <strong class="text-blue-600">"Simpan"</strong> untuk menyimpan perubahan</p>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Reset Password -->
                        <div class="bg-white rounded-lg p-5 border-l-4 border-orange-500 mb-4 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-2xl">🔐</span>
                                <strong class="text-gray-800 text-lg">3. Reset Password Pengguna</strong>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Mengatur ulang password pengguna yang lupa atau ingin mengubah password</p>
                            
                            <div class="space-y-3 ml-4">
                                <div class="flex gap-3">
                                    <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                    <p class="text-gray-700 pt-1">Pilih pengguna yang ingin direset passwordnya</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                    <p class="text-gray-700 pt-1">Klik tombol/ikon <strong class="text-orange-600">"Reset Password"</strong></p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                    <p class="text-gray-700 pt-1">Masukkan <strong>password baru</strong> di form yang muncul</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-orange-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                    <p class="text-gray-700 pt-1">Klik <strong class="text-orange-600">"Simpan"</strong> untuk mengubah password</p>
                                </div>
                            </div>
                            <div class="bg-amber-50 rounded p-3 mt-3 border border-amber-200">
                                <p class="text-xs text-gray-700"><strong>💡 Catatan:</strong> Password baru hanya perlu dimasukkan sekali tanpa konfirmasi password lama pengguna.</p>
                            </div>
                        </div>

                        <!-- 4. Ganti Role -->
                        <div class="bg-white rounded-lg p-5 border-l-4 border-purple-500 mb-4 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-2xl">👤</span>
                                <strong class="text-gray-800 text-lg">4. Ganti Role Pengguna</strong>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Mengubah role pengguna antara Admin dan Staff</p>
                            
                            <div class="space-y-3 ml-4">
                                <div class="flex gap-3">
                                    <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                    <p class="text-gray-700 pt-1">Pilih pengguna yang ingin diubah rolenya</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                    <p class="text-gray-700 pt-1">Klik ikon <strong class="text-purple-600">edit</strong> atau tombol <strong>"Ganti Role"</strong></p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                    <p class="text-gray-700 pt-1">Pilih role baru dari dropdown:</p>
                                </div>
                                <div class="ml-12 grid md:grid-cols-2 gap-3">
                                    <div class="bg-blue-50 rounded p-3 border border-blue-200">
                                        <p class="font-semibold text-gray-800 text-sm">🔹 Admin</p>
                                        <p class="text-xs text-gray-600">Akses penuh ke semua fitur</p>
                                    </div>
                                    <div class="bg-green-50 rounded p-3 border border-green-200">
                                        <p class="font-semibold text-gray-800 text-sm">🔹 Staff</p>
                                        <p class="text-xs text-gray-600">Akses terbatas ke fitur tertentu</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                    <p class="text-gray-700 pt-1">Klik <strong class="text-purple-600">"Simpan"</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Hapus Akun -->
                        <div class="bg-white rounded-lg p-5 border-l-4 border-red-500 shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-2xl">🗑️</span>
                                <strong class="text-gray-800 text-lg">5. Hapus Akun Pengguna</strong>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Menghapus akun pengguna dari sistem secara permanen</p>
                            
                            <div class="space-y-3 ml-4">
                                <div class="flex gap-3">
                                    <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">1</span>
                                    <p class="text-gray-700 pt-1">Pilih pengguna yang ingin dihapus</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">2</span>
                                    <p class="text-gray-700 pt-1">Klik ikon <strong class="text-red-600">sampah/delete</strong></p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">3</span>
                                    <p class="text-gray-700 pt-1">Akan muncul popup konfirmasi penghapusan</p>
                                </div>
                                <div class="flex gap-3">
                                    <span class="bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm flex-shrink-0">4</span>
                                    <p class="text-gray-700 pt-1">Klik <strong class="text-red-600">"Ya, Hapus"</strong> untuk konfirmasi</p>
                                </div>
                            </div>
                            <div class="bg-red-50 rounded p-3 mt-3 border border-red-200">
                                <p class="text-xs text-gray-700"><strong>⚠️ Peringatan:</strong> Penghapusan akun bersifat permanen dan tidak dapat dibatalkan. Pastikan Anda yakin sebelum menghapus akun pengguna.</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Fitur Tambahan:</h3>
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="bg-white rounded-lg p-4 border border-purple-200">
                                <div class="text-2xl mb-2">🔍</div>
                                <strong class="text-gray-800">Pencarian</strong>
                                <p class="text-sm text-gray-600 mt-1">Gunakan search bar untuk mencari pengguna berdasarkan nama atau email</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-purple-200">
                                <div class="text-2xl mb-2">📊</div>
                                <strong class="text-gray-800">Filter Role</strong>
                                <p class="text-sm text-gray-600 mt-1">Filter daftar pengguna berdasarkan role (Admin/Staff)</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 4: Daftar Company -->
                <section id="daftar-company" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">4</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Daftar Company</h2>
                    </div>
                    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-6 border-l-4 border-orange-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Halaman Daftar Company menampilkan seluruh perusahaan yang terdaftar dalam sistem beserta informasi detailnya. Sebagai Staff, Anda dapat melihat dan memantau data perusahaan yang ada.
                        </p>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Informasi yang Ditampilkan:</h3>
                        <div class="bg-white rounded-lg p-5 border border-orange-200 mb-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">🏢</span>
                                    <div>
                                        <strong class="text-gray-800">Nama Perusahaan</strong>
                                        <p class="text-sm text-gray-600">Nama lengkap perusahaan yang terdaftar</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">📍</span>
                                    <div>
                                        <strong class="text-gray-800">Alamat</strong>
                                        <p class="text-sm text-gray-600">Lokasi/alamat perusahaan</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">📞</span>
                                    <div>
                                        <strong class="text-gray-800">Nomor Telepon</strong>
                                        <p class="text-sm text-gray-600">Kontak perusahaan</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">👤</span>
                                    <div>
                                        <strong class="text-gray-800">Pemilik/Admin</strong>
                                        <p class="text-sm text-gray-600">Pengguna yang mengelola perusahaan</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">📅</span>
                                    <div>
                                        <strong class="text-gray-800">Tanggal Dibuat</strong>
                                        <p class="text-sm text-gray-600">Waktu pendaftaran perusahaan</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-orange-600 text-lg">📊</span>
                                    <div>
                                        <strong class="text-gray-800">Status</strong>
                                        <p class="text-sm text-gray-600">Status aktif/non-aktif perusahaan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Cara Menggunakan:</h3>
                        <div class="space-y-4 mb-4">
                            <div class="bg-white rounded-lg p-5 border border-orange-200 shadow-sm">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-orange-600 text-xl">📋</span>
                                    <strong class="text-gray-800">Melihat Daftar</strong>
                                </div>
                                <p class="text-sm text-gray-600">Semua perusahaan ditampilkan dalam bentuk tabel yang terstruktur. Scroll untuk melihat lebih banyak data jika ada banyak perusahaan terdaftar.</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-5 border border-orange-200 shadow-sm">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-orange-600 text-xl">🔍</span>
                                    <strong class="text-gray-800">Pencarian</strong>
                                </div>
                                <p class="text-sm text-gray-600">Gunakan search bar untuk mencari perusahaan berdasarkan nama, alamat, atau pemilik dengan cepat.</p>
                            </div>
                            
                            <div class="bg-white rounded-lg p-5 border border-orange-200 shadow-sm">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-orange-600 text-xl">👁️</span>
                                    <strong class="text-gray-800">Detail Perusahaan</strong>
                                </div>
                                <p class="text-sm text-gray-600">Klik pada baris perusahaan atau tombol "Detail" untuk melihat informasi lengkap perusahaan tersebut.</p>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200 mb-4">
                            <p class="text-sm text-gray-700"><strong>📊 Fungsi Halaman:</strong> Memberikan overview lengkap tentang semua perusahaan yang terdaftar dalam sistem, memudahkan monitoring dan administrasi data perusahaan.</p>
                        </div>

                        <h3 class="font-bold text-gray-800 text-lg mt-6 mb-3">Informasi Statistik:</h3>
                        <div class="grid md:grid-cols-3 gap-3">
                            <div class="bg-white rounded-lg p-4 border border-orange-200 text-center">
                                <div class="text-2xl mb-2">📈</div>
                                <strong class="text-gray-800">Total Company</strong>
                                <p class="text-sm text-gray-600 mt-1">Jumlah keseluruhan perusahaan</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-orange-200 text-center">
                                <div class="text-2xl mb-2">✅</div>
                                <strong class="text-gray-800">Company Aktif</strong>
                                <p class="text-sm text-gray-600 mt-1">Perusahaan yang sedang aktif</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-orange-200 text-center">
                                <div class="text-2xl mb-2">⏸️</div>
                                <strong class="text-gray-800">Company Non-Aktif</strong>
                                <p class="text-sm text-gray-600 mt-1">Perusahaan yang tidak aktif</p>
                            </div>
                        </div>

                        <div class="mt-4 bg-white rounded-lg p-4 border border-orange-200">
                            <p class="text-sm text-gray-600">💡 <strong>Tips:</strong> Gunakan fitur pencarian dan filter untuk menemukan perusahaan tertentu dengan lebih cepat, terutama jika daftar perusahaan sangat panjang.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 5: Profil -->
                <section id="profil" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">5</div>
                        <h2 class="text-3xl font-bold text-gray-800">Halaman Profil</h2>
                    </div>
                    <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-xl p-6 border-l-4 border-teal-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Halaman Profil adalah tempat untuk mengelola informasi akun Anda sendiri sebagai Staff. Anda dapat mengubah data pribadi, foto profil, dan password akun Anda.
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
                                        <p><strong>Role:</strong> Menampilkan role Anda (Staff - tidak dapat diubah sendiri)</p>
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

                <!-- Section 6: Logout -->
                <section id="logout" class="mb-16 pt-4 scroll-mt-20">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg">6</div>
                        <h2 class="text-3xl font-bold text-gray-800">Logout dari Sistem</h2>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-xl p-6 border-l-4 border-red-600">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Logout adalah proses untuk keluar dari sistem dengan aman. Fitur ini penting untuk menjaga keamanan data, terutama jika menggunakan komputer atau perangkat yang dipakai bersama.
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
                                    <p class="text-sm text-gray-600">Setelah logout, sesi Anda akan dihapus dari sistem dan Anda perlu login kembali untuk mengakses aplikasi. Ini memastikan tidak ada orang lain yang dapat mengakses data sistem.</p>
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
                            Sistem Informasi Laporan Keuangan dan Akuntansi - Staff
                        </p>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 max-w-2xl mx-auto">
                            <p class="text-white text-sm">
                                Dengan memahami setiap fitur yang ada, Anda kini dapat mengelola pengguna dan memantau data perusahaan dengan lebih efisien.
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