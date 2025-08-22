<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
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
        .user-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        }
        .role-badge {
            transition: all 0.2s ease;
        }
        .role-badge:hover {
            transform: scale(1.05);
        }
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fas fa-users text-blue-600 text-xl"></i>
                <span class="self-center text-xl font-bold whitespace-nowrap">UserPortal</span>
            </a>
            <div class="flex items-center space-x-4">
                <a href="/" class="text-gray-600 hover:text-blue-600 transition-colors">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <div class="relative">
                    <button id="dropdownUserButton" data-dropdown-toggle="userDropdown" class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 md:mr-0 focus:ring-4 focus:ring-gray-100" type="button">
                        <span class="sr-only">Open user menu</span>
                        <div class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gradient-to-r from-blue-500 to-purple-500 rounded-full">
                            <span class="font-medium text-white text-xs">A</span>
                        </div>
                        <i class="fas fa-chevron-down ml-2 text-xs text-gray-500"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium">Admin User</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownUserButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fas fa-user-circle mr-2"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2"></i> Settings
                                </a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Sign out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
                <p class="text-gray-600">Manage all users in the system</p>
            </div>
            <div class="flex space-x-3">
                <button type="button" class="text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add New User
                </button>
                <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-5 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Users</p>
                        <p class="text-2xl font-bold mt-1"><?= count($getAllUsers) ?></p>
                    </div>
                    <div class="bg-blue-400 p-3 rounded-lg">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm flex items-center">
                    <span class="bg-blue-400 px-2 py-1 rounded mr-2">+12%</span>
                    <span>from last month</span>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-5 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Active Today</p>
                        <p class="text-2xl font-bold mt-1">
                            <?= 
                                count(array_filter($getAllUsers, function($user) {
                                    return $user['is_active'] === true;
                                })) 
                            ?>
                        </p>
                    </div>
                    <div class="bg-purple-400 p-3 rounded-lg">
                        <i class="fas fa-user-check text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm flex items-center">
                    <span class="bg-purple-400 px-2 py-1 rounded mr-2">+8%</span>
                    <span>from yesterday</span>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-5 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Admins</p>
                        <p class="text-2xl font-bold mt-1">
                            <?= 
                                count(array_filter($getAllUsers, function($user) {
                                    return in_array('admin', $user['roles']);
                                })) 
                            ?>
                        </p>
                    </div>
                    <div class="bg-green-400 p-3 rounded-lg">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span>Managing the system</span>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl shadow-lg p-5 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">New Users</p>
                        <p class="text-2xl font-bold mt-1">7</p>
                    </div>
                    <div class="bg-amber-400 p-3 rounded-lg">
                        <i class="fas fa-user-plus text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span>this week</span>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="relative w-full md:w-64 mb-4 md:mb-0">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search-users" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search users...">
                </div>
                <div class="flex space-x-3">
                    <select id="roles" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="viewer">Viewer</option>
                        <option value="guest">Guest</option>
                    </select>
                    <select id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Users List -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b">
                <div class="col-span-4">User</div>
                <div class="col-span-3">Roles</div>
                <div class="col-span-3">Status</div>
                <div class="col-span-2 text-right">Actions</div>
            </div>

            <!-- User Items -->
            <div class="divide-y divide-gray-100">
                <?php foreach($getAllUsers as $users) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="md:col-span-4 flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                <?= $users['initials'] ?>
                            </div>
                            <div>
                                <a href="/detail/user/<?= $users['slug'] ?>/<?= $users['id'] ?>" class="font-medium text-gray-900 hover:text-blue-600"><?= $users['username'] ?></a>
                                <div class="text-sm text-gray-500"><?= $users['email'] ?></div>
                            </div>
                        </div>
                        <div class="md:col-span-3 flex flex-wrap gap-2 items-center">
                            <?php foreach($users['roles'] as $role) : ?>
                                <?php if($role === 'admin') : ?>
                                    <span class="bg-green-400 text-white text-xs font-medium px-2.5 py-0.5 rounded role-badge"><?= $role ?></span>
                                <?php elseif($role === 'editor') : ?>
                                        <span class="bg-blue-400 text-white text-xs font-medium px-2.5 py-0.5 rounded role-badge"><?= $role ?></span>
                                <?php elseif($role === 'viewer') : ?>
                                        <span class="bg-red-400 text-white text-xs font-medium px-2.5 py-0.5 rounded role-badge"><?= $role ?></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="md:col-span-3 flex items-center">
                            <?php if($users['is_active'] === true) : ?>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded">
                                    <i class="fas fa-circle text-[8px] mr-1"></i> Active
                                </span>
                            <?php else : ?>
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded">
                                    <i class="fas fa-circle text-[8px] mr-1"></i> Offline
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="md:col-span-2 flex justify-end space-x-2">
                            <button class="text-blue-600 hover:text-blue-800 p-1.5 rounded-full hover:bg-blue-50">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 p-1.5 rounded-full hover:bg-red-50">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-sm text-gray-700 mb-4 md:mb-0">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">142</span> results
                    </div>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-blue-600 rounded-l hover:bg-blue-700">
                            <i class="fas fa-arrow-left mr-2 text-xs"></i> Prev
                        </button>
                        <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-blue-600 border-0 border-l border-blue-700 rounded-r hover:bg-blue-700">
                            Next <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-8 text-center">
            <a href="/" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Back to Home
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
        // Simulate loading for demo purposes
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to stats cards
            const statsCards = document.querySelectorAll('.bg-gradient-to-r');
            statsCards.forEach(card => {
                card.classList.add('animate-pulse-slow');
            });
            
            // Add hover effect to user items
            const userItems = document.querySelectorAll('.grid.grid-cols-1');
            userItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.classList.add('bg-blue-50');
                });
                item.addEventListener('mouseleave', function() {
                    this.classList.remove('bg-blue-50');
                });
            });
        });
    </script>
</body>
</html>