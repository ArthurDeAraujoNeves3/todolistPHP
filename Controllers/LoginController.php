<?php

class LoginController extends Controller
{

	public function index()
	{
		//verifico se o usuário já está logado
		$user = new Users();
		if ($user->isLogged() == true) {
			header("Location: " . BASE_URL . "Admin");
		} else {
			//caso não esteja tentamos fazer o login
			$data = array();

			//pegamos os dados enviados via post e usamos o sanitize
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
			if ($post) {
				$data["email"] = $post["email"];
				//verificamos se o valor informado é realmente um email
				if (!is_email($post["email"])) {
					$data["alert"] = message()->warning("Por favor, informe um email válido.");
				} else {
					//se for um email verifico se o mesmo está salvo em nossa base de dados
					if (!$user->verifyEmail($post["email"])) {
						$data["alert"] = message()->warning("Email não encontrado em nossa base.");
					} else {
						//então tentamos fazer o login com a senha
						if ($user->doLogin($post["email"], $post["passwd"])) {
							header("Location: " . BASE_URL . "Home");
							exit;
						} else {
							$data["alert"] = message()->error("Senha inválida.");
						}
					}
				}
			}
			$this->loadView("Login/index", $data);
		}
	}

	public function logout()
	{
		$user = new Users();
		$user->logout();
		header("Location: " . BASE_URL . "Login");
	}
}
