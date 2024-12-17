<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel de Administración - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

</head>

<body class="bg-gray-100 font-sans">
    <!-- Wrapper principal -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside style="background-color: #4649e7;" class="w-64 bg-blue-800 text-white flex-shrink-0">
            <div class="h-full flex flex-col">
                <div class="p-6 border-b border-blue-700">
                    <h1 class="text-2xl font-bold text-center">Panel de Administración</h1>
                </div>

                <nav class="flex-grow overflow-y-auto mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Productos
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Categorías
                    </a>
                    <a href="{{ route('admin.colors.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Color
                    </a>
                    <a href="{{ route('admin.brands.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Marcas
                    </a>
                    <a href="#" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Usuarios
                    </a>
                    <a href="{{ route('admin.inventory.index') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Inventario
                    </a>
                    <a href="#" class="block px-4 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        Pedidos
                    </a>
                </nav>

                <div class="p-4 border-t border-blue-700">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 text-left bg-blue-700 hover:bg-blue-600 rounded-lg transition-colors">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
            <div class="container mx-auto px-6 py-8">
                <!-- Título de la página -->
                <h2 class="text-3xl font-semibold text-gray-700 mb-6">@yield('title', 'Bienvenido')</h2>

                <!-- Contenido de la página -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <!-- Scripts que se deben incluir -->
    @yield('scripts')
</body>

</html>
