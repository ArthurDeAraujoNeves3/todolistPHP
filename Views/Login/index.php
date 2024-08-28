<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo BASE_URL . '/Public/Bootstrap/bootstrap.min.css' ?>">
	<link rel="stylesheet" href="<?php echo BASE_URL . '/Public/index.css' ?>">
	<link rel="stylesheet" href="<?php echo BASE_URL . '/Public/styles/LoginStyle.css' ?>">
	<title>Login | todoist</title>
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

			<h1>Login</h1>

			<action class="d-flex flex-column">
				
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">

					<section class="d-flex flex-column">

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

			<p class="text-center">Não tem uma conta? <a href="<?php echo BASE_URL . "Register"?>" class="text-decoration-underline">Cadastre-se</a></p>

		</section> <!--Form-->

		<section class="d-lg-flex d-none Video">

			<img src="<?php echo BASE_URL . '/Public/assets/img/Login.png' ?>" class="img-fluid" />

		</section> <!--Imagem-->

	</main>

</body>

</html>