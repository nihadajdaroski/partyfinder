<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <style>
        :root {
            --color-primary: #6366f1;
            --color-secondary: #10b981;
            --color-accent: #f59e0b;

            --bg-primary: #0f172a;
            --bg-secondary: #111827;
            --bg-glass: rgba(255, 255, 255, 0.05);

            --text-primary: #f1f5f9;
            --text-muted: rgba(241, 245, 249, 0.6);

            --radius: 16px;
        }

        /* PAGE LAYOUT */
        .auth-page {
            min-height: 100vh;
            display: flex;
            background: radial-gradient(circle at top, #1e1b4b 0%, var(--bg-primary) 60%);
        }

        /* LEFT SIDE (branding) */
        .auth-left {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: var(--text-primary);
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .brand-title span {
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* RIGHT SIDE (form) */
        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* CARD */
        .auth-card {
            width: 100%;
            max-width: 420px;
            background: var(--bg-glass);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border-radius: var(--radius);
            padding: 2rem;
            color: var(--text-primary);
        }

        /* INPUTS */
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
            color: white;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        /* BUTTONS */
        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        /* SOCIAL BUTTONS */
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 0.5rem;
            color: white;
            text-decoration: none;
            transition: 0.2s;
        }

        .social-btn:hover {
            background: rgba(255,255,255,0.05);
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .auth-page {
                flex-direction: column;
            }

            .auth-left {
                display: none;
            }

            .auth-right {
                padding: 1rem;
            }
        }
        </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="auth-page">

    <div class="auth-left">
        <h1 class="brand-title">
            PartyFinder <span>noči</span>
        </h1>
        <p>Odkrij dogodke, zabave in koncerte v tvojem mestu.</p>
    </div>

    <div class="auth-right">
        @yield('content')
    </div>

</body>
</html>