<!DOCTYPE html>
<html class="h-full bg-gray-100" x-data="{
          sidebarOpen: localStorage.getItem('sidebar_open') !== null ? localStorage.getItem('sidebar_open') === 'true' : true,
          dropdownOpen: {{ request()->routeIs('admin.category.*') || request()->routeIs('admin.course.*') ? 'true' : 'false' }},
          userOpen: false,

          toggleSidebar() {
              this.sidebarOpen = !this.sidebarOpen;
              localStorage.setItem('sidebar_open', this.sidebarOpen);

              // Sync ke server
              fetch('{{ route('sidebar.toggle') }}', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  },
                  body: JSON.stringify({ open: this.sidebarOpen })
              });
          }
      }" lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1d34baef3f.js" crossorigin="anonymous"></script>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar-transition {
            transition: width 0.25s ease-in-out, margin-left 0.25s ease-in-out;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full flex bg-gray-100" x-cloak>
    @include('components.navigation.admin')
    <div class="flex-1 flex flex-col min-h-screen sidebar-transition transition-all duration-300 ease-in-out" :class="sidebarOpen ? 'ml-64' : 'ml-20'">

        <!-- NAVBAR -->
        <header class="flex items-center justify-between px-6 py-4 relative z-30">
            <button @click="toggleSidebar()" class="text-gray-700 text-xl focus:outline-none">
                <i class="fa-solid fa-bars" style="color: #000000;"></i>
            </button>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>

</html>
