<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Alternative - Erro 404 - Página não encontrada</title>
	
	<!-- FAVICON -->
	<link rel="shortcut icon" href="<?= BASE_URL; ?>Assets/img/favicon.ico" />
	<link rel="icon" href="<?= BASE_URL; ?>Assets/img/favicon.ico" type="image/x-icon"/>

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="<?= BASE_URL; ?>Assets/css/bootstrap.min.css"/>

	<!-- CUSTOM CSS -->
	<?php if(isset($viewData['CSS'])){echo $viewData['CSS'];}; ?>
</head>

<body>
	<!-- Begin page content -->
	<main class="flex-shrink-0">
		<div class="container">
			<h1 class="mt-5">Opppss...</h1>
			<p class="lead">A página que você tentou acessar não existe ou está fora do ar no momento, por favor tente novamente mais tarde.</p>
			<p>Use <a href="<?= BASE_URL; ?>">este link</a> caso deseje voltar ao nosso site principal, obrigado.</p>
		</div>
	</main>
</body>
</html>
