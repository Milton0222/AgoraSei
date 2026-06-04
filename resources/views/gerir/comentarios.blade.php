<!DOCTYPE html>
<html lang="pt-AO">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgoraSei - Orientação Académica</title>
    <!-- Font Awesome para suporte de ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
</head>

<body>
    @include('sweetalert::alert')
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-row">
                <div>
                    <a href="/" class="nav-link">
                        <span class="nav-logo">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <h3>Agora</h3>
                            <h1>Sei</h1>
                        </span>
                    </a>

                </div>
                <div class="nav-links">
                    <a href="#sobre" class="nav-link">Sobre</a>

                    @if(Auth::user())
                    <button id="admin" class="btn-panel" onclick="painel()" >
                        <i class="fa-solid fa-lock"></i>
                        Painel de Gestão</button>
                    @else
                    <a href="{{route('login')}}" class="btn-panel">Entrar</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="chat-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fa-solid fa-graduation-cap"></i> {{$insts->descricao}}</h2>
            </div>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Pesquisar tutor ou disciplina...">
            </div>

            <div class="chat-list">
                <div class="chat-item active">
                    <div class="avatar">PM</div>
                    <div class="chat-info">
                        <h4>Prof. Mateus Silva</h4>
                        <p>Dúvida sobre Engenharia de Software</p>
                    </div>
                    <span class="chat-time">14:32</span>
                </div>

                <div class="chat-item">
                    <div class="avatar">MA</div>
                    <div class="chat-info">
                        <h4>Monitoria Álgebra</h4>
                        <p>A aula vai começar às 16h.</p>
                    </div>
                    <span class="chat-time">Ontem</span>
                </div>

                <div class="chat-item">
                    <div class="avatar">BD</div>
                    <div class="chat-info">
                        <h4>Grupo de Bases de Dados</h4>
                        <p>Alguém conseguiu resolver a questão 3?</p>
                    </div>
                    <span class="chat-time">02 Jun</span>
                </div>
            </div>
        </aside>

        <main class="chat-window">
            <header class="chat-header">
                <div class="current-user-info">
                    <div class="avatar">{{Auth::user()->name[0]}}</div>
                    <div>
                        <h3>{{Auth::user()->name}}</h3>
                        <span class="status online">Online</span>
                    </div>
                </div>
                <div class="header-actions">
                    <button title="Partilhar Ficheiro"><i class="fa-solid fa-paperclip"></i></button>
                    <button title="Mais Opções"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                </div>
            </header>

            <section class="chat-messages">
                <div class="message-divider">Hoje</div>

                <div class="message received">
                    <div class="message-content">
                        Olá! Recebi o teu diagrama de classes do sistema. No geral está muito bom, mas precisas de rever a relação de agregação na classe de paginação.
                    </div>
                    <span class="message-time">14:28</span>
                </div>

                <div class="message sent">
                    <div class="message-content">
                        Muito obrigado pelo feedback, Professor! Vou corrigir isso agora mesmo e enviar a nova versão do código.
                    </div>
                    <span class="message-time">14:32</span>
                </div>
            </section>

            <footer class="chat-input-area">
                <form class="input-form" action="{{route('coment.store')}}" method="post">
                    @csrf
                    <button type="button" class="btn-action" title="Adicionar ficheiro">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <input type="hidden" name="inst_id" value="{{$insts->id}}">
                    <input type="text" name="descricao" placeholder="Escreve a tua dúvida sobre a instituição aqui aqui..." class="message-input" required>
                    <button type="submit" class="btn-send" title="Enviar mensagem">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </footer>
        </main>
    </div>

<script>
      function painel() {
            window.location.href = "/dashboard";
        }
</script>

</body>

</html>