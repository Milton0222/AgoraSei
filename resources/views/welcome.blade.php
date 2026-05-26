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
                    <span class="nav-logo">
                        <i class="fa-solid fa-graduation-cap"></i> <h3>Agora</h3><h1>Sei</h1>
                    </span>
                </div>
                <div class="nav-links">
                    <a href="#sobre" class="nav-link">Sobre</a>
                    <a href="{{route('login')}}" class="nav-link">Entrar</a>
                    <button id="admin" class="btn-panel">
                        <i class="fa-solid fa-lock"></i>
                        Painel de Gestão</button>
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
  


    <!-- --- MODAL 1: EXPLORAR CURSOS --- -->
    <div id="exploreModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa-solid fa-magnifying-glass"></i> Explorar Cursos</h3>
                <button class="close-modal" onclick="closeModal('exploreModal')">&times;</button>
            </div>
            <div class="search-box">
                <input type="text" id="searchCursoInput" class="input-field"
                    placeholder="Pesquisar por Engenharia, Economia...">
            </div>
            <ul id="exploreCursosList" class="data-list">
                <!-- Injetado por JS -->
            </ul>
        </div>
    </div>

    <!-- --- MODAL 2: PAINEL DE GESTÃO (INSTITUIÇÕES) --- -->
    <div id="adminModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa-solid fa-sliders"></i> Gestão de Instituições</h3>
                <button class="close-modal" onclick="closeModal('adminModal')">&times;</button>
            </div>
            <form id="addInstForm" class="search-box">
                <input type="text" id="newInstInput" class="input-field" placeholder="Nome da Nova Instituição"
                    required>
                <button type="submit" class="btn-submit">Adicionar</button>
            </form>
            <ul id="adminInstList" class="data-list">
                <!-- Injetado por JS -->
            </ul>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2026 Agora<strong>Sei</strong>. Todos os direitos reservados.</p>
    </footer>

    <!-- --- 7. CONTROLADOR JAVASCRIPT NATIVO --- -->
    <script>
        // --- BASE DE DADOS EM MEMÓRIA (MOCK DATA) ---
        let instituicoes = ["Universidade Katyavala Bwila", "Instituto Politécnico Privado Wiliete"];
        let cursos = [
            { nome: "Ciência da Computação", area: "Tecnologias" },
            { nome: "Engenharia Mecânica", area: "Engenharias" },
            { nome: "Gestão de Empresas", area: "Ciências Sociais" }
        ];

        // --- CONTROLO DOS MODAIS ---
        function openModal(id) {
            document.getElementById(id).classList.add('active');
            if (id === 'exploreModal') renderExplorarCursos();
            if (id === 'adminModal') renderGestaoInstituicoes();
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function painel(){
            window.location.href="/dashboard";
        }

        // Eventos de Abertura
        document.getElementById('openExploreBtn').addEventListener('click', () => openModal('exploreModal'));
        document.getElementById('openAdminBtn').addEventListener('click', () => openModal('adminModal'));
        document.getElementById('admin').addEventListener('click',painel);

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

        // --- FUNCIONALIDADE 1: EXPLORAR/FILTRAR CURSOS ---
        const searchInput = document.getElementById('searchCursoInput');
        searchInput.addEventListener('input', renderExplorarCursos);

        function renderExplorarCursos() {
            const termo = searchInput.value.toLowerCase();
            const lista = document.getElementById('exploreCursosList');
            lista.innerHTML = '';

            const filtrados = cursos.filter(c => c.nome.toLowerCase().includes(termo) || c.area.toLowerCase().includes(termo));

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
                        <span style="display:block; font-size:12px; color:var(--gray-500)">Área: ${c.area}</span>
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
                    <span><i class="fa-solid fa-university" style="color:var(--blue-600); margin-right:8px"></i> ${inst}</span>
                    <button class="btn-delete" onclick="eliminarInstituicao(${index})" title="Eliminar">
                        <i class="fa-solid fa-trash"></i>
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