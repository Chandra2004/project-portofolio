<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e7f1 100%);
            min-height: 100vh;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .wave {
            animation: wave 8s linear infinite;
        }
        @keyframes wave {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="relative overflow-x-hidden">
    <!-- Background Elements -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
    <div class="absolute top-20 right-20 w-72 h-72 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-20 left-1/3 w-60 h-60 bg-pink-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
    
    <!-- Navigation -->
    <nav class="bg-white border-gray-200 shadow-sm">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-bold whitespace-nowrap bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">UserPortal</span>
            </a>
            <div class="flex items-center space-x-6">
                <span class="text-gray-600">Welcome, <span class="font-semibold text-blue-600">Admin</span></span>
                <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm bg-gray-200 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" type="button">
                    <span class="sr-only">Open user menu</span>
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gradient-to-r from-blue-500 to-purple-500 rounded-full">
                        <span class="font-medium text-white">A</span>
                    </div>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <div class="px-4 py-3 text-sm text-gray-900">
                        <div>Admin User</div>
                        <div class="font-medium truncate">admin@example.com</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownUserAvatarButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 py-12 md:py-20">
        <div class="flex flex-col items-center text-center mb-16">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                <span class="block">SELAMAT DATANG,</span>
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">ADMIN USER!</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl">Anda telah berhasil masuk ke dalam sistem manajemen pengguna. Mulai jelajahi fitur-fitur yang tersedia.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border border-gray-100">
                <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mb-6">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Manajemen Pengguna</h3>
                <p class="text-gray-600 mb-6">Kelola semua pengguna dalam sistem dengan mudah. Tambah, edit, atau hapus pengguna sesuai kebutuhan.</p>
                <a href="/users" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-800">
                    Lihat Pengguna
                    <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border border-gray-100">
                <div class="w-16 h-16 rounded-full bg-purple-50 flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Analitik Pengguna</h3>
                <p class="text-gray-600 mb-6">Pantau aktivitas pengguna dan dapatkan wawasan tentang perilaku mereka melalui dashboard analitik.</p>
                <a href="#" class="inline-flex items-center text-purple-600 font-medium hover:text-purple-800">
                    Lihat Analitik
                    <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 card-hover border border-gray-100">
                <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center mb-6">
                    <i class="fas fa-cog text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Pengaturan Sistem</h3>
                <p class="text-gray-600 mb-6">Atur konfigurasi sistem sesuai kebutuhan organisasi Anda. Sesuaikan preferensi dan integrasi.</p>
                <a href="#" class="inline-flex items-center text-green-600 font-medium hover:text-green-800">
                    Pengaturan
                    <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>
        </div>

        <div class="text-center">
            <a href="/users" class="relative inline-flex items-center justify-center p-4 px-8 py-4 overflow-hidden font-medium text-white transition duration-300 ease-out rounded-full shadow-xl group bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700">
                <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-white/20 via-white/30 to-white/40"></span>
                <span class="absolute top-0 left-0 w-48 h-48 -mt-1 transition-all duration-500 ease-in-out rotate-45 -translate-x-56 -translate-y-24 bg-white opacity-10 group-hover:-translate-x-8"></span>
                <span class="relative text-lg font-semibold tracking-wider">
                    <i class="fas fa-users mr-3"></i>
                    Lihat Semua Pengguna
                </span>
                <span class="absolute inset-0 w-full h-full border-2 border-white rounded-full"></span>
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="max-w-screen-xl mx-auto px-4 py-8">
            <div class="md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 sm:text-center">© 2023 <a href="/" class="hover:underline">UserPortal</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center md:mt-0">
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <i class="fab fa-facebook"></i>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <i class="fab fa-instagram"></i>
                        <span class="sr-only">Instagram page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <i class="fab fa-twitter"></i>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">
                        <i class="fab fa-github"></i>
                        <span class="sr-only">GitHub account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script for animated blob -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate the blob elements
            const blobs = document.querySelectorAll('.animate-blob');
            blobs.forEach((blob, index) => {
                blob.style.animationDelay = `${index * 2}s`;
            });
        });
    </script>
</body>
</html>