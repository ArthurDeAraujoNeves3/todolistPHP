<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Grupo de Permissões</strong></h3>
            </div>
            <div class="col-auto ms-auto text-end mt-n1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title mb-0">Empty card</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addGroup">Novo Grupo</a>
                                <a href="<?= BASE_URL . 'Permissions/addParams'; ?>" class="btn btn-secondary">Novo Parâmetro</a>
                            </div>
                            <!-- MODAL ADICIONAR GRUPO -->
                            <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Novo Grupo
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group">
                                                            <label for="group_name" class="form-label">Nome do Grupo</label>
                                                            <input type="text" class="form-control" name="group_name" id="group_name" placeholder="Digite o nome do grupo de permissão" required>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-12">
                                                        <?php foreach ($params_list as $params) : ?>
                                                            <div class="form-check form-switch ms-2">
                                                                <input class="form-check-input" type="checkbox" id="_add<?= $params['id']; ?>" name="params[]" value="<?= $params['id']; ?>">
                                                                <label class="form-check-label" for="params_add<?= $params['id']; ?>"><?= $params['description']; ?></label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-info">Gravar Alterações</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- FIM MODAL ADICIONAR GRUPO -->
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table dataTable no-footer dtr-inline table-hover" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($group_list)) : ?>
                                    <?php foreach ($group_list as $group) : ?>
                                        <tr>
                                            <td><?= $group['name']; ?></td>
                                            <td class="table-action" width="75">
                                                <a data-bs-toggle="modal" data-bs-target="#editGroup<?= $group['id']; ?>" class="ms-2">
                                                    <i class="text-info" data-feather="edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- MODAL EDITAR GRUPO -->
                                        <div class="modal fade" id="editGroup<?= $group['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Alterar Grupo
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="group_name<?= $group['id'];?>" class="form-label">Nome do Grupo</label>
                                                                        <input type="text" class="form-control" name="group_name_edit" id="group_name<?= $group['id'];?>" value="<?= $group['name'] ;?>">
                                                                        <input type="hidden" name="id_group" value="<?= $group['id'] ;?>">
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="col-md-12">
                                                                    <?php foreach ($params_list as $params) : ?>
                                                                        <div class="form-check form-switch ms-2">
                                                                            <input class="form-check-input" type="checkbox" id="params_edit<?= $group['id'].$params['id']; ?>" name="params_edit[]" value="<?= $params['id']; ?>" <?= (in_array($params['id'], explode(',', $group['params'])) ? 'checked' : '') ?>>
                                                                            <label class="form-check-label" for="params_edit<?= $group['id'].$params['id']; ?>"><?= $params['description']; ?></label>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-end">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-warning">Gravar Alterações</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIM MODAL EDITAR GRUPO -->
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>