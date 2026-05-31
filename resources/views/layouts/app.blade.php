<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PartyFinder')</title>

    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 (optional, can use Tailwind) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --color-primary: #6366f1;
            --color-secondary: #10b981;
            --color-accent: #f59e0b;
            --color-danger: #ef4444;
            
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-input: rgba(30, 41, 59, 0.6);
            
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            
            --border-color: rgba(148, 163, 184, 0.15);
            --border-color-light: rgba(148, 163, 184, 0.25);
            
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.15);
            --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.2);
            
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 18px;
            
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--bg-primary) 0%, #1a1f35 50%, var(--bg-primary) 100%);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ========================
           NAVIGATION
           ======================== */
        .navbar {
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.8) 0%, rgba(15, 23, 42, 0.4) 100%);
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #6366f1 0%, #10b981 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-decoration: none;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            filter: brightness(1.1);
        }

        .nav-search {
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 0.5rem 1rem;
            color: var(--text-primary);
            flex-grow: 1;
            max-width: 400px;
            transition: var(--transition);
        }

        .nav-search:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: var(--bg-input);
        }

        .nav-search::placeholder {
            color: var(--text-muted);
        }

        .btn-nav {
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            border: none;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-nav-primary {
            background: var(--color-primary);
            color: white;
        }

        .btn-nav-primary:hover {
            background: #5558e3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-nav-secondary {
            background: transparent;
            border: 1px solid var(--border-color-light);
            color: var(--text-primary);
        }

        .btn-nav-secondary:hover {
            background: var(--bg-tertiary);
            border-color: var(--border-color);
        }

        /* ========================
           HERO SECTION
           ======================== */
        .hero {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-color);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%),
                        linear-gradient(180deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
            padding: 3rem 2rem;
            margin: 1.5rem 0;
            backdrop-filter: blur(10px);
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: -50%;
            background: radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%);
            animation: float 6s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -20px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .hero-title .gradient-text {
            background: linear-gradient(135deg, #6366f1 0%, #10b981 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-subtitle {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.6;
            max-width: 50ch;
            margin-bottom: 2rem;
        }

        /* ========================
           FILTER BAR
           ======================== */
        .filter-bar {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .form-select, .form-control {
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.625rem 0.875rem;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 0.875rem;
            transition: var(--transition);
        }

        .form-select:focus, .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: var(--bg-input);
            color: var(--text-primary);
        }

        .form-select option {
            background: var(--bg-secondary);
            color: var(--text-primary);
        }

        /* ========================
           BUTTONS
           ======================== */
        .btn-primary {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: #5558e3;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border-color-light);
            color: var(--text-primary);
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-secondary:hover {
            background: var(--bg-tertiary);
            border-color: var(--color-primary);
            color: var(--color-primary);
        }

        .btn-success {
            background: var(--color-secondary);
            color: white;
            border: none;
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
        }

        .btn-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid var(--border-color-light);
            background: transparent;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-icon:hover {
            background: var(--bg-tertiary);
            border-color: var(--color-primary);
            color: var(--color-primary);
        }

        /* ========================
           CARDS
           ======================== */
        .card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: var(--color-primary);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
        }

        .card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--bg-tertiary) 0%, var(--bg-secondary) 100%);
        }

        .card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            line-height: 1.3;
        }

        .card-badge {
            display: inline-block;
            background: var(--color-accent);
            color: var(--bg-primary);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.375rem 0.625rem;
            border-radius: 0.375rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .card-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .card-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-meta-item i {
            color: var(--color-primary);
            flex-shrink: 0;
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: auto;
        }

        .card-actions .btn {
            flex: 1;
            text-align: center;
            text-decoration: none;
        }

        /* ========================
           SIDEBAR
           ======================== */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .sidebar-panel {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
        }

        .sidebar-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-divider {
            height: 1px;
            background: var(--border-color);
            margin: 1rem 0;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--color-primary);
            border-radius: 4px;
        }

        .checkbox-item label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            cursor: pointer;
            flex: 1;
            margin: 0;
        }

        .checkbox-item input[type="checkbox"]:checked + label {
            color: var(--color-primary);
            font-weight: 500;
        }

        /* ========================
           SLIDER
           ======================== */
        .slider {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: var(--bg-tertiary);
            outline: none;
            -webkit-appearance: none;
            appearance: none;
            cursor: pointer;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--color-primary);
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .slider::-webkit-slider-thumb:hover {
            box-shadow: 0 0 0 5px rgba(99, 102, 241, 0.2);
        }

        .slider::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--color-primary);
            cursor: pointer;
            border: none;
            transition: var(--transition);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .slider::-moz-range-thumb:hover {
            box-shadow: 0 0 0 5px rgba(99, 102, 241, 0.2);
        }

        /* ========================
           FOOTER
           ======================== */
        footer {
            border-top: 1px solid var(--border-color);
            background: rgba(15, 23, 42, 0.5);
            padding: 2rem 0;
            margin-top: 4rem;
        }

        footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        footer a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            transition: var(--transition);
        }

        footer a:hover {
            color: var(--color-primary);
        }

        /* ========================
           RESPONSIVE
           ======================== */
        @media (max-width: 768px) {
            .hero {
                padding: 2rem 1rem;
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .filter-bar {
                grid-template-columns: 1fr;
            }

            .sidebar {
                order: -1;
            }

            .card-image {
                height: 160px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    @include('profile.partials.navbar')

    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('profile.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>