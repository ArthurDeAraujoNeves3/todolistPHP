<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/Public/Bootstrap/bootstrap.min.css' ?>">
	<link rel="stylesheet" href="<?php echo BASE_URL . '/Public/index.css' ?>">
	<link rel="stylesheet" href="<?php echo BASE_URL . '/Public/styles/LoginStyle.css' ?>">
    <title>Criar conta | todoist</title>
</head>

<body class="bgLight">

    <header class="container">

        <nav class="navbar bg-body-tertiary">

            <div class="container">

                <figure>

                    <img class="Logo" src="<?php echo BASE_URL . '/Public/assets/img/Logo/TodoistName.png' ?>" alt="Bootstrap" />

                </figure>

            </div>

        </nav>

    </header>
    <main class="container d-flex align-items-center justify-content-lg-between justify-content-center mt-5">

        <section class="d-flex flex-column gap-3 Form">

            <h1>Inscreva-se</h1>

            <action class="d-flex flex-column">

                <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">

                    <section class="d-flex flex-column">

                        <div class="input-group mb-3">

                            <input name="name" id="name" maxlength="128" type="text" class="form-control" placeholder="Nome" aria-label="Email" aria-describedby="basic-addon1">

                        </div> <!--Nome-->

                        <div class="input-group mb-3">

                            <input name="email" id="email" maxlength="256" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">

                        </div> <!--Email-->

                        <div class="input-group mb-3">

                            <input name="password" id="password" maxlength="60" type="password" class="form-control" placeholder="Senha" aria-label="Senha" aria-describedby="basic-addon1">

                        </div> <!--Senha-->

                    </section> <!--Inputs-->

                    <button type="submit" class="btn btn-primary">Entrar com e-mail</button>

                </form>

            </action> <!--Inputs-->

            <hr>

            <p class="text-center">Já se cadastrou? <a href="<?php echo BASE_URL . "Login" ?>" class="text-decoration-underline">Vá para o login</a></p>

        </section> <!--Form-->

        <section class="d-lg-flex d-none Video">

            <video playsinline="" poster="https://todoist.b-cdn.net/assets/images/7b55dafbc1fe203bd537c738fb1757ed.png">
                <source src="https://todoist.b-cdn.net/assets/video/69a00ecf3b2aedf11010987593926c2e.mp4" type="video/mp4">
            </video>

        </section> <!--Video-->

    </main>

</body>

</html>