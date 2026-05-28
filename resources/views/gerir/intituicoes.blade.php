<x-app-layout>
    @section('top')
    Gestão de Instituições
    @endsection
    @section('conteudo')
    <!-- SECÇÃO DE GESTÃO DE INSTITUIÇÕES -->
    <section class="data-section">
        <div class="section-header">

            <div class="filtros">
                <input type="text" class="form-control" id="filterdescricao" placeholder="nome ou sigla...">
                <select class="form-control" id="filtertipo">
                    <option value="">Filtrar por tipo</option>
                    <option value="Publica">Pública</option>
                    <option value="Privada">Privada</option>
                </select>
            </div>

            <!-- Gatilho para abrir o modal chamando a função JavaScript -->
            <button class="btn-primary" onclick="toggleModal(true)">
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
                    @foreach ($inst as $insts)
                    <tr>
                        <td style="font-weight: 500;">{{$insts->descricao}}</td>
                        <td style="color: var(--texto-mutado);">...</td>
                        <td>
                            @if($insts->tipo=='Publica')
                            <span class="badge badge-publica">{{$insts->tipo}}</span>
                            @else
                            <span class="badge badge-privada">{{$insts->tipo}}</span>
                            @endif
                        </td>
                        <td>.......</td>
                        <td class="actions-cell">
                            <a onclick="actualizar('{{$insts->instagram}}','{{$insts->linha_atendimento}}','{{$insts->whatsap}}','{{$insts->facebook}}','{{$insts->site}}','{{$insts->inicio_funcao}}','{{$insts->estado}}','{{$insts->amibiente_campus}}','{{$insts->reconhecido}}','{{$insts->modalidade_estudo}}','{{$insts->qtd_professor}}','{{$insts->qtd_estudante}}','{{$insts->localizacao}}','{{$insts->provincia}}','{{$insts->custo_licenciatura}}','{{$insts->descricao}}','{{$insts->id}}','{{$insts->tipo}}')" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a onclick="apagar('{{$insts->descricao}}','{{$insts->id}}')" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </section>

    @endsection

    <!-- ================= 🔲 COMPONENTE MODAL À DIREITA ================= -->
    <!-- Clicar na área escura (overlay) também fecha o modal -->
    <div class="modal-overlay" id="institutionModal" onclick="closeModalOutside(event)">

        <div class="modal-right">
            <div class="modal-header">
                <i class="fa-solid fa-square-plus text-blue-600"></i>
                <h3 id="modal-titulo"> Registar Instituição</h3>
                <button class="btn-close-modal" onclick="toggleModal(false)"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <form id="form-instituicao" action="{{route('inst.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nome-inst">Nome da Instituição (<strong id="alerta" style="color: red;">*</strong>)</label>
                        <input type="text" id="descricao" required name="descricao" class="form-control" placeholder="Ex: Instituto Superior Politécnico...">
                    </div>
                    <div class="form-group">
                        <label for="nome-inst">Tipo de Instituição(<strong style="color: red;">*</strong>)</label>
                        <select name="tipo" class="form-control" id="tipo" required>
                            <option value="">Selecionar</option>
                            <option value="Publica">Publica</option>
                            <option value="Privada">Privada</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sigla-inst">Custo Licenciatura</label>
                        <input type="number" id="custo_licenciatura" name="custo_licenciatura" class="form-control" placeholder="Investimento total">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="sigla-inst">Provincia</label>
                                <input type="text" id="provincia" name="provincia" class="form-control" placeholder="Ex: Benguela">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="sigla-inst">Localização(<strong style="color: red;">*</strong>)</label>
                                <input type="text" id="localizacao" required name="localizacao" class="form-control" placeholder="Ex: Municipio/Rua/Edificio">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="sigla-inst">Estudantes</label>
                                <input type="number" id="qtd_estudante" name="qtd_estudante" class="form-control" placeholder="Ex: Total de estudantes matriculados">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="sigla-inst">Professores</label>
                                <input type="number" id="qtd_professor" name="qtd_professor" class="form-control" placeholder="Ex: Total de professor">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo-inst">Modalidade de Estudo(<strong style="color: red;">*</strong>)</label>
                        <select id="modalidade_estudo" required name="modalidade_estudo" class="form-control">
                            <option value="">Selecionar</option>
                            <option value="Online">Online</option>
                            <option value="Presêncial">Presêncial</option>
                            <option value="Semi-Presêncial">Semi-Presêncial</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="sigla-inst">Data de Criação(<strong style="color: red;">*</strong>)</label>
                                <input type="date" id="inicio_funcao" required name="inicio_funcao" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="sigla-inst">Decreto Presidencial(<strong style="color: red;">*</strong>)</label>
                                <input type="text" id="reconhecido" required name="reconhecido" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="local-inst">Linha de atendimento(<strong style="color: red;">*</strong>)</label>
                        <input type="number" id="linha_atendimento" required name="linha_atendimento" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="local-inst">Instagram</label>
                                <input type="text" id="instagram" name="instagram" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="local-inst">URL do site</label>
                                <input type="text" id="site" name="site" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="local-inst">Whatsap</label>
                                <input type="text" id="whatsap" name="whatsap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="local-inst">Facebook</label>
                                <input type="text" id="facebook" name="facebook" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sigla-inst">Ambiente no Campus</label>
                        <textarea id="ambiente_campus" cols="30" rows="3" name="ambiente_campus" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="toggleModal(false)">Cancelar</button>
                <button type="button" class="btn-primary" onclick="salvarFormulario()">Gravar Registo</button>
            </div>
        </div>

    </div>
