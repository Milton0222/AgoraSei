<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Painel Administrativo - AgoraSEI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
         @include('sweetalert::alert')
        <x-banner />
        <!-- ================= BARRA LATERAL (SIDEBAR) ================= -->
    <aside class="sidebar">
        <div>
            <div class="sidebar-header">
                <i class="fa-solid fa-chart-line text-blue-500"></i>
                <span>AS-DASHBOARD</span>
            </div>
            
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="{{route('dashboard')}}" class="sidebar-link active">
                        <i class="fa-solid fa-house-user"></i> Visão Geral
                    </a>
                </li>
               <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-university"></i> Instituições
                    </a>-->

                     <!-- 📂 ITEM COM DROPDOWN INTERATIVO -->
                <li class="sidebar-item">
                    <div class="sidebar-link" onclick="toggleDropdown()">
                        <span><i class="fa-solid fa-university" style="margin-right: 12px;"></i>Instituição</span>
                        <i class="fa-solid fa-chevron-right arrow-icon" id="menu-seta"></i>
                    </div>
                    <!-- Submenu Retrátil -->
                    <div class="dropdown-container" id="menu-instituicao">
                        <a href="{{route('inst.index')}}" class="submenu-link"><i class="fa-solid fa-plus-circle"></i> Registar</a>
                        <a href="#" class="submenu-link"><i class="fa-solid fa-sitemap"></i> Departamentos</a>
                        <a href="#" class="submenu-link"><i class="fa-solid fa-book-open"></i> Cursos</a>
                        <a href="instituicao.html" class="submenu-link"><i class="fa-solid fa-info-circle"></i> Informações</a>
                    </div>
                </li>

                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-users"></i> Estudantes
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-gears"></i> Configurações
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
            <a href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();" class="btn-logout"><i class="fa-solid fa-sign-out-alt"></i> Sair do Painel</a>
            </form>
        </div>
    </aside>

      <!-- ================= CONTENTOR PRINCIPAL ================= -->
    <div  class="main-container">
        
        <!-- BARRA SUPERIOR (TOPBAR) -->
        <header class="topbar">
            <h1>@yield('top')</h1>
            <div class="user-profile">
                <div class="avatar">{{Auth::user()->name[0]}}</div>
                <div>
                    
                    <h4 style="font-size: 0.9rem; font-weight: 600; display: flex; margin-bottom: -20px;"> {{ Auth::user()->name }}
                         <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                          
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    </h4>
                    <p style="font-size: 0.75rem; color: var(--texto-mutado);">
                        @if(Auth::user()->isAdmin && Auth::user()->isEst)
                            Administrador
                        @elseif(Auth::user()->isEst)
                            Estudante 
                        @endif
                        </p>
                </div>
            </div>
        </header>

        <!-- ESPAÇO DE CONTEÚDO DINÂMICO -->
        <main class="content-wrapper">
               {{ $slot }}
              @yield('conteudo')
        </main>

      <!--  <div class="min-h-screen bg-gray-100">
            livewire('navigation-menu')

            Page Heading 
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            Page Content 
            <main>
              
            </main>
        </div>-->

        @stack('modals')

        @livewireScripts
    </body>
     <!-- ================= CONTROLO LOGICO DO MODAL ================= -->
    <script>
         // --- CONTROLO DO MENU DROPDOWN ---
        function toggleDropdown() {
            const dropdown = document.getElementById('menu-instituicao');
            const seta = document.getElementById('menu-seta');
            
            // Alterna as classes para animar a abertura e rotação da seta
            dropdown.classList.toggle('open');
            seta.classList.toggle('rotate');
        }
        // Função limpa para abrir (true) ou fechar (false) o modal à direita
        function toggleModal(open) {
            const modal = document.getElementById('institutionModal');
            if (open) {
                modal.classList.add('active');
            } else {
                modal.classList.remove('active');
            }
        }

        // Fecha o modal se o utilizador clicar na área vazia desfocada fora do formulário
        function closeModalOutside(event) {
            if (event.target.id === 'institutionModal') {
                toggleModal(false);
            }
        }

        // Simulação de ação de gravação
        function salvarFormulario() {
            const nome = document.getElementById('nome-inst').value;
            if(!nome) {
                alert("Por favor, preencha o nome da instituição.");
                return;
            }
            alert("Instituição guardada com sucesso!");
            toggleModal(false);
            document.getElementById('form-instituicao').reset();
        }
    </script>
</html>
