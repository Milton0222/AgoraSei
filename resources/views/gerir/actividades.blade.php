<x-app-layout>


    @section('top')
    Gestão de Actividades
    @endsection

    @section('conteudo')

    <!-- SECÇÃO DE GESTÃO DE CURCOS -->
    <section class="data-section">
        <div class="section-header">

            <div class="filtros">
                <input type="text" id="fillternome" class="form-control" placeholder="descrição...">
                <select class="form-control" id="fillterinst">
                    <option value="">Filtrar por Inst</option>
                    @foreach ($inst as $lista)
                    <option value="{{$lista->id}}">{{$lista->descricao}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gatilho para abrir o modal chamando a função JavaScript -->
            <button class="btn-primary" onclick="toggleModal(true)">
                <i class="fa-solid fa-plus"></i> Novo Actividade
            </button>

        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>

                    <tr>
                        <th>Descrição</th>
                        <th>Instituição</th>
                        <th>Data de Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activ as $activs)
                    <tr>
                        <td style="font-weight: 500;">{{$activs->descricao}}</td>
                        <td style="color: var(--texto-mutado);">{{$activs->nome}}</td>
                        <td>{{$activs->created_at}}</td>
                        <td class="actions-cell">
                            <a onclick="actualizar('{{$activs->descricao}}','{{$activs->id}}','{{$activs->inst_id}}')" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a onclick="apagar('{{$activs->id}}')" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
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
            <h3 id="modal-titulo"> Registar Actividades</h3>
            <button class="btn-close-modal" onclick="toggleModal(false)"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modal-body">
            <form id="form-activi" action="{{route('activi.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="sigla-inst">Descrição do evento/Actividade(<strong id="alerta" style="color: red;">*</strong>)</label>
                    <textarea id="descricao" cols="30" rows="8" name="descricao" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="tipo-inst">Instituição(<strong id="alerta" style="color: red;">*</strong>)</label>
                    <select id="inst_id" name="inst_id" class="form-control">
                        <option value="">Selecionar Inst</option>
                        @foreach ($inst as $lista)
                        <option value="{{$lista->id}}">{{$lista->descricao}}</option>
                        @endforeach
                    </select>
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
    //actualizar
    function actualizar(descricao, id, inst_id) {

        //abrir modal
        document.getElementById('institutionModal').classList.add('active');
        //modificar modal
        document.getElementById('modal-titulo').textContent = `Actualizar dados da activiada ${id}`;
        document.getElementById('descricao').value = descricao;
        document.getElementById('inst_id').value = inst_id;

        //alterar formulario
        const formedit = document.getElementById('form-activi');
        formedit.method = 'post';
        formedit.action = `/Activi/${id}`;

        let methodInput = formedit.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formedit.appendChild(methodInput);
        }
        methodInput.value = 'PUT';
    }
    //apagar actividade

    function apagar(id) {
        if (confirm(`Deseja apagar a actividade com o ID ${id} ?`)) {
            // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/Activi/${id}`;

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
    //buscar 
    function buscar() {
        const nome = document.getElementById('fillternome').value;
        const id = document.getElementById('fillterinst').value;

        if (!nome && !id) {
            return;
        }
        const params = new URLSearchParams();

        if (nome) params.append('nome', nome);
        if (id) params.append('id', id);
        window.location.href = '/Activ?' + params.toString();
    }
    //listenner
    document.getElementById('fillternome')?.addEventListener('input', buscar);
    document.getElementById('fillterinst')?.addEventListener('change', buscar);

    //submeter form
    function salvar() {
        const inst_id = document.getElementById('inst_id').value;
        const desc = document.getElementById('descricao').value;

        if (!inst_id || !desc) {
            alert('Preencher os campos obrigatorios (*)');
            return;
        } else {
            document.getElementById('form-activi').submit();
            toggleModal(false);
            document.getElementById('form-activi').reset();
        }



    }
</script>