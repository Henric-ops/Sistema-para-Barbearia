<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BarberHub</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link href="{{ asset('css/componentes.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon">
                    <img src="{{ asset('img/logobarber.png') }}" alt="BarberHub" class="brand-image">
                </div>
                <div>
                    <div class="brand-text">BarberHub</div>
                    <div class="brand-sub">barberclub</div>
                </div>
            </div>

            <nav class="sidebar-nav">

                @if(auth()->user()->isAdministrador())
                    <div class="nav-section-label">Principal</div>
                    <ul class="lista-navegacao">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-chart-line"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('agendamentos.*') ? 'active' : '' }}"
                                href="{{ route('agendamentos.index') }}">
                                <i class="fas fa-calendar-alt"></i> Agendamentos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                                href="{{ route('clientes.index') }}">
                                <i class="fas fa-users"></i> Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('servicos.*') ? 'active' : '' }}"
                                href="{{ route('servicos.index') }}">
                                <i class="fas fa-cut"></i> Servicos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('relatorios.*') ? 'active' : '' }}"
                                href="{{ route('relatorios.index') }}">
                                <i class="fas fa-chart-bar"></i> Relatorios
                            </a>
                        </li>
                    </ul>

                    <div class="nav-section-label">Gestao</div>
                    <ul class="lista-navegacao">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('barbeiros.*') ? 'active' : '' }}"
                                href="{{ route('barbeiros.index') }}">
                                <i class="fas fa-user-tie"></i> Barbeiros
                            </a>
                        </li>
                    </ul>

                @elseif(auth()->user()->isBarbeiro())
                    <div class="nav-section-label">Menu</div>
                    <ul class="lista-navegacao">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('barbeiro.dashboard') ? 'active' : '' }}"
                                href="{{ route('barbeiro.dashboard') }}">
                                <i class="fas fa-chart-line"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('barbeiro.agendamentos') ? 'active' : '' }}"
                                href="{{ route('barbeiro.agendamentos') }}">
                                <i class="fas fa-calendar-alt"></i> Meus Agendamentos
                            </a>
                        </li>
                    </ul>
                @else
                    {{-- ========== MENU DO CLIENTE ========== --}}
                    <div class="nav-section-label">Menu</div>
                    <ul class="lista-navegacao">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cliente.dashboard') ? 'active' : '' }}"
                                href="{{ route('cliente.dashboard') }}">
                                <i class="fas fa-calendar-check"></i> Meus Agendamentos
                            </a>
                        </li>
                    </ul>
                @endif

            </nav>

            <div class="sidebar-footer">
                <button type="button" class="user-chip botao-usuario" data-enviar-formulario="#logout-form">
                    <div class="avatar">{{ substr(auth()->user()->name, 0, 2) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">{{ ucfirst(auth()->user()->cargo) }}</div>
                    </div>
                    <i class="fas fa-sign-out-alt icone-sair"></i>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- MAIN -->
        <main class="main">

            <!-- TOPBAR -->
            <div class="topbar">
                <div class="topbar-left">
                    <h1>@yield('title', 'Dashboard')</h1>
                    <p>
                        @if(auth()->user()->isAdministrador())
                            Visao geral da sua barbearia -
                        @elseif(auth()->user()->isBarbeiro())
                            Seus agendamentos -
                        @else
                            Seus horarios —
                        @endif
                        <span id="js-date" class="data-destaque"></span>
                    </p>
                </div>

                <div class="topbar-right">

                    @if(auth()->user()->isAdministrador())
                        <a href="{{ route('agendamentos.create') }}" class="btn-primary-gold">
                            <i class="fas fa-plus"></i> Novo agendamento
                        </a>
                    @endif
                </div>
            </div>

            @yield('content')

        </main>
    </div>

    <script>
        const d = new Date();
        document.getElementById('js-date').textContent =
            d.toLocaleDateString('pt-BR', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/interface.js') }}"></script>

</body>

</html>
