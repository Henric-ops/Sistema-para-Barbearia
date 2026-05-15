<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarberHub - Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/autenticacao.css') }}" rel="stylesheet">
</head>
<body>
    <div class="auth-shell">
        <aside class="auth-marca">
            <div class="auth-logo">
                <span class="auth-logo-icone"><i class="fas fa-scissors"></i></span>
                BarberHub
            </div>

            <div class="auth-chamada">
                <h1>Seu horario, seu historico, tudo <span>organizado.</span></h1>
                <p>Crie sua conta para acompanhar atendimentos, status e informacoes cadastradas pela barbearia.</p>
            </div>

            <div class="auth-rodape">Cadastro simples para clientes da barbearia.</div>
        </aside>

        <main class="auth-conteudo">
            <section class="auth-card">
                <h2>Cadastro de cliente</h2>
                <p>Preencha seus dados para criar o acesso.</p>

                @if ($errors->any())
                    <div class="alert auth-alerta mt-4 mb-0">
                        <i class="fas fa-circle-exclamation me-2"></i>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="auth-form" data-formulario-carregando>
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" name="nome" value="{{ old('nome') }}" class="form-control @error('nome') is-invalid @enderror" required autofocus>
                            @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="cpf" class="form-label">CPF</label>
                            <input id="cpf" name="cpf" value="{{ old('cpf') }}" class="form-control @error('cpf') is-invalid @enderror" required>
                            @error('cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input id="telefone" name="telefone" value="{{ old('telefone') }}" class="form-control @error('telefone') is-invalid @enderror" required>
                            @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="endereco" class="form-label">Endereco</label>
                            <textarea id="endereco" name="endereco" rows="2" class="form-control @error('endereco') is-invalid @enderror">{{ old('endereco') }}</textarea>
                            @error('endereco') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirmar senha</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="auth-botao mt-4">
                        <i class="fas fa-user-plus"></i>
                        Criar conta
                    </button>
                </form>

                <div class="auth-divisor">
                    Ja tem conta?
                    <a href="{{ route('login') }}" class="auth-link">Entrar</a>
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('js/interface.js') }}"></script>
</body>
</html>
