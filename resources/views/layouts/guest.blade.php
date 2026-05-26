<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Acesso ao Sistema - AgoraSEI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts

        <div class="auth-container">
             @yield('auth')

        </div>
    </body>
    <script>
            // Função para alternar entre as telas aplicando a classe de exibição
        function alternarTela(tela) {
            // Remove o estado ativo de ambos os formulários
            document.getElementById('form-login').classList.remove('active');
            document.getElementById('form-registo').classList.remove('active');

            // Ativa apenas a tela selecionada
            if (tela === 'login') {
                document.getElementById('form-login').classList.add('active');
                  window.location.href="{{route('login')}}";
            } else if (tela === 'registo') {
                document.getElementById('form-registo').classList.add('active');
                window.location.href="{{route('register')}}";
            }
        }

        // Lógica interativa ao submeter o Login
        function realizarLogin(event) {
            event.preventDefault();
            const email = document.getElementById('login-email').value;
            alert(`Autenticação efetuada com sucesso para: ${email}\nRedirecionando para a aplicação...`);
            // Aqui faria o redirecionamento real usando window.location.href
        }

        // Lógica interativa ao submeter o Registo
        function realizarRegisto(event) {
            event.preventDefault();
            const nome = document.getElementById('registo-nome').value;
            alert(`Conta criada com sucesso para ${nome}!\nFaça o login com as tuas credenciais.`);
            alternarTela('login'); // Leva o usuário de volta para o ecrã de login
        }
    </script>
    </script>
</html>
