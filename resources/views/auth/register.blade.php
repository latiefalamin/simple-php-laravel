<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Akun Baru - Setup Laravel & Docker</title>
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
            --accent-gradient: linear-gradient(135deg, #818cf8 0%, #c084fc 50%, #f472b6 100%);
            --error-color: #f87171;
            --input-bg: rgba(255, 255, 255, 0.02);
            --input-border: rgba(255, 255, 255, 0.08);
            --input-focus: #818cf8;
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
            max-width: 500px;
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
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
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

        h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.25rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
        }

        p.subtitle {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 300;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.825rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
        }

        .form-input {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            padding: 0.875rem 1rem;
            color: var(--text-primary);
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.2);
            background: rgba(255, 255, 255, 0.04);
        }

        .input-error {
            border-color: var(--error-color) !important;
            box-shadow: 0 0 10px rgba(248, 113, 113, 0.1) !important;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.8rem;
            margin-top: 0.35rem;
            display: block;
        }

        /* General Error Alert */
        .alert-error {
            background: rgba(248, 113, 113, 0.08);
            border: 1px solid rgba(248, 113, 113, 0.2);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #fca5a5;
            font-size: 0.9rem;
        }

        .alert-error ul {
            margin-left: 1.25rem;
            margin-top: 0.5rem;
        }

        /* Submit Button */
        .btn-submit {
            display: block;
            width: 100%;
            background: var(--accent-gradient);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 20px rgba(129, 140, 248, 0.3);
            margin-top: 1.75rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(129, 140, 248, 0.5);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Footer / Links */
        .card-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .card-footer a {
            color: #a5b4fc;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .card-footer a:hover {
            color: #c084fc;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 640px) {
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
            <h1>Registrasi Akun</h1>
            <p class="subtitle">Buat akun baru Anda secara cepat dan aman.</p>

            @if ($errors->any())
                <div class="alert-error">
                    <strong>Pendaftaran gagal.</strong> Silakan periksa kembali form berikut:
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input @error('name') input-error @enderror" placeholder="John Doe" required autofocus autocomplete="name">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input @error('email') input-error @enderror" placeholder="johndoe@example.com" required autocomplete="email">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-input @error('password') input-error @enderror" placeholder="••••••••" required autocomplete="new-password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="••••••••" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn-submit">Daftar Sekarang</button>
            </form>

            <div class="card-footer">
                Sudah punya akun? <a href="{{ url('/') }}">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
