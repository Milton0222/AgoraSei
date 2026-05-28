<x-app-layout>
     

    @section('top')
    Gestão de Actividades
    @endsection

    @section('conteudo')

    <!-- SECÇÃO DE GESTÃO DE CURCOS -->
    <section class="data-section">
        <div class="section-header">

            <div class="filtros">
                <input type="text" id="fillternome" class="form-control" placeholder="nome...">
                <select class="form-control" id="fillterinst">
                    <option value="">Filtrar por Inst</option>
                    <option value=""></option>

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
                        <th>Nome</th>
                        <th>Instituição</th>
                        <th>Data de Cadastro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td style="font-weight: 500;">..</td>
                        <td style="color: var(--texto-mutado);">..</td>
                        <td>..</td>
                        <td class="actions-cell">
                            <a onclick="" class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a onclick="" class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </section>

    @endsection
</x-app-layout>
