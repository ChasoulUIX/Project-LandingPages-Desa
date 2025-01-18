<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-600 min-h-screen p-4">
            <div class="flex items-center mb-8">
                <img src="{{ asset('images/avatar.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full mr-3">
                <div class="text-white">
                    <p class="font-semibold">Admin</p>
                    <p class="text-sm text-blue-200">Administrator</p>
                </div>
            </div>
            <nav>
                <a href="#" class="block text-white py-2 px-4 rounded bg-blue-700 mb-2 flex items-center">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="#" class="block text-blue-200 hover:bg-blue-700 py-2 px-4 rounded mb-2 flex items-center">
                    <i class="fas fa-box mr-2"></i>Products
                </a>
                <a href="#" class="block text-blue-200 hover:bg-blue-700 py-2 px-4 rounded mb-2 flex items-center">
                    <i class="fas fa-users mr-2"></i>Users
                </a>
                <a href="#" class="block text-blue-200 hover:bg-blue-700 py-2 px-4 rounded mb-2 flex items-center">
                    <i class="fas fa-chart-line mr-2"></i>Analytics
                </a>
                <a href="#" class="block text-blue-200 hover:bg-blue-700 py-2 px-4 rounded mb-2 flex items-center">
                    <i class="fas fa-cog mr-2"></i>Settings
                </a>
                <a href="#" class="block text-blue-200 hover:bg-blue-700 py-2 px-4 rounded mb-2 flex items-center mt-auto">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <button class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
                        <i class="fas fa-bell text-gray-600"></i>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6 mb-8">
                <!-- Total Visits Card -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm">Total Visits</h3>
                        <div class="p-2 bg-blue-100 rounded-full">
                            <i class="fas fa-eye text-blue-600"></i>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-gray-800">45,678</span>
                        <span class="text-green-500 ml-2 text-sm flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i>+8.3%
                        </span>
                    </div>
                    <div class="text-gray-400 text-sm mt-2">Compared to last week</div>
                </div>

                <!-- New Users Card -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm">New Users</h3>
                        <div class="p-2 bg-green-100 rounded-full">
                            <i class="fas fa-user-plus text-green-600"></i>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="text-3xl font-bold text-gray-800">5,342</span>
                        <span class="text-green-500 ml-2 text-sm flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i>+12.5%
                        </span>
                    </div>
                    <div class="text-gray-400 text-sm mt-2">Compared to last week</div>
                </div>

                <!-- Traffic Share Card -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm">Traffic Share</h3>
                        <div class="p-2 bg-purple-100 rounded-full">
                            <i class="fas fa-chart-pie text-purple-600"></i>
                        </div>
                    </div>
                    <canvas id="trafficShareChart" class="mt-2"></canvas>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Traffic Sources Chart -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm">Traffic Sources</h3>
                        <select class="text-sm border rounded-md px-2 py-1">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                        </select>
                    </div>
                    <canvas id="trafficSourcesChart"></canvas>
                </div>

                <!-- Monthly Visits Chart -->
