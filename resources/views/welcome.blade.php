<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Inventarios Agrícolas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-100">
    <!-- Navigation -->
    <header class="navbar bg-base-100 border-b border-base-300">
        <div class="container mx-auto px-4">
            <div class="flex-1">
                <a href="/" class="btn btn-ghost text-xl font-bold text-primary">
                    <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    AgroInventory
                </a>
                <div class="flex-1">
                    @if (Route::has('login'))
                        <nav class="flex justify-end gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-success btn">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline btn-primary btn">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary btn">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>

            </div>
    </header>

    <!-- Hero Section -->
    <section class="hero min-h-screen bg-gradient-to-br from-base-100 to-base-200 pt-20">
        <div class="hero-content text-center">
            <div class="max-w-4xl">
                <div data-aos="fade-up" data-aos-duration="800">
                    <h1 class="text-5xl md:text-6xl font-bold text-base-content mb-6">
                        Gestiona tu Inventario Agrícola
                        <span class="text-primary">de Forma Inteligente</span>
                    </h1>
                </div>
                <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <p class="text-lg md:text-xl text-base-content/70 mb-8 max-w-2xl mx-auto">
                        Control total de tus insumos y herramientas agrícolas. Optimiza recursos, reduce pérdidas y
                        aumenta la productividad de tu operación.
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="400"
                    class="flex gap-4 justify-center flex-wrap">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                            Ir al Dashboard
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            Comenzar Ahora
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-base-100">
        <div class="container mx-auto px-4">
            <div data-aos="fade-up" class="text-center mb-16">
                <h2 class="text-4xl font-bold text-base-content mb-4">Características Principales</h2>
                <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                    Todo lo que necesitas para gestionar eficientemente tu inventario agrícola
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div data-aos="fade-up" data-aos-delay="100"
                    class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="card-body">
                        <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Control de Inventario</h3>
                        <p class="text-base-content/70">
                            Registra y monitorea todos tus insumos y herramientas en tiempo real con alertas de stock
                            bajo.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div data-aos="fade-up" data-aos-delay="200"
                    class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="card-body">
                        <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Reportes Detallados</h3>
                        <p class="text-base-content/70">
                            Genera reportes completos sobre uso, costos y disponibilidad de recursos agrícolas.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div data-aos="fade-up" data-aos-delay="300"
                    class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="card-body">
                        <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Historial Completo</h3>
                        <p class="text-base-content/70">
                            Rastrea todas las entradas y salidas con registro detallado de movimientos.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div data-aos="fade-up" data-aos-delay="400"
                    class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="card-body">
                        <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Gestión de Usuarios</h3>
                        <p class="text-base-content/70">
                            Asigna roles y permisos para controlar el acceso a diferentes áreas del sistema.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div data-aos="fade-up" data-aos-delay="500"
                    class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="card-body">
                        <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Alertas Inteligentes</h3>
                        <p class="text-base-content/70">
                            Recibe notificaciones automáticas sobre niveles críticos y fechas de vencimiento.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div data-aos="fade-up" data-aos-delay="600"
                    class="card bg-base-200 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="card-body">
                        <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-base-content">Acceso Móvil</h3>
                        <p class="text-base-content/70">
                            Gestiona tu inventario desde cualquier dispositivo, en cualquier momento y lugar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-20 bg-base-200">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-4xl font-bold text-base-content mb-6">
                        Optimiza tu Operación Agrícola
                    </h2>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-base-content mb-2">Reduce Costos</h3>
                                <p class="text-base-content/70">
                                    Evita compras innecesarias y pérdidas por vencimiento con un control preciso de tu
                                    inventario.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-base-content mb-2">Ahorra Tiempo</h3>
                                <p class="text-base-content/70">
                                    Automatiza procesos manuales y accede a información crítica en segundos.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-base-content mb-2">Toma Mejores Decisiones</h3>
                                <p class="text-base-content/70">
                                    Basa tus decisiones en datos reales y reportes detallados de tu operación.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" class="relative">
                    <div class="bg-base-100 rounded-2xl shadow-2xl p-8">
                        <div class="space-y-4">
                            <div class="stat bg-base-200 rounded-lg">
                                <div class="stat-title text-base-content/70">Insumos Registrados</div>
                                <div class="stat-value text-primary">1,247</div>
                                <div class="stat-desc text-base-content/60">↗︎ 12% más que el mes pasado</div>
                            </div>
                            <div class="stat bg-base-200 rounded-lg">
                                <div class="stat-title text-base-content/70">Herramientas Activas</div>
                                <div class="stat-value text-primary">89</div>
                                <div class="stat-desc text-base-content/60">En perfecto estado</div>
                            </div>
                            <div class="stat bg-base-200 rounded-lg">
                                <div class="stat-title text-base-content/70">Ahorro Mensual</div>
                                <div class="stat-value text-primary">$2,450</div>
                                <div class="stat-desc text-base-content/60">↗︎ 23% de reducción en costos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-primary text-primary-content">
        <div class="container mx-auto px-4 text-center">
            <div data-aos="zoom-in">
                <h2 class="text-4xl font-bold mb-6">
                    ¿Listo para Transformar tu Gestión Agrícola?
                </h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
                    Únete a cientos de agricultores que ya optimizan sus recursos con nuestro sistema.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-lg bg-white text-primary hover:bg-base-100">
                        Crear Cuenta Gratis
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer footer-center p-10 bg-base-200 text-base-content">
        <aside>
            <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="font-bold text-lg">
                AgroInventory
            </p>
            <p class="text-base-content/70">Sistema de Gestión de Inventarios Agrícolas</p>
            <p class="text-base-content/60">© {{ date('Y') }} - Todos los derechos reservados</p>
        </aside>
    </footer>
</body>

</html>
