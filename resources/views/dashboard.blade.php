<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AgroInventory') }} - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200">
    <div class="drawer lg:drawer-open">
        <!-- Checkbox para toggle del drawer en mobile -->
        <input id="main-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Contenido principal -->
        <div class="drawer-content flex flex-col">
            <!-- Header/Navbar -->
            <header class="navbar bg-base-100 shadow-md sticky top-0 z-40">
                <div class="flex-none lg:hidden">
                    <label for="main-drawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current text-gray-700">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                
                <div class="flex-1 px-4">
                    <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
                </div>
                
                <!-- User Profile -->
                <div class="flex-none">
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar placeholder">
                            <div class="bg-green-600 text-white rounded-full w-10">
                                <span class="text-lg font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow-lg bg-base-100 rounded-box w-52">
                            <li class="menu-title">
                                <span class="text-gray-800 font-semibold">{{ Auth::user()->name }}</span>
                            </li>
                            <li><a class="text-gray-600">Perfil</a></li>
                            <li><a class="text-gray-600">Configuración</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="footer footer-center p-4 bg-base-100 text-base-content border-t">
                <aside>
                    <p class="text-sm text-gray-600">© {{ date('Y') }} AgroInventory - Sistema de Gestión Agrícola</p>
                </aside>
            </footer>
        </div>

        <!-- Sidebar -->
        <div class="drawer-side z-50">
            <label for="main-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            
            <aside class="bg-base-100 min-h-full w-72 shadow-xl">
                <!-- Logo/Brand -->
                <div class="sticky top-0 z-20 bg-base-100 border-b border-base-300 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">AgroInventory</h2>
                            <p class="text-xs text-gray-500">Sistema de Gestión</p>
                        </div>
                    </div>
                </div>

                <!-- User Info Card -->
                <div class="px-4 py-4">
                    <div class="card bg-green-50 border border-green-200">
                        <div class="card-body p-4">
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-600 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="px-4 py-2">
                    <ul class="menu menu-lg gap-1">
                        @include('menu.home');
                        
                        @include('menu.herramientas');

                        @include('menu.productos');

                        @include('menu.inventario');

                        @include('menu.logout');
                    </ul>
                </nav>
            </aside>
        </div>
    </div>
</body>
</html>
