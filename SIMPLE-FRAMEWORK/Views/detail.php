<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - UserPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }
        .profile-header {
            background: linear-gradient(120deg, #4f46e5, #7c3aed);
            border-radius: 0 0 2rem 2rem;
        }
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        }
        .role-badge {
            transition: all 0.2s ease;
        }
        .role-badge:hover {
            transform: scale(1.05);
        }
        .wave-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }
        .wave-bg svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 100px;
        }
        .wave-bg .shape-fill {
            fill: rgba(99, 102, 241, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fas fa-users text-indigo-600 text-xl"></i>
                <span class="self-center text-xl font-bold whitespace-nowrap">UserPortal</span>
            </a>
            <div class="flex items-center space-x-4">
                <a href="/users" class="text-gray-600 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-users mr-1"></i> Users
                </a>
                <a href="/" class="text-gray-600 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <div class="relative">
                    <button id="dropdownUserButton" data-dropdown-toggle="userDropdown" class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-indigo-600 md:mr-0 focus:ring-4 focus:ring-gray-100" type="button">
                        <span class="sr-only">Open user menu</span>
                        <div class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full">
                            <span class="font-medium text-white text-xs">A</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Header -->
    <div class="profile-header relative pt-12 pb-24 mb-40">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center">
                <div class="relative">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-1 rounded-full">
                        <div class="bg-white p-1 rounded-full">
                            <div class="bg-gray-200 border-2 border-dashed rounded-full w-24 h-24 flex items-center justify-center text-indigo-500">
                                <i class="fas fa-user text-4xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="absolute h-8 w-8 -bottom-2 -right-2 flex items-center justify-center bg-green-500 border-2 border-white rounded-full">
                        <i class="fas fa-check text-xs text-white"></i>
                    </div>
                </div>
                <h1 class="mt-6 text-3xl font-bold text-white"><?= $user['username'] ?></h1>
                <div class="mt-2 flex flex-wrap justify-center gap-2">
                    <?php foreach ($user['roles'] as $role): 
                        $colorClass = '';
                        switch(strtolower($role)) {
                            case 'admin': $colorClass = 'bg-red-100 text-red-800'; break;
                            case 'editor': $colorClass = 'bg-blue-100 text-blue-800'; break;
                            case 'viewer': $colorClass = 'bg-green-100 text-green-800'; break;
                            case 'support': $colorClass = 'bg-purple-100 text-purple-800'; break;
                            default: $colorClass = 'bg-gray-100 text-gray-800';
                        }
                    ?>
                    <span class="px-3 py-1 rounded-full text-sm font-medium <?= $colorClass ?> role-badge">
                        <?= $role ?>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="wave-bg">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 -mt-16 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- User Info Card -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">User Information</h3>
                        <p class="text-sm text-gray-600 mt-1">Personal details and account information</p>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-6 py-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">User ID</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-900"><?= $user['id'] ?></p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-6 py-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Username</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-900"><?= $user['username'] ?></p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-6 py-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Email Address</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-900 flex items-center">
                                    <?= $user['email'] ?>
                                    <span class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded">Verified</span>
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-6 py-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Account Status</p>
                            </div>
                            <div class="md:col-span-2">
                                <?php 
                                $statusClass = $user['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                $statusText = $user['is_active'] ? 'Active' : 'Inactive';
                                ?>
                                <span class="px-2.5 py-0.5 rounded text-xs font-medium <?= $statusClass ?>">
                                    <?= $statusText ?>
                                </span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-6 py-4">
                            <div class="md:col-span-1">
                                <p class="text-sm font-medium text-gray-500">Member Since</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium text-gray-900">January 15, 2023</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Card -->
                <div class="bg-white rounded-xl shadow-lg mt-8">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Recent Activity</h3>
                        <p class="text-sm text-gray-600 mt-1">User actions and system interactions</p>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <div class="px-6 py-4">
                            <div class="flex items-start">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <i class="fas fa-file-edit text-indigo-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Updated profile information</p>
                                    <p class="text-sm text-gray-500 mt-1">Changed profile picture and contact details</p>
                                    <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <i class="fas fa-lock text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Changed password</p>
                                    <p class="text-sm text-gray-500 mt-1">Updated account security credentials</p>
                                    <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    <i class="fas fa-download text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Downloaded report</p>
                                    <p class="text-sm text-gray-500 mt-1">Monthly performance report (Q4-2023.pdf)</p>
                                    <p class="text-xs text-gray-400 mt-1">3 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1 space-y-8">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-indigo-600">
                        <h3 class="text-xl font-semibold text-white">Account Status</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-center mb-4">
                            <div class="relative">
                                <div class="w-32 h-32 rounded-full flex items-center justify-center bg-indigo-50 border-8 border-indigo-100">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">87%</div>
                                        <div class="text-xs text-indigo-500">Complete</div>
                                    </div>
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-32 h-32" viewBox="0 0 36 36">
                                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
                                        fill="none" stroke="#e0e7ff" stroke-width="3"/>
                                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
                                        fill="none" stroke="#4f46e5" stroke-width="3" stroke-dasharray="87, 100"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-sm text-gray-700">Email verified</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span class="text-sm text-gray-700">Profile completed</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-exclamation-circle text-yellow-500 mr-2"></i>
                                <span class="text-sm text-gray-700">Two-factor authentication</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-exclamation-circle text-yellow-500 mr-2"></i>
                                <span class="text-sm text-gray-700">Security questions</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <button class="w-full flex items-center justify-between px-4 py-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <div class="flex items-center">
                                <div class="bg-indigo-100 p-2 rounded-lg">
                                    <i class="fas fa-envelope text-indigo-600"></i>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Send Message</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </button>
                        <button class="w-full flex items-center justify-between px-4 py-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <i class="fas fa-user-edit text-green-600"></i>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Edit Profile</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </button>
                        <button class="w-full flex items-center justify-between px-4 py-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <div class="flex items-center">
                                <div class="bg-red-100 p-2 rounded-lg">
                                    <i class="fas fa-user-lock text-red-600"></i>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Disable Account</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </button>
                        <button class="w-full flex items-center justify-between px-4 py-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors">
                            <div class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-lg">
                                    <i class="fas fa-file-export text-purple-600"></i>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Export Data</span>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </button>
                    </div>
                </div>

                <!-- Security Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Security Status</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-700">Password Strength</span>
                            <span class="text-sm font-medium text-green-600">Strong</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 90%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-700">Login Activity</span>
                            <span class="text-sm font-medium text-blue-600">Active</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-700">Device Security</span>
                            <span class="text-sm font-medium text-yellow-600">Medium</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 50%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="/users" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-arrow-left mr-2"></i> Back to Users List
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-screen-xl mx-auto px-4 py-6">
            <div class="md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 sm:text-center">© 2023 <a href="/" class="hover:underline">UserPortal</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-gray-900">
                        <i class="fab fa-facebook"></i>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900">
                        <i class="fab fa-twitter"></i>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-900">
                        <i class="fab fa-github"></i>
                        <span class="sr-only">GitHub account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to role badges
            const roleBadges = document.querySelectorAll('.role-badge');
            roleBadges.forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.classList.add('shadow-md');
                });
                badge.addEventListener('mouseleave', function() {
                    this.classList.remove('shadow-md');
                });
            });
        });
    </script>
</body>
</html>