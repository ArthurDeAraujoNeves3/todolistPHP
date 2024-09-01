<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/Public/Bootstrap/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/Public/index.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/Public/styles/Home/HomeStyle.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Hoje – Todoist</title>
</head>

<body class="p-3 py-1">

    <header class="d-flex align-items-center justify-content-end Header">

        <div class="UserIcon">

            <i class="bi bi-person-fill"></i>

        </div> <!--ícone do usuário-->

    </header>

    <main class="container">

        <h1 class="fs-4 text-white">Hoje</h1>
        <p class="SubTitle m-0">Olá <?= $userName ?></p>

        <section class="d-flex">

            <div class="<?= $projectsRows == 0 ? 'd-none invisible' : 'd-flex' ?> align-items-center gap-1">

                <i class="bi bi-check-circle SubTitle"></i>
                <p class="SubTitle m-0"><?= $projectsRows ?> <?= $projectsRows == 1 ? 'tarefa' : 'tarefas' ?></p>

            </div> <!--Tarefas concluídas-->

        </section> <!--Quantidade de projetos-->

        <section class="d-flex flex-column gap-2 mt-3">

            <?php

                foreach ( $userProjects as $project ) {

                    $name = $project["name"];
                    $status = $project["status"];
                    $description = $project["description"];
                    $userId = $project["userId"];
                    $id = $project["id"];

                    $markBtnStyle = "";
                    $textStyle = "";
                    $icon = "";
                    
                    //Definindo estilos de acordo com o status do produto
                    $status == 1 ? $markBtnStyle = "MarkBtnCorrect" : $markBtnStyle = "MarkBtn";
                    $status == 1 ? $textStyle = "text-decoration-line-through" : $textStyle = "";
                    $status == 1 ? $icon = "MarkBtnIconChecked" : $icon = "MarkBtnIcon";
                    
                    echo "

                        <div id='$id' class='d-flex align-items-center justify-content-between text-white Project'>

                            <section class='d-flex align-items-start gap-2'>

                                <form method='post'>

                                    <button type='submit' name='changeStatus' value='$id' class='$markBtnStyle'>

                                        <i class='bi bi-check2 m-0 $icon'></i>

                                    </button>

                                </form> <!--Btn para marcar projeto como concluído-->

                                <div class='d-flex flex-column Informations'>

                                    <div class='d-flex align-items-center justify-content-between'>

                                        <p class='$textStyle m-0 text-truncate'>$name</p>
                                        
                                        <section class='d-none align-items-center gap-1 Btns'>

                                            <div onclick='editProject(\"$id\", \"$name\", \"$description\")' class='ProjectBtn'>

                                                <i class='bi bi-pen'></i>

                                            </div> <!--Editar-->

                                            <div class='ProjectBtn'>

                                                <i class='bi bi-trash3 text-danger'></i>

                                            </div> <!--Excluir-->
                                
                                        </section> <!--Botões de ações-->

                                    </div> <!--Nome e btns-->

                                    <p class='m-0 text-truncate SubTitle'>$description</p>
                                
                                </div> <!--Nome, descrição e os botões-->

                            </section>
                        
                        </div>

                        <div id='$id' class='formEdit'></div>

                    ";

                };
                
            ?>

        </section> <!--Visualização dos projetos-->

        <section id="AddProject" class="d-none mt-4">

            <form class="NewProjectForm" method="post">

                <section class="d-flex flex-column Inputs">

                    <div class="Title">

                        <input onkeyup="verifyInputs()" type="text" name="projectName" maxlength="60" placeholder="Nome da tarefa" id="projectName" aria-describedby="projectName" />
                        
                    </div> <!--Nome do projeto-->

                    <div class="Description">

                        <textarea onkeyup="verifyInputs()" type="text" name="projectDescription" maxlength="500" placeholder="Descrição" id="projectDescription"></textarea>

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
                <p class="SubTitle m-0"> Adicionar tarefa</p>

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

    <script src="<?php echo BASE_URL . '/Public/scripts/js/Home/showModal.js' ?>"></script> <!--Ativar o modal de criação de projetos-->
    <script src="<?php echo BASE_URL . '/Public/scripts/js/Home/form.js' ?>"></script> <!--Validação dos inputs do formulário-->
    <script src="<?php echo BASE_URL . '/Public/scripts/js/Home/projectEdit.js' ?>"></script> <!--EEditar e excluir projetos-->

</body>

</html>