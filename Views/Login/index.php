<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login</title>

	<!-- FAVICON -->
	<link rel="shortcut icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" />
	<link rel="icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" type="image/x-icon" />

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="<?= BASE_URL; ?>Assets/css/bootstrap.min.css">

	<!-- BOOTSTRAP SIGNIN -->
	<link rel="stylesheet" href="<?= BASE_URL; ?>Assets/css/signin.css">

	<!-- CUSTOM CSS -->
	<?php if (isset($viewData['CSS'])) {
		echo $viewData['CSS'];
	}; ?>
</head>

<body class="text-center">
	<main class="form-signin">
		<form method="post">
			<!-- <img class="mb-1 img-fluid" src="<?= BASE_URL.'Assets/img/login.png';?>" alt="IMG"> -->

			<div class="form-floating">
				<input type="email" name="email" class="form-control" id="floatingInput" placeholder="nome@email.com" <?= (isset($viewData["email"]) && !empty($viewData["email"])) ? "value='" . $viewData["email"] . "'" : ""; ?>>
				<label for="floatingInput">Endereço de Email</label>
			</div>
			<div class="form-floating">
				<input type="password" name="passwd" class="form-control" id="floatingPassword" placeholder="Password">
				<label for="floatingPassword">Senha</label>
			</div>

			<div class="checkbox mb-3">
				<label>
					<a href="<?= BASE_URL.'Login/forgoutPassword';?>" class="link-secondary">Esqueci a senha</a>
				</label>
			</div>
			<button class="w-100 btn btn-lg btn-success mb-3" type="submit">Entrar</button>
			<?php if (isset($viewData["alert"]) && !empty($viewData["alert"])) {
				echo $viewData["alert"];
			} ;?>
			<p class="mt-5 mb-3 text-muted">Desenvolvimento &copy; 2021</p>
		</form>
	</main>
</body>

</html>