</x-app-layout>

<script>
    //filtrar instituicao

    function buscar() {
        const nome = document.getElementById('filterdescricao').value;
        const tipo = document.getElementById('filtertipo').value;

        if (!nome && !tipo) {
            return;
        }

        const params = new URLSearchParams();
        if (nome) params.append('nome', nome);
        if (tipo) params.append('tipo', tipo);

        window.location.href = '/inst?' + params.toString();
    }
    document.getElementById('filterdescricao')?.addEventListener('input', buscar);
    document.getElementById('filtertipo')?.addEventListener('change', buscar);

    //actualizar inst

    function actualizar(instagram, linha_atendimento, whatsap, facebook, site, inicio_funcao, estado, ambiente_campus, reconhecido, modalidade_estudo, qtd_professor, qtd_estudante, localizacao, provincia, custo_licenciatura, descricao, id, tipo) {
        //alert(`${descricao}, ${tipo}, ${ambiente_campus}`);
        document.getElementById('institutionModal').classList.add('active');

        document.getElementById('modal-titulo').textContent = `Editando dados de, ${descricao}`;

        //alterando formulario
        const formEdit = document.getElementById('form-instituicao');
        formEdit.method = 'POST';
        formEdit.action = `/inst/${id}`;


        //visualizar dados dos inputs
        document.getElementById('descricao').value = descricao;
        document.getElementById('tipo').value = tipo;
        document.getElementById('custo_licenciatura').value = custo_licenciatura;
        document.getElementById('provincia').value = provincia;
        document.getElementById('localizacao').value = localizacao;
        document.getElementById('ambiente_campus').value = ambiente_campus;
        document.getElementById('modalidade_estudo').value = modalidade_estudo;
        document.getElementById('qtd_estudante').value = qtd_estudante;
        document.getElementById('qtd_professor').value = qtd_professor;
        document.getElementById('reconhecido').value = reconhecido;
        document.getElementById('inicio_funcao').value = inicio_funcao;
        document.getElementById('linha_atendimento').value = linha_atendimento;
        document.getElementById('instagram').value = instagram;
        document.getElementById('whatsap').value = whatsap;
        document.getElementById('facebook').value = facebook;

        let methodInput = formEdit.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formEdit.appendChild(methodInput);
        }
        methodInput.value = 'PUT';

    }

    //apagar inst

    function apagar(descricao, id) {
        const confirmar = confirm('Tem certeza que deseja deletar esta Instituição?');

        if (confirmar && id) {
            // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/inst/${id}`;

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
</script>