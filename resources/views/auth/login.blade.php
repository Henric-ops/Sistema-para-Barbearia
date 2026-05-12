<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarberHub - Dashboard Profissional</title>

    <!-- Bootstrap 5.3 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* ── TOKENS ── */
        :root {
            --ink: #0D0D0D;
            --ink-mid: #161616;
            --ink-light: #222222;
            --ink-border: rgba(255, 255, 255, 0.07);
            --gold: #C9A84C;
            --gold-light: #E8C96B;
            --gold-glow: rgba(201, 168, 76, 0.25);
            --text: #FFFFFF;
            --muted: #7A7369;
            --error: #C0392B;
            --gradient-accent: linear-gradient(135deg, #C9A84C 0%, #E8C96B 100%);
            --shadow-glow: 0 0 40px rgba(201, 168, 76, 0.3);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            background: var(--ink);
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            overflow: hidden;
        }

        /* Grain texture */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* ── LOADING OVERLAY ── */
        .loading-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 52px;
            height: 52px;
            border: 3px solid rgba(201, 168, 76, 0.15);
            border-top-color: var(--gold);
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }

        /* ── LAYOUT ── */
        .auth-container {
            position: relative;
            z-index: 1;
            height: 100vh;
            display: grid;
            grid-template-columns: 44% 1fr;
        }

        /* ── SIDEBAR ── */
        .auth-sidebar {
            background: var(--ink-mid);
            border-right: 1px solid var(--ink-border);
            padding: 60px 56px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        /* Vertical gold line on border */
        .auth-sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            right: -1px;
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom, transparent 0%, var(--gold) 40%, var(--gold) 60%, transparent 100%);
            opacity: 0.4;
        }

        /* Radial bloom */
        .sidebar-bloom {
            position: absolute;
            bottom: -160px;
            left: -160px;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(201, 168, 76, 0.12) 0%, transparent 65%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Scissor watermark */
        .sidebar-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-18deg);
            font-size: 300px;
            color: var(--gold);
            opacity: 0.03;
            pointer-events: none;
            line-height: 1;
        }

        /* Brand mark */
        .brand-mark {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 2;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            background: var(--gradient-accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--ink);
            box-shadow: 0 4px 24px var(--gold-glow);
            flex-shrink: 0;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        /* Hero */
        .sidebar-content {
            position: relative;
            z-index: 2;
        }

        .sidebar-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid rgba(201, 168, 76, 0.28);
            color: var(--gold);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 40px;
            margin-bottom: 24px;
        }

        .sidebar-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 4vw, 3.8rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.02em;
            color: var(--text);
            margin-bottom: 20px;
        }

        .sidebar-content h1 em {
            color: var(--gold);
            font-style: italic;
        }

        .sidebar-tagline {
            font-size: 0.97rem;
            color: var(--muted);
            font-weight: 300;
            line-height: 1.75;
            max-width: 360px;
        }

        /* Stats */
        .sidebar-stats {
            display: flex;
            gap: 0;
            position: relative;
            z-index: 2;
        }

        .stat-item {
            flex: 1;
            padding: 0 24px;
            border-right: 1px solid var(--ink-border);
        }

        .stat-item:first-child {
            padding-left: 0;
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* ── AUTH CARD ── */
        .auth-card {
            padding: 60px 64px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        /* Header */
        .card-header {
            text-align: center;
            margin-bottom: 40px;
            background: none;
            border: none;
            padding: 0;
        }

        .logo-premium {
            width: 72px;
            height: 72px;
            background: var(--gradient-accent);
            border-radius: 20px;
            margin: 0 auto 20px;
            box-shadow: var(--shadow-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--ink);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .card-subtitle {
            color: var(--muted);
            font-size: 0.92rem;
            font-weight: 300;
        }

        /* ── ERROR ALERT ── */
        .alert-custom {
            background: rgba(192, 57, 43, 0.1);
            border: 1px solid rgba(192, 57, 43, 0.3);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
            font-size: 0.875rem;
            color: #e06b5f;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-custom .btn-close {
            margin-left: auto;
            filter: invert(1);
            opacity: 0.6;
            flex-shrink: 0;
            align-self: center;
        }

        /* ── FORM FIELDS ── */
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        /* Field label above */
        .field-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
            transition: color 0.25s;
        }

        .form-group:focus-within .field-label {
            color: var(--gold);
        }

        .field-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-icon {
            position: absolute;
            left: 18px;
            color: var(--muted);
            font-size: 0.85rem;
            pointer-events: none;
            transition: color 0.25s;
            z-index: 2;
        }

        .form-group:focus-within .field-icon {
            color: var(--gold);
        }

        /* The actual input — keeps original classes + adds ours */
        .form-control-premium {
            width: 100% !important;
            background: var(--ink-light) !important;
            border: 1px solid var(--ink-border) !important;
            border-radius: 12px !important;
            height: 54px !important;
            padding: 0 50px 0 44px !important;
            font-family: 'DM Sans', sans-serif !important;
            font-size: 0.95rem !important;
            font-weight: 400 !important;
            color: var(--text) !important;
            outline: none !important;
            transition: border-color 0.3s, box-shadow 0.3s, background 0.3s !important;
            box-shadow: none !important;
        }

        .form-control-premium::placeholder {
            color: #3a3a3a !important;
        }

        .form-control-premium:focus {
            border-color: rgba(201, 168, 76, 0.55) !important;
            background: rgba(201, 168, 76, 0.04) !important;
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.12), 0 4px 20px rgba(0, 0, 0, 0.3) !important;
        }

        .form-control-premium.is-invalid {
            border-color: rgba(192, 57, 43, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.1) !important;
        }

        /* Password wrapper overrides Bootstrap input-group */
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group .form-control-premium {
            flex: 1;
        }

        /* Toggle password button */
        #togglePassword {
            position: absolute;
            right: 14px;
            background: none !important;
            border: none !important;
            color: var(--muted) !important;
            font-size: 0.85rem;
            padding: 4px;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 3;
            line-height: 1;
        }

        #togglePassword:hover {
            color: var(--gold) !important;
        }

        /* Inline error message */
        .invalid-feedback {
            font-size: 0.78rem !important;
            color: #e06b5f !important;
            margin-top: 6px;
            padding-left: 4px;
        }

        /* ── SUBMIT BUTTON ── */
        .btn-enterprise {
            width: 100%;
            height: 54px;
            background: var(--gradient-accent);
            border: none;
            border-radius: 12px;
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s;
            box-shadow: 0 8px 28px var(--gold-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-enterprise::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, transparent 55%);
            pointer-events: none;
        }

        .btn-enterprise:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(201, 168, 76, 0.48);
        }

        .btn-enterprise:active {
            transform: translateY(0);
        }

        .btn-enterprise.loading {
            pointer-events: none;
        }

        .btn-enterprise.loading i,
        .btn-enterprise.loading span {
            opacity: 0;
        }

        .btn-enterprise.loading::after {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            border: 2.5px solid rgba(0, 0, 0, 0.2);
            border-top-color: var(--ink);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── DIVIDER ── */
        .divider {
            position: relative;
            text-align: center;
            margin: 28px 0;
            color: var(--muted);
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--ink-border);
        }

        .divider span {
            position: relative;
            background: var(--ink);
            padding: 0 18px;
        }

        /* ── OAUTH BUTTONS ── */
        .oauth-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 0;
        }

        .btn-oauth {
            height: 48px;
            background: var(--ink-light);
            border: 1px solid var(--ink-border);
            border-radius: 10px;
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: border-color 0.25s, background 0.25s, color 0.25s;
        }

        .btn-oauth:hover {
            border-color: rgba(201, 168, 76, 0.4);
            background: rgba(201, 168, 76, 0.05);
            color: var(--text);
        }

        /* ── CARD FOOTER ── */
        .card-footer {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--ink-border) !important;
            text-align: center;
            background: none !important;
        }

        .footer-text {
            color: var(--muted);
            font-size: 0.84rem;
        }

        .footer-text a {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .version-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(201, 168, 76, 0.1);
            border: 1px solid rgba(201, 168, 76, 0.2);
            color: var(--gold);
            padding: 5px 14px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 10px;
        }

        /* ── ANIMATIONS ── */
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.22, 0.6, 0.36, 1) both;
        }

        .auth-card.fade-in-up {
            animation-delay: 0.1s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 992px) {
            .auth-container {
                grid-template-columns: 1fr;
                overflow-y: auto;
                height: auto;
                min-height: 100vh;
            }

            .auth-sidebar {
                display: none;
            }

            .auth-card {
                padding: 52px 36px;
            }
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 40px 24px;
            }

            .oauth-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="auth-container">

        <div class="auth-sidebar fade-in-up">
            <div class="sidebar-bloom"></div>
            <div class="sidebar-watermark"><i class="fas fa-scissors"></i></div>

            <div class="brand-mark">
                <div class="brand-icon"><i class="fas fa-scissors"></i></div>
                <span class="brand-name">BarberHub</span>
            </div>

            <div class="sidebar-content">
                <h1>Eleve o padrão da sua <em>Barbearia.</em></h1>
                <p class="sidebar-tagline">
                    O BarberHub organiza clientes, serviços e agendamentos da barbearia,
                    evitando conflitos de horários e facilitando a gestão com controle de acesso e relatórios.
                </p>
            </div>

            <div class="sidebar-stats">
                <div class="stat-item">
                    <span class="stat-number"></span>
                    <span class="stat-label"></span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"></span>
                    <span class="stat-label"></span>
                </div>
            </div>
        </div>

        <!--Login-->
        <div class="auth-card fade-in-up">

            <div class="card-header">
                <div class="logo-premium">
                    <i class="fas fa-scissors"></i>
                </div>
                <h2 class="card-title">Bem-vindo</h2>
                <p class="card-subtitle">Acesse sua conta para continuar</p>
            </div>

            @if ($errors->any())
                <div class="alert-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle" style="flex-shrink:0;margin-top:1px"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="field-label" for="email">
                        <i class="fas fa-envelope me-1"></i> E-mail
                    </label>
                    <div class="field-wrap">
                        <input type="email" class="form-control-premium @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="email@exemplo.com" value="{{ old('email') }}" required
                            autocomplete="email">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="field-label" for="password">
                        <i class="fas fa-lock me-1"></i> Senha
                    </label>
                    <div class="field-wrap">
                        <div class="input-group">
                            <input type="password" class="form-control-premium @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="••••••••" required
                                autocomplete="current-password">
                            <button class="btn btn-link text-decoration-none p-0" type="button" id="togglePassword"
                                aria-label="Mostrar senha">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-enterprise mb-3" id="submitBtn">
                    <i class="fas fa-arrow-right"></i>
                    <span>Entrar</span>
                </button>

                <div class="divider"><span>ou continue com</span></div>

                <div class="oauth-grid mb-0">
                    <button type="button" class="btn-oauth">
                        <svg width="17" height="17" viewBox="0 0 48 48">
                            <path fill="#EA4335"
                                d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
                            <path fill="#4285F4"
                                d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
                            <path fill="#FBBC05"
                                d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
                            <path fill="#34A853"
                                d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
                        </svg>
                        Google
                    </button>
                    <button type="button" class="btn-oauth">
                        <i class="fab fa-facebook-f" style="color:#1877F2;font-size:0.95rem"></i>
                        Facebook
                    </button>
                </div>

            </form>

            <div class="card-footer">
                <p class="footer-text mb-0">
                    Ainda nao tem conta?
                    <a href="{{ route('register') }}">Cadastre-se como cliente</a>
                </p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            const toggleBtn = document.getElementById('togglePassword');
            const pwdInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    const hidden = pwdInput.type === 'password';
                    pwdInput.type = hidden ? 'text' : 'password';
                    eyeIcon.className = hidden ? 'fas fa-eye-slash' : 'fas fa-eye';
                });
            }

            const form = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');

            if (form && submitBtn) {
                form.addEventListener('submit', function () {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                });
            }
        })();
    </script>
</body>

</html>
