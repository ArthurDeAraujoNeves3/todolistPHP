<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo BASE_URL . '/Public/assets/img/Logo/Todoist.png'?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/Public/Bootstrap/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/Public/index.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/Public/styles/Home/HomeStyle.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Hoje – Todoist</title>
</head>

<body>

    <div id="ModalBg" class="ModalBg d-none" style="z-index: 50;">

        <form method="post" id="ModalDelete" class="ModalDelete">

            <section class="message">

                <p class="text-white text-truncate"></p>

            </section> <!--Alerta-->

            <section class="d-flex align-items-center justify-content-end">

                <article class="d-flex align-items-center gap-1">

                    <button onclick="" type="button" class="form-control btn btn-secondary">

                        <p class="d-flex m-0">Cancelar</p>

                    </button> <!--Cancelar-->

                    <button type="submit" name="delete" value="" class="form-control btn-primary">

                        <p class="d-flex m-0">Excluir</p>

                    </button> <!--Excluir-->

                </article>

            </section> <!--Botões-->

        </form>

    </div> <!--Modal para deletar-->

    <div id="ModalBg" class="ModalBg <?= $seeDetails ? 'd-flex' : 'd-none' ?>">

        <div id="ModalSeeDetails" class="ModalSeeDetails">

            <header class="d-flex align-items-center px-2 justify-content-between">

                <section class="d-flex align-items-center gap-2 text-white Title">

                    <i class="bi bi-inbox"></i>
                    <p class="m-0">Projeto</p>

                </section> <!--Titulo-->

                <section class="Btns">

                    <a href="<?php echo BASE_URL . "Home" ?>">

                        <i class="bi bi-x-lg"></i>

                    </a>

                </section> <!--Buttons-->

            </header> <!--Topo-->

            <section class="d-flex mt-5">

                <article class="d-flex align-items-start gap-2 Conteudo">

                    <form method="post">

                        <button type="submit" name="<?= !isset($_GET['tasks']) && !isset($_GET['subtasks']) ? 'changeStatus' : (isset($_GET["subtasks"]) ? 'changeStatusSubTask' : 'changeStatusTask') ?>" value="<?= $productDetails['id'] ?>" class="<?= $productDetails['status'] == 1 ? 'MarkBtnCorrect' : 'MarkBtn' ?>">

                            <i class='<?= $productDetails['status'] == 1 ? 'MarkBtnIconChecked' : 'MarkBtnIcon' ?> bi bi-check2 m-0'></i>

                        </button>

                    </form> <!--Marcar como concluído-->

                    <section class="d-flex flex-column gap-3">

                        <article class="d-flex flex-column">

                            <p class="<?= $productDetails['status'] == 1 ? 'text-decoration-line-through' : '' ?> text-white fs-6 m-0"><?= $productDetails["name"] ?></p>
                            <p class="<?= $productDetails['status'] == 1 ? 'text-decoration-line-through' : '' ?> SubTitle m-0"><?= $productDetails["desc"] ?></p>

                        </article> <!--Textos-->

                        <article id="tasks" class="d-flex flex-column gap-2 mt-3">

                            <?php foreach ($projectTasks as $project): ?>

                                <?php

                                $name = $project["name"];
                                $desc = $project["description"];
                                $id = $project["id"];

                                $urlDetails = isset($_GET["tasks"]) ? BASE_URL . "Home/?name=$name&desc=$desc&subtasks=true&id=$id" : BASE_URL . "Home/?name=$name&desc=$desc&tasks=true&id=$id";

                                ?> <!--Url personalizada para ver os detalhes-->

                                <section id="<?= $project['id'] ?>" class="d-flex align-items-center justify-content-between text-white Project">

                                    <a href="<?= $urlDetails ?>" class="d-flex align-items-start gap-2">

                                        <form method="post">

                                            <button type="submit" name="<?= isset($_GET["tasks"]) ? 'changeStatusSubTask' : 'changeStatusTask' ?>" value="<?= $project["id"] ?>" class="<?= $project['status'] == 1 ? 'MarkBtnCorrect' : 'MarkBtn' ?>">

                                                <i class="bi bi-check2 m-0 <?= $project['status'] == 1 ? 'MarkBtnIconChecked' : 'MarkBtnIcon' ?>"></i>

                                            </button>

                                        </form> <!--Btn para marcar projeto como concluído-->

                                        <article class="d-flex flex-column Informations">

                                            <section class="d-flex align-items-center justify-content-between">

                                                <p class="<?= $project['status'] == 1 ? 'text-decoration-line-through' : '' ?> m-0 text-truncate"><?= $project["name"] ?></p>

                                            </section> <!--Nome-->

                                            <p class="<?= $project['status'] == 1 ? 'text-decoration-line-through' : '' ?> m-0 text-truncate SubTitle"><?= $project["description"] ?></p>

                                        </article> <!--Nome, descrição e os botões-->

                                    </a>

                                    <section class="d-none align-items-center gap-1 Btns">

                                        <div onclick="<?= isset($_GET["tasks"]) ? 'editSubTask' : 'editTask' ?>( '<?= $project['id'] ?>', '<?= $project['name'] ?>', '<?= $project['description'] ?>' )" class="ProjectBtn">

                                            <i class="bi bi-pen"></i>

                                        </div> <!--Editar-->

                                        <div onclick="<?= isset($_GET["tasks"]) ? 'deleteSubTask' : 'deleteTask' ?>( '<?= $project['id'] ?>', '<?= $project['name'] ?>', '<?= $project['description'] ?>' )" class="ProjectBtn">

                                            <i class="bi bi-trash3 text-danger"></i>

                                        </div> <!--Excluir-->

                                    </section> <!--Botões de ações-->

                                </section>

                                <div id="<?= $project['id'] ?>" class="formEdit"></div>

                            <?php endforeach; ?>

                        </article> <!--Visualização das tarefas-->

                        <section id="AddTask" class="d-none mt-4">

                            <form class="NewProjectForm" method="post">

                                <section class="d-flex flex-column Inputs">

                                    <div class="Title">

                                        <input onkeyup="verifyInputs(0)" type="text" name="taskName" maxlength="60" placeholder="Nome da tarefa" id="projectName" aria-describedby="taskName" />

                                    </div> <!--Nome do projeto-->

                                    <div class="Description">

                                        <textarea onkeyup="verifyDesc(0)" type="text" name="taskDescription" maxlength="500" placeholder="Descrição" id="projectDescription"></textarea>

                                    </div> <!--Descrição do projeto-->

                                </section> <!--Inputs-->

                                <section class="d-flex align-items-center justify-content-end Botoes">

                                    <article class="d-flex align-items-center gap-1">

                                        <button onclick="addNewTask()" type="button" class="form-control btn btn-secondary">

                                            <i class="d-md-none bi bi-x-lg"></i>
                                            <p class="d-md-flex d-none m-0">Cancelar</p>

                                        </button> <!--Cancelar-->

                                        <button id="addButton" type="submit" value="<?= $productDetails['id'] ?>" name="newTask" disabled class="form-control btn-primary BtnDisabled">

                                            <i class="d-md-none bi bi-send-fill"></i>
                                            <p class="d-md-flex d-none m-0">Adicionar tarefa</p>

                                        </button> <!--Adicionar tarefa-->

                                    </article>

                                </section> <!--Botões-->

                            </form>

                        </section> <!--Novo projeto-->

                        <section id="ActionsBtnsTask" class="<?= isset($_GET["subtasks"]) ? 'd-none' : 'd-flex' ?> mt-4">

                            <div onclick="addNewTask()" class="d-flex align-items-center gap-1 AddButton">

                                <div>

                                    <i class="bi bi-plus m-0 TextHighlight"></i>

                                </div>
                                <p class="SubTitle m-0">Adicionar <?= !isset($_GET["tasks"]) ? 'tarefa' : 'subtarefa' ?></p>

                            </div>

                        </section> <!--Botão de adição-->

                    </section> <!--Principal-->

                </article> <!--Detalhes do produto-->

            </section>

        </div>

    </div> <!--Modal para ver mais detalhes-->

    <header class="d-flex align-items-center justify-content-end p-3 py-1 Header">

        <form method="post">

            <div onclick="openMenu()" class="UserIcon">

                <i class="bi bi-person-fill"></i>

            </div> <!--ícone do usuário-->

            <section id="UserMenu" class="UserMenu">
                
                <button type="submit" name="logout" class="btn form-control">Sair</button>

            </section> <!--Menu para logout do user-->

        </form>

    </header>

    <main class="container p-3 py-1">

        <h1 class="fs-4 text-white">Hoje</h1>
        <p class="SubTitle m-0">Olá <?= $userName ?></p>

        <section class="d-flex">

            <div class="<?= $projectsRows == 0 ? 'd-none invisible' : 'd-flex' ?> align-items-center gap-1">

                <i class="bi bi-check-circle SubTitle"></i>
                <p class="SubTitle m-0"><?= $projectsRows ?> <?= $projectsRows == 1 ? 'tarefa' : 'tarefas' ?></p>

            </div> <!--Tarefas concluídas-->

        </section> <!--Quantidade de projetos-->

        <div class="<?= isset($alert) ? 'd-flex' : 'd-none' ?> mt-4 alert alert-warning" role="alert">

            <?= $alert ?>

        </div> <!--Alerta para erros nos formulários-->

        <section class="d-flex flex-column gap-2 mt-3">

            <?php foreach ($projects as $project): ?>

                <?php

                $name = $project["name"];
                $desc = $project["description"];
                $id = $project["id"];

                $urlDetails = BASE_URL . "Home/?name=$name&desc=$desc&id=$id";

                ?> <!--Url para ver os detalhes do projeto, como as tarefas-->

                <section id="<?= $project['id'] ?>" class="d-flex align-items-center justify-content-between text-white Project">

                    <a href="<?= $urlDetails ?>" class="d-flex align-items-start gap-2">

                        <form method="post">

                            <button type="submit" name="changeStatus" value="<?= $project["id"] ?>" class="<?= $project['status'] == 1 ? 'MarkBtnCorrect' : 'MarkBtn' ?>">

                                <i class="bi bi-check2 m-0 <?= $project['status'] == 1 ? 'MarkBtnIconChecked' : 'MarkBtnIcon' ?>"></i>

                            </button>

                        </form> <!--Btn para marcar projeto como concluído-->

                        <article class="d-flex flex-column Informations">

                            <section class="d-flex align-items-center justify-content-between">

                                <p class="<?= $project['status'] == 1 ? 'text-decoration-line-through' : '' ?> m-0 text-truncate"><?= $project["name"] ?></p>

                            </section> <!--Nome-->

                            <p class="<?= $project['status'] == 1 ? 'text-decoration-line-through' : '' ?> m-0 text-truncate SubTitle"><?= $project["description"] ?></p>

                        </article> <!--Nome, descrição e os botões-->

                    </a>

                    <section class="d-none align-items-center gap-1 Btns">

                        <div onclick="editProject( '<?= $project['id'] ?>', '<?= $project['name'] ?>', '<?= $project['description'] ?>' )" class="ProjectBtn">

                            <i class="bi bi-pen"></i>

                        </div> <!--Editar-->

                        <div onclick="deleteProject( '<?= $project['id'] ?>', '<?= $project['name'] ?>', '<?= $project['description'] ?>' )" class="ProjectBtn">

                            <i class="bi bi-trash3 text-danger"></i>

                        </div> <!--Excluir-->

                    </section> <!--Botões de ações-->

                </section>

                <div id="<?= $project['id'] ?>" class="formEdit"></div>

            <?php endforeach; ?>

        </section> <!--Visualização dos projetos-->

        <section id="AddProject" class="d-none mt-4">

            <form class="NewProjectForm" method="post">

                <section class="d-flex flex-column Inputs">

                    <div class="Title">

                        <input onkeyup="verifyInputs(1)" type="text" name="projectName" maxlength="60" placeholder="Nome da tarefa" id="projectName" aria-describedby="projectName" />

                    </div> <!--Nome do projeto-->

                    <div class="Description">

                        <textarea onkeyup="verifyDesc(1)" type="text" name="projectDescription" maxlength="500" placeholder="Descrição" id="projectDescription"></textarea>

                    </div> <!--Descrição do projeto-->

                </section> <!--Inputs-->

                <section class="d-flex align-items-center justify-content-end Botoes">

                    <article class="d-flex align-items-center gap-1">

                        <button onclick="addNewProject()" type="button" class="form-control btn btn-secondary">

                            <i class="d-md-none bi bi-x-lg"></i>
                            <p class="d-md-flex d-none m-0">Cancelar</p>

                        </button> <!--Cancelar-->

                        <button id="addButton" onclick="" type="submit" name="submit" disabled class="form-control btn-primary BtnDisabled">

                            <i class="d-md-none bi bi-send-fill"></i>
                            <p class="d-md-flex d-none m-0">Adicionar tarefa</p>

                        </button> <!--Adicionar tarefa-->

                    </article>

                </section> <!--Botões-->

            </form>

        </section> <!--Novo projeto-->

        <section id="ActionsBtns" class="d-flex mt-4">

            <div onclick="addNewProject()" class="d-flex align-items-center gap-1 AddButton">

                <div>

                    <i class="bi bi-plus m-0 TextHighlight"></i>

                </div>
                <p class="SubTitle m-0"> Adicionar projeto</p>

            </div>

        </section> <!--Botão de adição-->

        <section id="NoProjects" class="d-flex align-items-center justify-content-center">

            <article class="<?= $projectsRows == 0 ? 'd-flex' : 'd-none' ?> flex-column align-items-center gap-1 NoProjects">

                <img src="<?php echo BASE_URL . "/Public/assets/img/others/e01356d33ed3b6dc6f3f5da94e8f83fc.png" ?>" alt="Ilustração" loading="eager" draggable="false" />

                <p class="text-white text-center Titulo">O que você precisa fazer hoje?</p>
                <p class="text-white text-center SubTitulo">Por padrão, tarefas adicionadas aqui terão vencimento hoje. Clique em + para adicionar uma tarefa.</p>

                <div class="d-flex align-items-center cursor-pointer gap-1">

                    <i class="bi bi-question-circle TextHighlight"></i>
                    <p class="SubTitle m-0 text-decoration-underline TextHighlight">Como planejar o seu dia</p>

                </div> <!--Como plenajar o seu dia-->

            </article> <!---->

        </section> <!--Sem projetos-->

    </main>
    
    <script src="<?php echo BASE_URL . '/Public/scripts/js/Home/menuUser.js' ?>"></script> <!--Ativar o menu do usuário-->
    <script src="<?php echo BASE_URL . '/Public/scripts/js/Home/showModal.js' ?>"></script> <!--Ativar o modal de criação de projetos-->
    <script src="<?php echo BASE_URL . '/Public/scripts/js/Home/form.js' ?>"></script> <!--Validação dos inputs do formulário-->
    <script src="<?php echo BASE_URL . '/Public/scripts/js/Home/projectEdit.js' ?>"></script> <!--Editar e excluir projetos-->

</body>

</html>