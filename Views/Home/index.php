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

<body class="p-3">

    <?php

        $userId = ($_SESSION[CONF_SESSION_NAME]);
        $user = new Users();
        $user = $user->getUser($userId);
        $projectsRows = 0;

        $userName = $user[0]["name"];
        $userEmail = $user[0]["email"];

    ?>

    <header class="d-flex align-items-center justify-content-end Header">

        <div class="UserIcon">

            <i class="bi bi-person-fill"></i>

        </div> <!--ícone do usuário-->

    </header>

    <main class="container">

        <h1 class="fs-4 text-white">Hoje</h1>

        <section class="d-flex">

            <div class="<?php echo $projectsRows == 0 ? 'd-none' : 'd-flex' ?> align-items-center gap-1">

                <i class="bi bi-check-circle SubTitle"></i>
                <p class="SubTitle m-0"> 0 tarefas</p>

            </div> <!--Tarefas concluídas-->

            <div class="<?php echo $projectsRows == 0 ? 'd-flex' : 'd-none' ?> align-items-center gap-1 AddButton">

                <div>

                    <i class="bi bi-plus m-0 TextHighlight"></i>

                </div>
                <p class="SubTitle m-0"> Adicionar tarefa</p>

            </div> <!--Botão de adicionar tarefa-->

        </section> <!--Botões de ações-->

        <section class="d-flex align-items-center justify-content-center">

            <article class="<?php echo $projectsRows == 0 ? 'd-flex' : 'd-none' ?> flex-column align-items-center gap-1 NoProjects">

                <img src="<?php echo BASE_URL . "/Public/assets/img/others/e01356d33ed3b6dc6f3f5da94e8f83fc.png" ?>" />

                <p class="text-white text-center Titulo">O que você precisa fazer hoje?</p>
                <p class="text-white text-center SubTitulo">Por padrão, tarefas adicionadas aqui terão vencimento hoje. Clique em + para adicionar uma tarefa.</p>

                <div class="d-flex align-items-center cursor-pointer gap-1">

                    <i class="bi bi-question-circle TextHighlight"></i>
                    <p class="SubTitle m-0 text-decoration-underline TextHighlight">Como planejar o seu dia</p>

                </div> <!--Como plenajar o seu dia-->

            </article> <!---->

        </section> <!--Visualização dos projetos-->

    </main>

</body>

</html>
