<x-app-layout>
    @section('top')
    Gestão de Curso
    @endsection

    @section('conteudo')

    <!-- SECÇÃO DE GESTÃO DE CURCOS -->
    <section class="data-section">
        <div class="section-header">

            <div class="filtros">
                <input type="email" id="fillteremail" class="form-control" placeholder="nome de utilizador...">
                <select class="form-control" id="filltertipo">
                    <option value="">Filtrar por Tipo</option>
                    <option value="1">Administrador</option>
                    <option value="2">Estudante</option>
                </select>
            </div>

            <!-- Gatilho para abrir o modal chamando a função JavaScript -->
            <button class="btn-primary" onclick="toggleModal(true)">
                <i class="fa-solid fa-plus"></i> Novo Utilizador
            </button>

        </div>

        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nome de Utilizador</th>
                        <th>Tipo</th>
                        <th>Data de Ingresso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $cur)
                    <tr>
                        <td style="font-weight: 500;">{{$cur->name}}</td>
                        <td style="color: var(--texto-mutado);">{{$cur->email}}</td>
                        <td>
                            @if($cur->isAdmin)
                            Administrador.
                            @elseif($cur->isEst)
                            Estudante.
                            @endif
                        </td>
                        <td>{{$cur->created_at}}</td>
                        <td class="actions-cell">
                            <a onclick="actualizar('{{$cur->id}}','{{$cur->name}}','{{$cur->email}}')" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a onclick="apagar('{{$cur->name}}','{{$cur->id}}','{{$cur->email}}')" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
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
            <h3 id="modal-titulo"> Registar Utilizador</h3>
            <button class="btn-close-modal" onclick="toggleModal(false)"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modal-body">
            <form id="form-curso" action="{{route('user.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nome-inst">Nome (<strong id="alerta" style="color: red;">*</strong>)</label>
                    <input type="text" id="name" required name="name" class="form-control" placeholder="Ex: Mvita Zankulu...">
                </div>
                <div class="form-group">
                    <label for="nome-inst">Tipo de Utilizador(<strong style="color: red;">*</strong>)</label>
                    <select name="tipo" class="form-control" id="tipo" required>
                        <option value="">Selecionar</option>
                        <option value="1">Administrador</option>
                        <option value="2">Estudante</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="sigla-inst">Nome de Utilizador(<strong style="color: red;">*</strong>)</label>
                    <input type="email" name="email" id="email" class="form-control">
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
    //filtrar user

    function buscar() {
        const email = document.getElementById('fillteremail').value;
        const tipo = document.getElementById('filltertipo').value;

        if (!email && !tipo) {
            return;
        }
        const params = new URLSearchParams();

        if (email) params.append('email', email);
        if (tipo) params.append('tipo', tipo);
        window.location.href = '/Users?' + params.toString();
    }
    document.getElementById('fillteremail')?.addEventListener('input', buscar);
    document.getElementById('filltertipo')?.addEventListener('change', buscar);
    //actualizar dados

    function actualizar(id, name, email) {
        document.getElementById('institutionModal').classList.add('active');

        document.getElementById('modal-titulo').textContent = `Actualizar dados de ${name}`;
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;

        const formEditar = document.getElementById('form-curso');
        formEditar.method = 'post';
        formEditar.action = `/User/${id}`;

        let methodInput = formEditar.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formEditar.appendChild(methodInput);
        }
        methodInput.value = 'PUT';

    }

    //apagar utilizador
    function apagar(name, id) {

        if (confirm(`Deseja apagar o utilizador ${name}`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/User/${id}`;

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
        const nome = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const tipo = document.getElementById('tipo').value;

        if (!nome || !email || !tipo) {
            alert('Preencher os campos obrigatórios (*).');
            return;
        } else {
            document.getElementById('form-curso').submit();
            toggleModal(false);
            document.getElementById('form-curso').reset();

        }

    }
</script>