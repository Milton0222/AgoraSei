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
                    <a href="#sobre" onclick="up()" class="nav-link">Sobre</a>
                    <a href="#evento" onclick="upv()" class="nav-link">Eventos</a>


                    @if(Auth::user())
                    <button id="admin" class="btn-panel">
                        <i class="fa-solid fa-lock"></i>
                        Painel de Gestão</button>
                    @else
                    <a href="{{route('login')}}" class="btn-panel">Entrar</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-container">
            <h1>O teu futuro começa com a escolha certa.</h1>
            <p>Explore cursos de graduação, conheça as instituições de ensino superior e encontre o caminho académico
                que mais combina com as tuas habilidades e objetivos.</p>
            <div class="hero-buttons">
                <button id="openExploreBtn" class="btn-explore">Explorar Cursos</button>
                <button id="openAdminBtn" class="btn-more">Explorar Instituição</button>
            </div>
        </div>
    </header>

    <!-- Estatísticas Rápidas -->
    <section class="stats">
        <div class="stats-grid">
            <div class="stat-box">
                <span id="countInst" class="number">2</span>
                <span class="label">Públicas e Privadas</span>
            </div>
            <div class="stat-box">
                <span class="number">4</span>
                <span class="label">Áreas de Conhecimento</span>
            </div>
            <div class="stat-box">
                <span id="countCursos" class="number">3</span>
                <span class="label">Informações Detalhadas</span>
            </div>
        </div>
    </section>

    <!-- Como Funciona -->
    <section id="sobre" class="features">
        <div class="features-header">
            <h2>Como o sistema te ajuda?</h2>
            <p>Centralizamos a informação para facilitar a tua tomada de decisão.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="icon-container icon-blue"><i class="fa-solid fa-university"></i></div>
                <h3>Conheça as Instituições</h3>
                <p>Pesquise Universidades e Institutos Superiores filtrados por localização e infraestrutura.</p>
            </div>
            <div class="feature-card">
                <div class="icon-container icon-indigo"><i class="fa-solid fa-sitemap"></i></div>
                <h3>Departamentos Organizados</h3>
                <p>Navegue pelas Faculdades e Institutos Politécnicos para entender as divisões científicas.</p>
            </div>
            <div class="feature-card">
                <div class="icon-container icon-teal"><i class="fa-solid fa-book-open"></i></div>
                <h3>Guias de Cursos</h3>
                <p>Aceda ao perfil de saída, duração, cadeiras principais e mercado de trabalho de cada graduação.</p>
            </div>
        </div>
    </section>

    <!-- eventos instituiocoes -->
    <section id="evento" class="features">
        <div class="features-header">
            <h2>Actividades Realizadas</h2>
            <p>Reunimos as actividades académicas por Instituições.</p>
        </div>
         <div class="features-grid">
        @foreach ($actividades as $activ)
            <div class="feature-card">
                <div class="icon-container icon-blue"><i class="fa-solid fa-university"></i></div>
                <h3>{{$activ->nome}}</h3>
                <p>{{$activ->descricao}}</p>
                <p>{{$activ->created_at}}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="cursocontent" id="curso" style="display: none;">
        <div class="chat-container">
            <aside class="sidebar">
                <div class="sidebar-header">
                    <h3><i class="fa-solid fa-magnifying-glass"></i> Explorar Cursos</h3>
                </div>

                <div class="chat-list">
                    <div class="search-box">
                        <input type="text" id="filtercurso" class="input-field"
                            placeholder="Pesquisar por Engenharia, Economia...">
                    </div>
                    <ul id="exploreCursosList" class="data-list">
                        @foreach ($cursos as $cur)
                        <li class="data-item">
                            <div>
                                <strong>{{$cur->nome}}</strong>
                                <span style="display:block; font-size:12px; color:var(--gray-500)">Área: {{$cur->area_conhecimento}}</span>
                            </div>

                            <span onclick="cursover('{{$cur->id}}','{{$cur->nome}}','{{$cur->mensalidade}}','{{$cur->duracao}}','{{$cur->area_conhecimento}}','{{$cur->qtd_disciplina}}','{{$cur->qtd_vaga}}','{{$cur->nivel_academico}}','{{$cur->perfil_saida}}','{{$cur->depa_id}}')" class="label" style="background:var(--blue-100); color:var(--blue-600); padding:3px 8px; border-radius:12px; font-size:12px"><i class="fa-solid fa-eye"></i></span>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </aside>

            <main class="chat-window">
                <header class="chat-header">
                    <div class="current-user-info">
                        <div class="avatar"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div>
                            <h3>Detalhes do Curso</h3>
                        </div>
                    </div>

                </header>
                <section class="chat-messages">

                    <ul class="data-list">
                        <li class="chat-item">Nome:<strong class="chat-info" id="nome"> </strong></li>
                        <li class="chat-item">Duração:<strong class="chat-info" id="duracao"> </strong></li>
                        <li class="chat-item">Instituição:<strong class="chat-info" id="instituicao"> </strong></li>
                        <li class="chat-item">Mensalidade:<strong class="chat-info" id="mensalidade"> </strong></li>
                        <li class="chat-item">Disciplinas:<strong class="chat-info" id="qtd_disciplina"> </strong></li>
                        <li class="chat-item">Perfil de Saida:<strong class="chat-info" id="perfil_saida"> </strong></li>
                        <li class="chat-item">Nivel Académico:<strong class="chat-info" id="nivel_academico"> </strong></li>
                        <li class="chat-item">Vagas disponiveis:<strong class="chat-info" id="qtd_vaga"> </strong></li>
                        <li class="chat-item">Área de conhecimento:<strong class="chat-info" id="area_conhecimento"> </strong></li>
                    </ul>
                </section>
            </main>
        </div>
    </section>

    <section class="inst" id="inst" style="display: none;">
        <div class="chat-container">
            <aside class="sidebar">
                <div class="sidebar-header">
                    <h3><i class="fa-solid fa-sliders"></i> Explorar Instituições</h3>
                </div>

                <div class="chat-list">
                    <form id="addInstForm" class="search-box">
                        <input type="text" id="InstInput" class="input-field" placeholder="Buscar instituição pelo nome ou endereço"
                            required>
                        <!--<button type="submit" class="btn-submit">Adicionar</button>-->
                    </form>
                    <ul id="adminInstList1" class="data-list">
                        @foreach ($inst as $insts)
                        <li class="data-item">
                            <div>
                                <strong><i class="fa-solid fa-university" style="color:var(--blue-600); margin-right:8px"></i>{{$insts->descricao}}</strong>
                                <span style="display:block; font-size:12px; color:var(--gray-500)">Localização: <strong>{{$insts->localizacao}}</strong></span>
                            </div>

                            <div>
                                <button class="btn-delete" onclick="instver('{{$insts->instagram}}','{{$insts->linha_atendimento}}','{{$insts->whatsap}}','{{$insts->facebook}}','{{$insts->site}}','{{$insts->inicio_funcao}}','{{$insts->estado}}','{{$insts->amibiente_campus}}','{{$insts->reconhecido}}','{{$insts->modalidade_estudo}}','{{$insts->qtd_professor}}','{{$insts->qtd_estudante}}','{{$insts->localizacao}}','{{$insts->provincia}}','{{$insts->custo_licenciatura}}','{{$insts->descricao}}','{{$insts->id}}','{{$insts->tipo}}')" title="Comentar">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button title="Comentar" onclick="comentar('{{$insts->id}}')"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                            </div>

                        </li>
                        @endforeach

                    </ul>
                </div>
            </aside>
            <main class="chat-window">
                <header class="chat-header">
                    <div class="current-user-info">
                        <div class="avatar"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div>
                            <h3>Detalhes da Instituição</h3>
                        </div>
                    </div>
                    <div class="header-actions">


                    </div>

                </header>
                <section class="chat-messages">
                    <ul class="data-list">
                        <li class="chat-item">Denominação:<strong class="chat-info" id="descricao"> </strong></li>
                        <li class="chat-item">Tipo:<strong class="chat-info" id="tipo"> </strong></li>
                        <li class="chat-item">Investimento:<strong class="chat-info" id="custo_licenciatura"> </strong></li>
                        <li class="chat-item">Provincia:<strong class="chat-info" id="provincia"> </strong></li>
                        <li class="chat-item">Localização:<strong class="chat-info" id="localizacao"> </strong></li>
                        <li class="chat-item">Estudantes Matriculados:<strong class="chat-info" id="qtd_estudante"> </strong></li>
                        <li class="chat-item">Modalidade de Estudo:<strong class="chat-info" id="modalidade_estudo"> </strong></li>
                        <li class="chat-item">Decreto de Aprovação:<strong class="chat-info" id="reconhecido"> </strong></li>
                        <li class="chat-item">Ambiente Campus:<strong class="chat-info" id="ambiente_campus"> </strong></li>
                        <li class="chat-item">Linha de Atendimento:<strong class="chat-info" id="linha_atendimento"> </strong></li>
                        <li class="chat-item">Whatsap:<strong class="chat-info" id="whatsap"> </strong></li>
                        <li class="chat-item">Instagram:<strong class="chat-info" id="instagram"> </strong></li>
                        <li class="chat-item">Facebook:<strong class="chat-info" id="facebook"> </strong></li>
                        <li class="chat-item">Site:<strong class="chat-info" id="site"> </strong></li>
                        <li class="chat-item">Inicio de Actividade:<strong class="chat-info" id="inicio_funcao"> </strong></li>
                    </ul>
                </section>

            </main>


        </div>


    </section>

    <!-- --- MODAL 1: EXPLORAR CURSOS --- -->


    <!-- --- MODAL 2: PAINEL DE GESTÃO (INSTITUIÇÕES) --- -->


    <footer class="footer">
        <p>&copy; 2026 Agora<strong>Sei</strong>. Todos os direitos reservados.</p>
    </footer>

    <!-- --- 7. CONTROLADOR JAVASCRIPT NATIVO --- -->
    <script>
        // --- BASE DE DADOS EM MEMÓRIA (MOCK DATA) ---
        let instituicoes = @json($inst);
        let cursos = @json($cursos);


        //ver comentarios
        function comentar(id) {
            window.location.href = `/Comentarios/${id}`;
        }
        //detalhes de curso

        function cursover(id, nome, mensalidade, duracao, area_conhecimento, qtd_disciplina, qtd_vaga, nivel_academico, perfil_saida, depa_id) {
            //alert(`Em desenvolvimneo o painel info ${perfil_saida}`);

            document.getElementById('mensalidade').textContent = mensalidade;
            document.getElementById('nome').textContent = nome;
            document.getElementById('duracao').textContent = `${duracao} Anos`;
            document.getElementById('area_conhecimento').textContent = area_conhecimento;
            document.getElementById('qtd_disciplina').textContent = qtd_disciplina;
            document.getElementById('qtd_vaga').textContent = `${qtd_vaga} Disponivel`;
            document.getElementById('nivel_academico').textContent = nivel_academico;
            document.getElementById('perfil_saida').textContent = perfil_saida;
            document.getElementById('instituicao').textContent = depa_id;

        }

        //detalhes de inst e comentarios

        function instver(instagram, linha_atendimento, whatsap, facebook, site, inicio_funcao, estado, ambiente_campus, reconhecido, modalidade_estudo, qtd_professor, qtd_estudante, localizacao, provincia, custo_licenciatura, descricao, id, tipo) {
            // alert(`Painel de comentarios em desenvolvimento ${descricao}`);

            document.getElementById('tipo').textContent = tipo;
            document.getElementById('descricao').textContent = descricao;
            document.getElementById('qtd_estudante').textContent = qtd_estudante;
            document.getElementById('modalidade_estudo').textContent = modalidade_estudo;
            document.getElementById('reconhecido').textContent = reconhecido;
            document.getElementById('ambiente_campus').textContent = ambiente_campus;
            document.getElementById('inicio_funcao').textContent = inicio_funcao;
            document.getElementById('linha_atendimento').textContent = linha_atendimento;
            document.getElementById('site').textContent = site;
            document.getElementById('instagram').textContent = instagram;
            document.getElementById('whatsap').textContent = whatsap;
            document.getElementById('facebook').textContent = facebook;
            document.getElementById('provincia').textContent = provincia;
            document.getElementById('localizacao').textContent = localizacao;
            document.getElementById('custo_licenciatura').textContent = custo_licenciatura;

        }

        //filtrar curso
        function buscar() {
            const nome = document.getElementById('filtercurso').value;

            if (!nome) {
                return;
            }
            const params = new URLSearchParams();
            if (nome) params.append('nome', nome);

            window.location.href = '/?' + params.toString();

        }
        document.getElementById('filtercurso')?.addEventListener('input', buscar);
        //filtarar inst 
        function buscar1() {
            const nome = document.getElementById('InstInput').value;

            if (!nome) {
                return;
            }
            const params = new URLSearchParams();
            if (nome) params.append('instnome', nome);

            window.location.href = '/?' + params.toString();

        }
        document.getElementById('InstInput')?.addEventListener('input', buscar1);

        // --- CONTROLO DOS MODAIS ---
        function openModal(id) {
            //document.getElementById(id).classList.add('active');
            if (id === 'exploreModal') {
                // renderExplorarCursos();
                document.getElementById('curso').style.display = 'block';
                document.getElementById('sobre').style.display = 'none';
                document.getElementById('inst').style.display = 'none';
                document.getElementById('evento').style.display = 'none';

            }
            if (id === 'adminModal') {
                document.getElementById('curso').style.display = 'none';
                document.getElementById('sobre').style.display = 'none';
                document.getElementById('inst').style.display = 'block';
                document.getElementById('evento').style.display = 'none';
                //renderGestaoInstituicoes();
            }
        }

        //abilitar section sobre
        function up() {
            document.getElementById('curso').style.display = 'none';
            document.getElementById('sobre').style.display = 'block';
            document.getElementById('inst').style.display = 'none';
            document.getElementById('evento').style.display = 'none';
        }

        function upv() {
            document.getElementById('curso').style.display = 'none';
            document.getElementById('sobre').style.display = 'none';
            document.getElementById('inst').style.display = 'none';
            document.getElementById('evento').style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function painel() {
            window.location.href = "/dashboard";
        }

        // Eventos de Abertura
        document.getElementById('openExploreBtn').addEventListener('click', () => openModal('exploreModal'));
        document.getElementById('openAdminBtn').addEventListener('click', () => openModal('adminModal'));
        document.getElementById('admin').addEventListener('click', painel);

        // Fechar se clicar fora da caixa branca
        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-overlay')) {
                e.target.classList.remove('active');
            }
        });

        // --- ATUALIZADOR DE ESTATÍSTICAS DO CONTADOR ---
        function updateCounters() {
            document.getElementById('countInst').innerText = instituicoes.length;
            document.getElementById('countCursos').innerText = cursos.length;
        }

        // --- FUNCIONALIDADE 1: EXPLORAR/FILTRAR CURSOS/inst ---
        const searchInput = document.getElementById('filtercurso');
        searchInput.addEventListener('input', renderExplorarCursos);


        function renderExplorarCursos() {
            const termo = searchInput.value.toLowerCase();
            const lista = document.getElementById('exploreCursosList');
            lista.innerHTML = '';

            const filtrados = cursos.filter(c => c.nome.toLowerCase().includes(termo) || c.area_conhecimento.toLowerCase().includes(termo));

            if (filtrados.length === 0) {
                lista.innerHTML = `<li class="data-item" style="color: var(--gray-500)">Nenhum curso encontrado...</li>`;
                return;
            }

            filtrados.forEach(c => {
                const li = document.createElement('li');
                li.className = 'data-item';
                li.innerHTML = `
                    <div>
                        <strong>${c.nome}</strong>
                        <span style="display:block; font-size:12px; color:var(--gray-500)">Área: ${c.area_conhecimento}</span>
                    </div>
                    <span class="label" style="background:var(--blue-100); color:var(--blue-600); padding:3px 8px; border-radius:12px; font-size:12px">Ativo</span>
                `;
                lista.appendChild(li);
            });
        }

        // --- FUNCIONALIDADE 2: GESTÃO DE INSTITUIÇÕES (C.R.U.D) ---
        const addForm = document.getElementById('addInstForm');
        addForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const input = document.getElementById('newInstInput');
            const novaInst = input.value.trim();

            if (novaInst) {
                instituicoes.push(novaInst);
                input.value = '';
                renderGestaoInstituicoes();
                updateCounters();
            }
        });

        function eliminarInstituicao(index) {
            instituicoes.splice(index, 1);
            renderGestaoInstituicoes();
            updateCounters();
        }

        function renderGestaoInstituicoes() {
            const lista = document.getElementById('adminInstList');
            lista.innerHTML = '';

            instituicoes.forEach((inst, index) => {
                const li = document.createElement('li');
                li.className = 'data-item';
                li.innerHTML = `
                    
                     <div>
                        <strong><i class="fa-solid fa-university" style="color:var(--blue-600); margin-right:8px"></i>${inst.descricao}</strong>
                        <span style="display:block; font-size:12px; color:var(--gray-500)">Localização: <strong>${inst.localizacao}</strong></span>
                    </div>
                    <button class="btn-delete" onclick="instver('${inst.id}','${inst.descricao}')" title="Comentar">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                `;
                lista.appendChild(li);
            });
        }



        // Inicializar contadores da página principal
        updateCounters();
    </script>
</body>

</html>