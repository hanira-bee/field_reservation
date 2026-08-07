<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN SPORT CENTER</title>

    <!-- link icon dan font -->
    <link rel="icon" type="image/png" href="/images/volleyball-solid.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Stack+Sans+Notch:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen text-gray-800 antialiased">
    <div class="min-h-screen flex"> 
        
        <!-- /* ------------------- ASIDE (SIDEBAR SEMI-PERMANEN) ------------------- */ --> 
        <!-- md:translate-x-0 mengunci posisi menetap di layar besar, -translate-x-full bersembunyi di HP -->
        <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-red-600 shadow-xl md:shadow-none border-r border-gray-200 z-50 transition-transform duration-300 -translate-x-full md:translate-x-0 flex flex-col justify-between"> 
            <div>
                <!-- Brand Title Sidebar -->
                <div class="px-6 pt-6 flex items-center gap-2 mb-8"> 
                    <span class="font-stack font-black text-white text-base sm:text-lg lg:text-xl tracking-wider uppercase">SM ADMIN</span> 
                </div> 
                
                @php 
                    $activeClass = 'bg-red-50 text-red-700 font-bold'; 
                    $normalClass = 'text-white hover:bg-gray-50 hover:text-red-600 font-semibold transition-all duration-150'; 
                @endphp 
                
                <!-- Kumpulan Menu Manajemen / Tools Kepengurusan -->
                <nav class="px-3 space-y-1 text-sm"> 
                    <!-- Menu 1: Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? $activeClass : $normalClass }}"> 
                        <span class="material-icons text-xl">dashboard</span>
                        <span>Dashboard</span> 
                    </a> 
                    <!-- Menu 2: Kelola Reservasi -->
                    <a href="{{ route('admin.reservasi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.reservasi*') ? $activeClass : $normalClass }}"> 
                        <span class="material-icons text-xl">calendar_month</span>
                        <span>Kelola Reservasi</span> 
                    </a> 
                    <!-- Menu 3: Kelola Lapangan -->
                    <a href="{{ route('admin.lapangan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.lapangan*') ? $activeClass : $normalClass }}"> 
                        <span class="material-icons text-xl">sports_soccer</span>
                        <span>Kelola Lapangan</span> 
                    </a> 
                    <!-- Menu 4: Kelola Akun -->
                    <a href="{{ route('admin.akun.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.akun*') ? $activeClass : $normalClass }}"> 
                        <span class="material-icons text-xl">manage_accounts</span>
                        <span>Kelola Akun</span> 
                    </a> 
                    <!-- Menu 5: Laporan Laba -->
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.laporan*') ? $activeClass : $normalClass }}"> 
                        <span class="material-icons text-xl">payments</span>
                        <span>Laporan Keuangan</span> 
                    </a> 
                </nav> 
            </div>

            <!-- Identitas Akun Login Dasar Sidebar -->
            <div class="p-4 border-t border-gray-100 bg-red-50">
                <div class="flex items-center justify-between">
                    <div class="truncate max-w-[130px]">
                        <p class="text-xs font-black text-red-600 truncate leading-none mb-1">{{ Auth::user()->name ?? 'Admin User' }}</p>
                        <span class="text-[9px] font-black text-red-500 uppercase tracking-widest block">{{ Auth::user()->role ?? 'ADMIN' }}</span>
                    </div>
                    <!-- Form Logout POST -->
                    <form method="POST" action="{{ route('logout') }}" class="inline"> 
                        @csrf 
                        <button type="submit" class="text-red-500 hover:text-red-600 p-1 flex items-center transition" title="Keluar"> 
                            <span class="material-icons text-lg">logout</span> 
                        </button> 
                    </form> 
                </div>
            </div>
        </aside> 

        <!-- /* ----------------------------- OVERLAY BACKGROUND MOBILE ----------------------------- */ --> 
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300 md:hidden"></div> 

        <!-- /* ------------------------------- AREA UTAMA KONTEN (SISI KANAN) ------------------------------- */ --> 
        <!-- md:pl-64 menggeser margin kiri otomatis hanya saat layar besar mengikuti sidebar -->
        <main class="flex-1 flex flex-col min-h-screen relative z-10 w-full md:pl-64 pt-16"> 
            
            <!-- /* --------------------------------- HEADER BAR ATAS --------------------------------- */ --> 
            <!-- left-0 pada HP dan md:left-64 pada layar lebar agar presisi -->
            <header class="w-full h-16 bg-white fixed top-0 left-0 md:left-64 right-0 z-30 shadow-xs border-b border-gray-100 flex items-center justify-between px-4 sm:px-8"> 
                <!-- Tombol Burger Menu khusus Layar Handphone --> 
                <div class="flex items-center gap-2"> 
                    <button class="p-1.5 text-red-600 hover:bg-gray-100 rounded-lg md:hidden flex items-center justify-center" onclick="toggleSidebar()"> 
                        <i class="fas fa-bars text-base"></i> 
                    </button> 
                    <!-- Penunjuk Jalur Posisi Halaman -->
                    <div class="flex items-center gap-1.5 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <span>Sistem Admin</span>
                        <span>/</span>
                        <span class="text-red-600 font-black">@yield('page_title', 'Ringkasan Data')</span>
                    </div>
                </div> 

                <!-- Profil Singkat / Status Pojok Kanan Header --> 
                <div class="text-xs font-semibold text-gray-400 flex items-center gap-1.5"> 
                    <span class="w-2 h-2 bg-emerald-500 rounded-full inline-block animate-pulse"></span> Server Active
                </div> 
            </header> 

            <!-- KONTEN INTI VIEW TEMPLATE --> 
            <div class="w-full flex-1 p-4 sm:p-8 bg-white mt-4"> 
                @yield('content') 
            </div> 

        </main> 
    </div> 

    <!-- /* ------------------------------- JAVASCRIPT SIDEBAR MOBILE OVERRIDE ------------------------------- */ --> 
    <script> 
        function toggleSidebar() { 
            const sidebar = document.getElementById('sidebar'); 
            const overlay = document.getElementById('overlay'); 
            sidebar.classList.toggle('-translate-x-full'); 
            overlay.classList.toggle('hidden'); 
        } 
    </script> 
</body>

</html>