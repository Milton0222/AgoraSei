<x-app-layout>

    @section('top')
    Gestão de Curso
    @endsection

    @section('conteudo')

    <!-- SECÇÃO DE GESTÃO DE CURCOS -->
    <section class="data-section">
        <div class="section-header">

            <div class="filtros">
                <input type="text" id="fillternome" class="form-control" placeholder="nome curso...">
                <select class="form-control" id="fillterdepa">
                    <option value="">Filtrar por depa</option>
                    @foreach ($depa as $dep)
                    <option value="{{$dep->id}}">{{$dep->nome}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gatilho para abrir o modal chamando a função JavaScript -->
            <button class="btn-primary" onclick="toggleModal(true)">
                <i class="fa-solid fa-plus"></i> Novo Curso
            </button>

        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Nivel</th>
                        <th>Mensalidade</th>
                        <th>Duração</th>
                        <th>Data de Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($curso as $cur)
                    <tr>
                        <td style="font-weight: 500;">{{$cur->nome}}</td>
                        <td style="color: var(--texto-mutado);">{{$cur->nivel_academico}}</td>
                        <td>{{$cur->mensalidade}}</td>
                        <td>{{$cur->duracao}} Anos</td>
                        <td>{{$cur->created_at}}</td>
                        <td class="actions-cell">
                            <a onclick="actualizar('{{$cur->id}}','{{$cur->nome}}','{{$cur->mensalidade}}', '{{$cur->duracao}}','{{$cur->area_conhecimento}}','{{$cur->qtd_vaga}}','{{$cur->qtd_disciplina}}', '{{$cur->depa_id}}', '{{$cur->nivel_academico}}','{{$cur->perfil_saida}}')" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a onclick="apagar('{{$cur->nome}}','{{$cur->id}}')" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endsection
</x-app-layout>

<!-- ================= 🔲 COMPONENTE MODAL À DIREITA ================= -->
<!-- Clicar na área escura (overlay) também fecha o modal -->
<div class="modal-overlay" id="institutionModal" onclick="closeModalOutside(event)">

    <div class="modal-right">
        <div class="modal-header">
            <i class="fa-solid fa-square-plus text-blue-600"></i>
            <h3 id="modal-titulo"> Registar Curso</h3>
            <button class="btn-close-modal" onclick="toggleModal(false)"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modal-body">
            <form id="form-curso" action="{{route('curso.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nome-inst">Nome do curso (<strong id="alerta" style="color: red;">*</strong>)</label>
                    <input type="text" id="nome" required name="nome" class="form-control" placeholder="Ex: C.computação...">
                </div>
                <div class="form-group">
                    <label for="nome-inst">Departamento(<strong style="color: red;">*</strong>)</label>
                    <select name="depa_id" class="form-control" id="depa_id" required>
                        <option value="">Selecionar</option>
                        @foreach ($depa as $dep)
                        <option value="{{$dep->id}}">{{$dep->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sigla-inst">Duração do curso</label>
                    <input type="number" id="duracao" name="duracao" class="form-control" placeholder="Investimento total">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="sigla-inst">Mensalidade</label>
                            <input type="number" id="mensalidade" name="mensalidade" class="form-control" placeholder="Ex: Investimento mensal">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="tipo-inst">Nivel Académico(<strong style="color: red;">*</strong>)</label>
                            <select name="nivel_academico" id="nivel_academico" class="form-control">
                                <option value="">Selecionar</option>
                                <option value="Doutoramento">Doutoramento</option>
                                <option value="Pós Graduação">Pós Graduação</option>
                                <option value="Mestrado">Mestrado</option>
                                <option value="Licenciado">Licenciado</option>
                                <option value="Bacharel">Bacharel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="sigla-inst">Disciplinas</label>
                            <input type="number" id="qtd_disciplina" name="qtd_disciplina" class="form-control" placeholder="Ex: Total de disciplinas">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="sigla-inst">Vagas disponiveis</label>
                            <input type="number" id="qtd_vaga" name="qtd_vaga" class="form-control" placeholder="Ex: Total de vagas por lectivo">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sigla-inst">Área de conhecimento(<strong style="color: red;">*</strong>)</label>
                    <input type="text" name="area_conhecimento" id="area_conhecimento" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sigla-inst">Perfil de Saida</label>
                    <textarea id="perfil_saida" cols="30" rows="3" name="perfil_saida" class="form-control"></textarea>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button class="btn-secondary" onclick="toggleModal(false)">Cancelar</button>
            <button type="button" class="btn-primary" onclick="salvar()">Gravar Registo</button>
        </div>
    </div>

</div>

<script>
    //buscar

    function buscar() {
        const nome = document.getElementById('fillternome').value;
        const depa_id = document.getElementById('fillterdepa').value;

        if (!nome && !depa_id) {
            return;
        }
        const params = new URLSearchParams();

        if (nome) params.append('nome', nome);
        if (depa_id) params.append('depa_id', depa_id);
        window.location.href = '/Curso?' + params.toString();
    }

    //eventListenner
    document.getElementById('fillternome')?.addEventListener('input', buscar);
    document.getElementById('fillterdepa')?.addEventListener('change',buscar);
    //atualizar curso 

    function actualizar(id, nome, mensalidade, duracao, area_conhecimento, qtd_vagas, qtd_disciplina, depa_id, nivel_academico,perfil_saida) {
        document.getElementById('institutionModal').classList.add('active');

        document.getElementById('modal-titulo').textContent = `Atualizar, ${nome}.`;
        document.getElementById('nome').value = nome;
        document.getElementById('mensalidade').value = mensalidade;
        document.getElementById('duracao').value = duracao;
        document.getElementById('area_conhecimento').value = area_conhecimento;
        document.getElementById('qtd_vaga').value = qtd_vagas;
        document.getElementById('qtd_disciplina').value = qtd_disciplina;
        document.getElementById('depa_id').value = depa_id;
        document.getElementById('nivel_academico').value = nivel_academico;
        document.getElementById('perfil_saida').value = perfil_saida;


        const formEditar = document.getElementById('form-curso');
        formEditar.method = 'post';
        formEditar.action = `/Curso/${id}`;

        let methodInput = formEditar.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formEditar.appendChild(methodInput);
        }
        methodInput.value = 'PUT';
    }
    //apagar curso

    function apagar(nome, id) {
        if (confirm(`Deseja a pagar o curso ${nome}`)) {
            // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/Curso/${id}`;

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

    //submeter formulario
    function salvar() {
        const nome = document.getElementById('nome').value;
        const depa_id = document.getElementById('depa_id').value;
        const area = document.getElementById('area_conhecimento').value;
        const nivel_academico = document.getElementById('nivel_academico').value;

        if (!nome || !depa_id || !area || !nivel_academico) {
            alert('Preencher os campos obrigatórios (*).');
            return;
        } else {
            document.getElementById('form-curso').submit();
            toggleModal(false);
            document.getElementById('form-curso').reset();

        }

    }
</script>