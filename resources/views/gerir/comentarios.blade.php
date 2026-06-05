<!DOCTYPE html>
<html lang="pt-AO">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <button id="admin" class="btn-panel" onclick="painel()">
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
                <input type="text" placeholder="Pesquisar comentarios...">
            </div>

            <div class="chat-list">

                @foreach ($comentarios as $coment)
                <div class="chat-item">
                    <div class="avatar">ES</div>
                    <div class="chat-info">
                        <h4>{{$coment->name}}</h4>
                        <!-- <p>{{$coment->descricao}}.</p>-->
                    </div>
                    <span class="chat-time">{{$coment->created_at}}</span>
                </div>
                @endforeach



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
                <!--<div class="header-actions">
                    <button title="Partilhar Ficheiro"><i class="fa-solid fa-paperclip"></i></button>
                    <button title="Mais Opções"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                </div>-->
            </header>

            <section class="chat-messages">
                <div class="message-divider">...</div>
                @foreach ($comentarios as $lista)
                @if($lista->isEst==1 && !$lista->isAdmin)
                <div class="message received">
                    @elseif($lista->isAdmin==1)
                    <div class="message sent">
                        @endif
                        <div class="message-content">
                            {{$lista->descricao}}
                        </div>
                        <div style="text-align: right;">
                            <i onclick="actualizar('{{$lista->id}}','{{$lista->descricao}}')" class="fa-solid fa-pen-to-square" style="color: blue;"></i>
                            <i onclick="apagar('{{$lista->id}}')" class="fa-solid fa-trash" style="color: red;"></i>
                        </div>

                        <span class="message-time">{{$lista->created_at}}</span>
                    </div>

                    @endforeach

            </section>

            <footer class="chat-input-area">
                <form class="input-form" id="form-coment" action="{{route('coment.store')}}" method="post">
                    @csrf
                    <!--<button type="button" class="btn-action" title="Adicionar ficheiro">
                        <i class="fa-solid fa-plus"></i>
                    </button>-->
                    <input type="hidden" name="inst_id" value="{{$insts->id}}">
                    <input type="text" name="descricao" id="descricao" placeholder="Escreve a tua dúvida sobre a instituição aqui aqui..." class="message-input" required>
                    <button type="submit" class="btn-send" title="Enviar mensagem">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </footer>
        </main>
    </div>

    <script>
        function actualizar(id, descricao) {

            document.getElementById('descricao').value = descricao;

             const formEditar = document.getElementById('form-coment');
            formEditar.method = 'post';
            formEditar.action = `/Comentario/${id}`;

            let methodInput = formEditar.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                formEditar.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

        }

        function apagar(id) {

            if (confirm(`Desejas apagar o comentario com id ${id}`)) {
              
             const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/Comentario/${id}`;

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_token';
            input.value = csrfToken ? csrfToken.getAttribute('content') : '';

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(input);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
            }
        

        function painel() {
            window.location.href = "/dashboard";

        }
    </script>

</body>

<script>

</script>

</html>