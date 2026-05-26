<x-guest-layout>

       @section('auth')
        <x-validation-errors class="mb-4" />
         <!-- 🔐 1. FORMULÁRIO DE LOGIN -->
        <div id="form-login" class="auth-form active">
            <div class="auth-header">
                <div class="logo-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <h2>Bem-vindo de volta</h2>
                <p>Aceda à sua conta para continuar</p>
            </div>

         <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-group">
                    <label for="login-email">E-mail Corporativo / Estudante</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <x-input type="email" id="login-email" name="email" class="form-control" placeholder="exemplo@sistema.com" :value="old('email')" required autofocus autocomplete="username"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login-password">Palavra-passe</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" id="login-password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-options">
                    <label>
                        <input type="checkbox"> Lembrar-me
                    </label>
                    <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
                    <a href="/">Voltar ao Painel.</a>
                </div>

                <button type="submit" class="btn-submit">
                    Entrar no Sistema <i class="fa-solid fa-right-to-bracket"></i>
                </button>
            </form>

            <div class="auth-footer">
                Não tem uma conta? <button> <a href="{{route('register')}}">Criar Conta</a></button>
            </div>
        </div>

        
       @endsection
   
</x-guest-layout>
