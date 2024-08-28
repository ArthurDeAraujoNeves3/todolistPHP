<main class="content">
	<div class="container-fluid p-0">
		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3><strong>Usuários</strong></h3>
			</div>

			<div class="col-auto ms-auto text-end mt-n1">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
						<li class="breadcrumb-item active" aria-current="page">Usuários</li>
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
								<h5 class="card-title mb-0">Listagem dos Usuários</h5>
							</div>
							<div class="col-md-6 mb-3 text-end">
								<a data-bs-toggle="modal" data-bs-target="#addUser" class="btn btn-secondary"> + Adicionar Usuário</a>
							</div>
							<!-- MODAL ADICIONAR USUARIO -->
							<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											Adicionar Usuário
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<form method="POST">
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12 mb-3">
														<div class="form-group">
															<label for="name" class="form-label">Nome</label>
															<input type="text" id="name" name="name" class="form-control" placeholder="Ex: Joao" required>
														</div>
													</div>
													<div class="col-md-12 mb-3">
														<div class="form-group">
															<label for="email" class="form-label">E-mail</label>
															<input type="text" id="email" name="email" class="form-control" placeholder="Ex: Joao@gmail.com" required>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label for="type_user" class="form-label">Grupo de permissão</label>
															<select name="type_user" id="type_user" class="form-select" required>
																<option disabled>Selecione o tipo</option>
																<?php foreach ($permissions_list as $permission) : ?>
																	<option value="<?= $permission['id']; ?>"><?= $permission['name']; ?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer d-flex justify-content-end">
												<button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Cancelar</button>
												<button type="submit" class="btn btn-info w-25">Adicionar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- FIM MODAL ADICIONAR USUARIO -->
							<hr>
						</div>
					</div>
					<div class="card-body">
						<?php if (isset($Erro) && !empty($Erro)) : ?>
							<div class="row mb-3 d-flex justify-content-center">
								<div class="col-md-3">
									<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										<div class="alert-message">
											<?= $Erro; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php if (isset($success) && !empty($success)) : ?>
							<div class="row mb-3 d-flex justify-content-center">
								<div class="col-md-4">
									<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										<div class="alert-message pe-5">
											<?= $success; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<table id="datatables-reponsive" class="table dataTable no-footer dtr-inline table-hover" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
							<thead>
								<tr>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Grupo de Permissão</th>
									<th>Situação</th>
									<th>Ação</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($users_list)) : ?>
									<?php foreach ($users_list as $user) : ?>
										<tr>
											<td><?= $user['name']; ?></td>
											<td><?= $user['email']; ?></td>
											<td><?= $user['name_group']; ?></td>
											<td class="<?= ($user['situation'] == 1) ? 'table-success' : 'table-danger'; ?>"><?= ($user['situation'] == 1) ? 'Ativo' : 'Inativo'; ?></td>
											<td class="table-action" width="75">
												<a data-bs-toggle="modal" data-bs-target="#editUser<?= $user['id']; ?>" class="ms-2">
													<i data-feather="file-text"></i>
												</a>
											</td>
										</tr>
										<!-- MODAL EDITAR USUARIO -->
										<div class="modal fade" id="editUser<?= $user['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														Alterar Usuário
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<form method="POST">
														<div class="modal-body">
															<div class="row">
																<div class="col-md-12 mb-3">
																	<div class="form-group">
																		<label for="name_edit" class="form-label">Nome</label>
																		<input type="text" id="name_edit" name="name_edit" class="form-control" placeholder="<?= $user['name']; ?>" disabled>
																	</div>
																</div>
																<div class="col-md-12 mb-3">
																	<div class="form-group">
																		<label for="email_edit" class="form-label">E-mail</label>
																		<input type="email" id="email_edit" name="email_edit" class="form-control" placeholder="<?= $user['email']; ?>">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="id_group_edit" class="form-label">Tipo do usuário</label>
																		<select name="id_group_edit" id="id_group_edit" class="form-select" required>
																			<?php foreach ($permissions_list as $permission) : ?>
																				<option value="<?= $permission['id']; ?>" <?= $permission['id'] == $user['id_group'] ? 'selected' : ''; ?>><?= $permission['name']; ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="situation" class="form-label">Situação</label>
																		<select name="situation" id="situation" class="form-select" required>
																			<option value="act" <?= $user['situation'] == 1 ? 'selected' : ''; ?>>Ativo</option>
																			<option value="int" <?= $user['situation'] == 0 ? 'selected' : ''; ?>>Inativo</option>
																		</select>
																	</div>
																</div>
																<input type="hidden" name="id_user_edit" value="<?= $user['id']; ?>">
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
										<!-- FIM MODAL EDITAR USUARIO -->
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