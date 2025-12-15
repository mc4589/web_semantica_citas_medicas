 <!-- Carga global de CSS y JS con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Header único con navegación -->
    <header class="custom-header">
        <h1>@yield('header-title', 'Web Semántica - Clínica Médica')</h1>
        <p>@yield('header-subtitle', 'Sistema de Gestión de Citas con Datos Estructurados JSON-LD')</p>

        <!-- Menú de navegación -->
        <nav style="margin-top: 20px;">
            <a href="{{ url('/citas-web') }}" class="action-link" style="color: white; margin: 0 15px; font-size: 1.1em;">Citas</a>
            <a href="{{ url('/medicos-web') }}" class="action-link" style="color: white; margin: 0 15px; font-size: 1.1em;">Médicos</a>
            <a href="{{ url('/pacientes-web') }}" class="action-link" style="color: white; margin: 0 15px; font-size: 1.1em;">Pacientes</a>
            <a href="{{ url('/especialidades-web') }}" class="action-link" style="color: white; margin: 0 15px; font-size: 1.1em;">Especialidades</a>
        </nav>
    </header>

    <!-- Contenido principal -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer style="background: #343a40; color: #fff; padding: 20px; text-align: center; margin-top: 80px; font-size: 0.9em;">
        <p>Grupo 4 © 2025</p>
    </footer>
</body>
</html>
