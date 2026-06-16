<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello World - Setup Laravel & Docker</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Plus+Jakarta+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #030014;
            --card-bg: rgba(255, 255, 255, 0.03);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --primary-glow: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(168, 85, 247, 0.15) 50%, transparent 100%);
            --accent-gradient: linear-gradient(135deg, #818cf8 0%, #c084fc 50%, #f472b6 100%);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            padding: 2rem 1rem;
        }

        /* Ambient Glow Backgrounds */
        .glow-1 {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, transparent 70%);
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .glow-2 {
            position: absolute;
            bottom: -10%;
            right: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(244, 114, 182, 0.15) 0%, transparent 70%);
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .container {
            max-width: 800px;
            width: 100%;
            z-index: 10;
            position: relative;
        }

        /* Glassmorphic Card */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.15);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-gradient);
        }

        /* Hello World Styling */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #a5b4fc;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 2rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background-color: #818cf8;
            border-radius: 50%;
            box-shadow: 0 0 8px #818cf8;
            animation: pulse 2s infinite;
        }

        h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: text-shine 5s linear infinite;
            background-size: 200% auto;
        }

        p.subtitle {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            font-weight: 300;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Status Grid */
        .status-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            text-align: left;
            margin-bottom: 2.5rem;
        }

        @media (min-width: 640px) {
            .status-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .status-item {
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .status-item:hover {
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .status-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: rgba(99, 102, 241, 0.1);
            color: #818cf8;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
        }

        .status-item:nth-child(2) .status-icon {
            background: rgba(192, 132, 252, 0.1);
            color: #c084fc;
        }

        .status-item:nth-child(3) .status-icon {
            background: rgba(244, 114, 182, 0.1);
            color: #f472b6;
        }

        .status-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .status-desc {
            font-size: 0.825rem;
            color: var(--text-secondary);
        }

        /* Footer */
        footer {
            margin-top: 2rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.3);
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: #a5b4fc;
        }

        /* Animations */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
                box-shadow: 0 0 8px #818cf8;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.6;
                box-shadow: 0 0 16px #818cf8;
            }
        }

        @keyframes text-shine {
            to {
                background-position: 200% center;
            }
        }

        @media (max-width: 640px) {
            h1 {
                font-size: 2.75rem;
            }
            .card {
                padding: 2.5rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="glow-1"></div>
    <div class="glow-2"></div>

    <div class="container">
        <div class="card">
            <div class="badge">
                <span class="badge-dot"></span>
                Status: Setup Completed
            </div>

            <h1>Hello World</h1>
            <p class="subtitle">Aplikasi Laravel PHP Anda telah berhasil diinisialisasi dan siap dideploy menggunakan container Docker.</p>

            <div class="status-grid">
                <div class="status-item">
                    <div class="status-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div class="status-title">Laravel Framework</div>
                    <div class="status-desc">v{{ app()->version() }} terinstal dengan rute web siap saji.</div>
                </div>

                <div class="status-item">
                    <div class="status-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <div class="status-title">PHP Environment</div>
                    <div class="status-desc">Dijalankan pada PHP v{{ PHP_VERSION }} dengan ekstensi lengkap.</div>
                </div>

                <div class="status-item">
                    <div class="status-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/><path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3"/></svg>
                    </div>
                    <div class="status-title">Docker Ready</div>
                    <div class="status-desc">Dilengkapi dengan konfigurasi Multi-stage PHP-FPM & Nginx.</div>
                </div>
            </div>
        </div>

        <footer>
            <span>PHP {{ PHP_VERSION }}</span>
            <span>&bull;</span>
            <a href="https://laravel.com" target="_blank">Laravel Docs</a>
            <span>&bull;</span>
            <a href="https://github.com/latiefalamin/simple-php-laravel" target="_blank">GitHub Repo</a>
        </footer>
    </div>
</body>
</html>
