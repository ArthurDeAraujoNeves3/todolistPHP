<main class="content">
	<div class="container-fluid p-0">

		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3><strong>Parâmetros</strong></h3>
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
								<h5 class="card-title mb-0">Params</h5>
							</div>
							<div class="col-md-6 text-end">
								<a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addParams">Novo Parâmetro</a>
							</div>
							<!-- MODAL EDITAR PARAMETRO -->
							<div class="modal fade" id="addParams" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											Adicionar Parâmetro
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form method="POST">
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12 mb-3">
														<div class="form-group">
															<label for="params_name" class="form-label">Nome do Parâmetro</label>
															<input type="text" class="form-control" name="params_name" id="params_name" placeholder="Digite o nome do parâmetro" required>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label for="params_description" class="form-label">Descrição do Parâmetro</label>
															<input type="text" class="form-control" name="params_description" id="params_description" placeholder="Digite uma descrição para o parâmetro" required>
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer d-flex justify-content-end">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
												<button type="submit" class="btn btn-info">Adicionar Parametro</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- FIM MODAL EDITAR PARAMETRO -->
						</div>
						<hr>
					</div>
					<div class="card-body">
						<table id="datatables-reponsive" class="table dataTable no-footer dtr-inline table-hover" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
							<thead>
								<tr>
									<th>Parâmetro</th>
									<th>Descrição</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($params_list)) : ?>
									<?php foreach ($params_list as $params) : ?>
										<tr>
											<td width="100"><?= $params['name']; ?></td>
											<td><?= $params['description']; ?></td>
											<td class="table-action" width="75">
												<a data-bs-toggle="modal" data-bs-target="#editParams<?= $params['id']; ?>" class="ms-2">
													<i class="text-info" data-feather="edit"></i>
												</a>
											</td>
										</tr>
										<!-- MODAL EDITAR PARAMETRO -->
										<div class="modal fade" id="editParams<?= $params['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														Editar Parâmetro
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<form method="POST">
														<div class="modal-body">
															<div class="row">
																<div class="col-md-12 mb-3">
																	<div class="form-group">
																		<label for="params_name_edit" class="form-label">Nome do Parâmetro</label>
																		<input type="text" class="form-control" name="params_name_edit" id="params_name_edit" value="<?= $params['name'];?>" required>
																		<input type="hidden" name="id_params" id="id_params" value="<?= $params['id'];?>" required>
																	</div>
																</div>
																<div class="col-md-12 mb-3">
																	<div class="form-group">
																		<label for="params_description_edit" class="form-label">Descrição do Parâmetro</label>
																		<input type="text" class="form-control" name="params_description_edit" id="params_description_edit" value="<?= $params['description'];?>" required>
																	</div>
																</div>
																<div class="col-md-12">
																	<hr>
																	<h3>ATENÇÃO</h3>
																	<p class="text-muted fs-5">Ao Editar o nome do parâmetro, certifique-se que foram feita as devidas modificações no codigo fonte do software, pois a modificação tera um impacto no funcionamento do software.</p>
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
										<!-- FIM MODAL EDITAR PARAMETRO -->
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