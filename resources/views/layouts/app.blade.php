<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sekolah - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        /* Background gradient soft blue ke soft blue muda */
        body {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Sidebar styling dengan gradient soft blue */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #b8e1fc 0%, #d4eefd 100%);
            box-shadow: 2px 0 15px rgba(0,0,0,0.08);
        }
        
        .sidebar a {
            color: #2d3748;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            font-weight: 500;
        }
        
        .sidebar a:hover {
            background: rgba(255,255,255,0.5);
            padding-left: 30px;
            color: #1a202c;
            border-left-color: #b8e1fc;
        }
        
        .sidebar a.active {
            background: rgba(255,255,255,0.4);
            color: #1a202c;
            border-left-color: #b8e1fc;
            font-weight: 600;
        }
        
        .sidebar h4 {
            color: #2d3748;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .sidebar hr {
            border-color: rgba(0,0,0,0.1);
        }
        
        /* Card styling */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            background: rgba(255,255,255,0.95);
            position: relative;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }
        
        .card-header {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border-radius: 20px 20px 0 0 !important;
            border: none;
            padding: 15px 20px;
            font-weight: bold;
            color: #2d3748;
        }
        
        /* Table styling */
        .table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            color: #2d3748;
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        
        .table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }
        
        .table tbody tr:last-child {
            border-bottom: none;
        }
        
        .table tbody tr:hover {
            background: #f0f8ff;
        }
        
        /* Button styling */
        .btn-primary {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border: none;
            border-radius: 12px;
            padding: 8px 20px;
            transition: all 0.3s;
            font-weight: 500;
            color: #2d3748;
        }
        
        .btn-primary:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #a0d4f0 0%, #c0e0f5 100%);
            box-shadow: 0 5px 15px rgba(184, 225, 252, 0.4);
            color: #1a202c;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border: none;
            border-radius: 12px;
            color: #2d3748;
            font-weight: 500;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #a0d4f0 0%, #c0e0f5 100%);
            transform: scale(1.05);
            color: #1a202c;
        }
        
        .btn-warning {
            border-radius: 12px;
            background: linear-gradient(135deg, #ffdd80ff 0%, #f5fdd4ff 100%);
            border: none;
            color: #2d3748;
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #ffd76aff 0%, #f0ffb5ff 100%);
            transform: scale(1.05);
        }
        
        .btn-danger {
            border-radius: 12px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            border: none;
            color: #2d3748;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #ff7e82 0%, #fdb8e8 100%);
        }
        
        .btn-info {
            background: linear-gradient(135deg, #a0d9ffff 0%, #d4eefd 100%);
            border: none;
            color: #2d3748;
        }
        
        /* Alert styling */
        .alert-success {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border: 1px solid #b8e1fc;
            border-radius: 12px;
            color: #2d6a4f;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #ffd6e0 0%, #ffe0e8 100%);
            border: 1px solid #fed6e3;
            border-radius: 12px;
            color: #c62828;
        }
        
        .alert-info {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border: 1px solid #b8e1fc;
            border-radius: 12px;
        }
        
        /* Main content area */
        .main-content {
            background: rgba(255,255,255,0.88);
            border-radius: 25px;
            margin: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            backdrop-filter: blur(2px);
            border: 1px solid rgba(184, 225, 252, 0.5);
        }
        
        /* Badge styling */
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .badge-primary {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            color: #2d3748;
        }
        
        .badge-success {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            color: #2d3748;
        }
        
        .badge-info {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            color: #2d3748;
        }
        
        .badge-warning {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            color: #2d3748;
        }
        
        /* Form control styling dengan border gradient */
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid transparent;
            background: white;
            padding: 10px 15px;
            transition: all 0.3s;
            background-image: linear-gradient(white, white), linear-gradient(135deg, #b8e1fc, #d4eefd);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }
        
        .form-control:focus, .form-select:focus {
            border: 2px solid transparent;
            outline: none;
            box-shadow: 0 0 0 3px rgba(184, 225, 252, 0.3);
            background-image: linear-gradient(white, white), linear-gradient(135deg, #b8e1fc, #d4eefd);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: linear-gradient(180deg, #b8e1fc 0%, #d4eefd 100%);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border-radius: 10px;
            border: 2px solid rgba(184, 225, 252, 0.5);
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #a0d4f0 0%, #c0e0f5 100%);
        }
        
        /* Link styling */
        a {
            color: #b8e1fc;
            transition: color 0.3s;
            font-weight: 500;
        }
        
        a:hover {
            color: #d4eefd;
        }
        
        /* Modal styling */
        .modal-content {
            border: 2px solid transparent;
            border-radius: 20px;
            background-image: linear-gradient(white, white), linear-gradient(135deg, #b8e1fc, #d4eefd);
            background-origin: border-box;
            background-clip: padding-box, border-box;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border-radius: 18px 18px 0 0;
            border: none;
        }
        
        /* Pagination */
        .pagination .page-link {
            border: 1px solid #b8e1fc;
            color: #b8e1fc;
            transition: all 0.3s;
        }
        
        .pagination .page-link:hover {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            color: #2d3748;
            border-color: #d4eefd;
        }
        
        .pagination .active .page-link {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border-color: #b8e1fc;
            color: #2d3748;
        }
        
        /* Dropdown */
        .dropdown-menu {
            border: 2px solid transparent;
            border-radius: 15px;
            background-image: linear-gradient(white, white), linear-gradient(135deg, #b8e1fc, #d4eefd);
            background-origin: border-box;
            background-clip: padding-box, border-box;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
        }
        
        /* Nav tabs */
        .nav-tabs .nav-link {
            border: 1px solid #b8e1fc;
            border-radius: 12px 12px 0 0;
            color: #b8e1fc;
        }
        
        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border-color: #b8e1fc #b8e1fc white;
            color: #2d3748;
        }
        
        /* Progress bar */
        .progress {
            border-radius: 10px;
            background: #e2e8f0;
        }
        
        .progress-bar {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%);
            border-radius: 10px;
            color: #2d3748;
        }
        
        /* Card stats background */
        .bg-primary {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%) !important;
        }
        
        .bg-success {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%) !important;
        }
        
        .bg-info {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%) !important;
        }
        
        .bg-warning {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%) !important;
        }
        
        .bg-danger {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%) !important;
        }
        
        .bg-secondary {
            background: linear-gradient(135deg, #b8e1fc 0%, #d4eefd 100%) !important;
        }
        
        /* Text color untuk card stats */
        .card-stats.text-white {
            color: #2d3748 !important;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <div class="text-center py-4">
                    <h4 class="text-dark">🏫 SISTEM SEKOLAH</h4>
                    <hr class="bg-secondary">
                </div>
                <nav>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('kelas.index') }}" class="{{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                        <i class="bi bi-building"></i> Kelas
                    </a>
                    <a href="{{ route('guru.index') }}" class="{{ request()->routeIs('guru.*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i> Guru
                    </a>
                    <a href="{{ route('mata-pelajaran.index') }}" class="{{ request()->routeIs('mata-pelajaran.*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i> Mata Pelajaran
                    </a>
                    <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Siswa
                    </a>
                    <hr class="bg-secondary">
                    <a href="{{ route('siswa-mapel.index') }}" class="{{ request()->routeIs('siswa-mapel.*') ? 'active' : '' }}">
                        <i class="bi bi-link"></i> 📋 Pendaftaran Mapel
                    </a>
                    <a href="{{ route('nilai.index') }}" class="{{ request()->routeIs('nilai.*') ? 'active' : '' }}">
                        <i class="bi bi-graph-up"></i> Nilai
                    </a>
                    <hr class="bg-secondary">
                    <a href="{{ route('akun-pengguna.index') }}" class="{{ request()->routeIs('akun-pengguna.*') ? 'active' : '' }}">
                        <i class="bi bi-key"></i> Akun Pengguna
                    </a>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-3">
                <div class="main-content">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>