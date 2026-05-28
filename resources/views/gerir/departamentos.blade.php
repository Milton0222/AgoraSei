<x-app-layout>
    @section('top')
    Gestão de Departamento
    @endsection
    @section('conteudo')
    <!-- SECÇÃO DE GESTÃO DE DEPARTAMENTOS -->
    <section class="data-section">
        <div class="section-header">

            <div class="filtros">
                <input type="text" class="form-control" placeholder="nome ou sigla...">
                <select class="form-control">
                    <option value="">Filtrar por inst</option>
                    <option value="publica">Pública</option>
                    <option value="privada">Privada</option>
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
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 500;">DEI</td>
                        <td style="color: var(--texto-mutado);">UKB</td>
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

<!-- ================= 🔲 COMPONENTE MODAL À DIREITA ================= -->
<!-- Clicar na área escura (overlay) também fecha o modal -->
<div class="modal-overlay" id="institutionModal" onclick="closeModalOutside(event)">

    <div class="modal-right">
        <div class="modal-header">
            <h3><i class="fa-solid fa-square-plus text-blue-600"></i> Registar Departamento</h3>
            <button class="btn-close-modal" onclick="toggleModal(false)"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="modal-body">
            <form id="form-instituicao">
                <div class="form-group">
                    <label for="nome-inst">Nome departamento</label>
                    <input type="text" id="nome-inst" class="form-control" placeholder="Ex: Informática...">
                </div>

                <div class="form-group">
                    <label for="tipo-inst">Instituição</label>
                    <select id="tipo-inst" class="form-control">
                        <option value="publica">Pública</option>
                        <option value="privada">Privada</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button class="btn-secondary" onclick="toggleModal(false)">Cancelar</button>
            <button type="button" class="btn-primary" onclick="salvarFormulario()">Gravar Registo</button>
        </div>
    </div>

</div>