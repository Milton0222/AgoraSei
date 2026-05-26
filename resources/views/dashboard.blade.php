<x-app-layout>
    @section('top')
    Visão Geral do Crescimento
    @endsection
    @section('conteudo')

    <!-- 📊 GRID DE MÉTRICAS (Acompanhar Crescimento e Acessos) -->
    <section class="metrics-grid">

        <!-- Card 1: Total de Visitas -->
        <div class="card-metric">
            <div class="metric-info">
                <p>Total de Acessos</p>
                <h3>14,280</h3>
                <div class="metric-trend">
                    <i class="fa-solid fa-arrow-trend-up"></i> +12% este mês
                </div>
            </div>
            <div class="metric-icon blue-icon">
                <i class="fa-solid fa-eye"></i>
            </div>
        </div>

        <!-- Card 2: Novos Estudantes -->
        <div class="card-metric">
            <div class="metric-info">
                <p>Estudantes Auxiliados</p>
                <h3>1,840</h3>
                <div class="metric-trend">
                    <i class="fa-solid fa-arrow-trend-up"></i> +8.2% esta semana
                </div>
            </div>
            <div class="metric-icon purple-icon">
                <i class="fa-solid fa-user-gradient"></i><i class="fa-solid fa-user-plus"></i>
            </div>
        </div>

        <!-- Card 3: Instituições Cadastradas -->
        <div class="card-metric">
            <div class="metric-info">
                <p>Instituições</p>
                <h3>32</h3>
                <div style="font-size: 0.8rem; color: var(--texto-mutado); margin-top: 4px;">
                    Mapeadas no Sistema
                </div>
            </div>
            <div class="metric-icon green-icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

    </section>

    <!-- 📊 1. SECÇÃO DOS DOIS GRÁFICOS -->
    <section class="charts-grid">

        <!-- Gráfico de Acessos (Linha) -->
        <div class="chart-card">
            <h3><i class="fa-solid fa-chart-area text-blue-600"></i> Volume de Acessos à Plataforma</h3>
            <div class="chart-container">
                <canvas id="graficoAcessos"></canvas>
            </div>
        </div>

        <!-- Gráfico de Cursos (Barras) -->
        <div class="chart-card">
            <h3><i class="fa-solid fa-chart-bar text-indigo-600"></i> Cursos Registados por Área</h3>
            <div class="chart-container">
                <canvas id="graficoCursos"></canvas>
            </div>
        </div>

    </section>

    <!-- 🏛️ SECÇÃO DE GESTÃO DE INSTITUIÇÕES -->
    <section class="data-section">
        <div class="section-header">
            <h2>Gerenciar Instituições de Ensino</h2>
            <button class="btn-primary">
                <i class="fa-solid fa-plus"></i> Nova Instituição
            </button>
        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Instituição</th>
                        <th>Sigla</th>
                        <th>Tipo</th>
                        <th>Departamentos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 500;">Universidade Katyavala Bwila</td>
                        <td style="color: var(--texto-mutado);">UKB</td>
                        <td><span class="badge badge-publica">Pública</span></td>
                        <td>6 Departamentos</td>
                        <td class="actions-cell">
                            <a href="#" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 500;">Instituto Superior Politécnico Privado Wiliete</td>
                        <td style="color: var(--texto-mutado);">ISPPW</td>
                        <td><span class="badge badge-privada">Privada</span></td>
                        <td>4 Departamentos</td>
                        <td class="actions-cell">
                            <a href="#" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 500;">Instituto Superior Politécnico de Benguela</td>
                        <td style="color: var(--texto-mutado);">ISPB</td>
                        <td><span class="badge badge-privada">Privada</span></td>
                        <td>5 Departamentos</td>
                        <td class="actions-cell">
                            <a href="#" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    @endsection


    
</x-app-layout>
<!-- ================= INTERATIVIDADE (JAVASCRIPT) ================= -->
    <script>
        // --- CONTROLO DO MENU DROPDOWN ---
        function toggleDropdown() {
            const dropdown = document.getElementById('menu-instituicao');
            const seta = document.getElementById('menu-seta');

            // Alterna as classes para animar a abertura e rotação da seta
            dropdown.classList.toggle('open');
            seta.classList.toggle('rotate');
        }

        // --- CONFIGURAÇÃO DOS GRÁFICOS (CHART.JS) ---

        // 1. Gráfico de Acessos Mensais (Linhas)
        const ctxAcessos = document.getElementById('graficoAcessos').getContext('2d');
        new Chart(ctxAcessos, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
                datasets: [{
                    label: 'Acessos únicos',
                    data: [1200, 1900, 3200, 4500, 6100], // Simulação de crescimento
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // 2. Gráfico de Cursos Mapeados (Barras)
        const ctxCursos = document.getElementById('graficoCursos').getContext('2d');
        new Chart(ctxCursos, {
            type: 'bar',
            data: {
                labels: ['Saúde', 'Tecnologias', 'Humanidades', 'Economia'],
                datasets: [{
                    label: 'Quantidade de Cursos',
                    data: [8, 14, 6, 9],
                    backgroundColor: '#6366f1',
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>