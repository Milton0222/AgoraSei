<x-app-layout>
    @section('top')
    Gestão de Departamento
    @endsection
    @section('conteudo')
    <!-- SECÇÃO DE GESTÃO DE DEPARTAMENTOS -->
    <section class="data-section">
        <div class="section-header">

            <div class="filtros">
                <input type="text" id="fillternome" class="form-control" placeholder="nome...">
                <select class="form-control" id="fillterinst">
                    <option value="">Filtrar por inst</option>
                    @foreach ($inst as $lista)
                    <option value="{{$lista->id}}">{{$lista->descricao}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gatilho para abrir o modal chamando a função JavaScript -->
            <button class="btn-primary" onclick="toggleModal(true)">
                <i class="fa-solid fa-plus"></i> Novo Departamento
            </button>



        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Instituição</th>
                        <th>Data de Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($depa as $depas)
                    <tr>
                        <td style="font-weight: 500;">{{$depas->nome}}</td>
                        <td style="color: var(--texto-mutado);">{{$depas->descricao}}</td>
                        <td>{{$depas->created_at}}</td>
                        <td class="actions-cell">
                            <a onclick="actualizar('{{$depas->id}}','{{$depas->nome}}','{{$depas->inst_id}}')" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a onclick="apagar('{{$depas->id}}','{{$depas->nome}}')" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
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
            <h3 id="modal-titulo"> Registar Departamento</h3>
            <button class="btn-close-modal" onclick="toggleModal(false)"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modal-body">
            <form id="form-depa" action="{{route('depa.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nome-inst">Nome departamento(<strong id="alerta" style="color: red;">*</strong>)</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Ex: Informática...">
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
            <button type="button" class="btn-primary" onclick="salvarFormulariod()">Gravar Registo</button>
        </div>
    </div>

</div>

<script>
    //buscar dados

    function buscar() {
        const nome = document.getElementById('fillternome').value;
        const inst_id = document.getElementById('fillterinst').value;

        if (!nome && !inst_id) {
            return;
        }

        const params = new URLSearchParams();

        if (nome) params.append('nome', nome);
        if (inst_id) params.append('inst_id',inst_id);

        window.location.href = '/Depa?' + params.toString();

    }

    document.getElementById('fillternome')?.addEventListener('input', buscar);
    document.getElementById('fillterinst')?.addEventListener('change', buscar);
    //actualizar dados

    function actualizar(id, nome, inst_id) {
        //alert(`${id}, ${nome}, ${inst_id}`);

        //abrir modal actualizar
        document.getElementById('institutionModal').classList.add('active');

        document.getElementById('modal-titulo').textContent = `Editar dados de ${nome}`;

        //visualizar dados nos inputs
        document.getElementById('nome').value = nome;
        document.getElementById('inst_id').value = inst_id;

        const formEdit = document.getElementById('form-depa');
        formEdit.method = "POST";
        formEdit.action = `/Depa/${id}`;


        let methodInput = formEdit.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formEdit.appendChild(methodInput);
        }
        methodInput.value = 'PUT';


    }
    //submeter formulario d
    function salvarFormulariod() {

        const nome = document.getElementById('nome').value;
        const inst_id = document.getElementById('inst_id').value;



        if (!nome && !inst_id) {
            alert("Preencher campos obrigatórios(*)");
            return;
        }
        document.getElementById('form-depa').submit();
        toggleModal(false);
        document.getElementById('form-instituicao').reset();

    }

    //apagar dados

    function apagar(id, nome) {
        if (confirm(`Desejas apagar o departamento, ${nome}`) && id) {

            const form = document.createElement('form');
            form.method = "post";
            form.action = `/Depa/${id}`;

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