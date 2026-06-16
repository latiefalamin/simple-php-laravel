<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Simple Laravel</title>
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
            --input-bg: rgba(255,255,255,0.02);
            --input-border: rgba(255,255,255,0.08);
            --input-focus: #818cf8;
        }
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background-color:var(--bg-color);color:var(--text-primary);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem 1rem;}
        .glow-1,.glow-2{position:absolute;width:50vw;height:50vw;filter:blur(80px);z-index:0;pointer-events:none;}
        .glow-1{top:-10%;left:-10%;background:radial-gradient(circle,rgba(99,102,241,0.2)0%,transparent70%);}
        .glow-2{bottom:-10%;right:-10%;background:radial-gradient(circle,rgba(244,114,182,0.15)0%,transparent70%);}
        .container{max-width:500px;width:100%;z-index:10;position:relative;}
        .card{background:var(--card-bg);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1px solid var(--card-border);border-radius:24px;padding:3rem 2.5rem;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);position:relative;overflow:hidden;}
        .card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:var(--accent-gradient);}
        h1{font-family:'Outfit',sans-serif;font-size:2.25rem;font-weight:800;background:var(--accent-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;text-align:center;margin-bottom:1rem;}
        .form-group{margin-bottom:1.25rem;}
        .form-label{display:block;font-size:0.825rem;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.5rem;color:var(--text-secondary);}
        .form-input{width:100%;background:var(--input-bg);border:1px solid var(--input-border);border-radius:12px;padding:0.875rem 1rem;color:var(--text-primary);font-size:0.95rem;transition:all 0.3s ease;}
        .form-input:focus{outline:none;border-color:var(--input-focus);box-shadow:0 0 10px rgba(99,102,241,0.2);background:rgba(255,255,255,0.04);}
        .input-error{border-color:var(--error-color)!important;box-shadow:0 0 10px rgba(248,113,113,0.1)!important;}
        .error-message{color:var(--error-color);font-size:0.8rem;margin-top:0.35rem;display:block;}
        .alert-error{background:rgba(248,113,113,0.08);border:1px solid rgba(248,113,113,0.2);border-radius:12px;padding:1rem;margin-bottom:1.5rem;color:#fca5a5;font-size:0.9rem;}
        .btn-submit{display:block;width:100%;background:var(--accent-gradient);color:#fff;border:none;border-radius:12px;padding:1rem;font-weight:700;cursor:pointer;transition:transform 0.2s,box-shadow 0.2s;box-shadow:0 4px 20px rgba(129,140,248,0.3);margin-top:1.75rem;}
        .btn-submit:hover{transform:translateY(-2px);box-shadow:0 6px 24px rgba(129,140,248,0.5);}
        .footer{margin-top:2rem;font-size:0.9rem;color:var(--text-secondary);text-align:center;}
        .footer a{color:#a5b4fc;text-decoration:none;}
        .footer a:hover{color:#c084fc;}
        @media (max-width:640px){.card{padding:2.5rem 1.5rem;}}
    </style>
</head>
<body>
    <div class="glow-1"></div>
    <div class="glow-2"></div>
    <div class="container">
        <div class="card">
            <h1>Login</h1>
            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input @error('email') input-error @enderror" type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-input @error('password') input-error @enderror" type="password" name="password" id="password" required autocomplete="current-password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn-submit">Masuk</button>
            </form>
            <div class="footer">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>
</body>
</html>
