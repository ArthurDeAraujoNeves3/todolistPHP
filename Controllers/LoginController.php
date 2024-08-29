<?php

class LoginController extends Controller {

	private $data = array();

	public function validateInput( bool $isValid, string $inputName ) {

		if ( !$isValid ) {

			$this->data["alert"] = "Por favor, insira dados válidos!";
			$this->data["$inputName" . "Error"] = true;

		};

		return $this->data;

	}

	public function index() {

		//verifico se o usuário já está logado
		$user = new Users();

		if ($user->isLogged() == true) {

			header("Location: " . BASE_URL . "Home");

		} else {
			
			//Se houve o envio do formulário
            if ( isset($_REQUEST["submit"]) ) {

                $email = trim($_REQUEST["email"] ?? "");
                $this->data["email"] = $email;
                $password = trim($_REQUEST["password"] ?? "");
                $this->data["password"] = $password;

                $emailRegex = "/^[\w\.-]+@[\w\.-]+\.\w{2,6}$/";

                $this->validateInput($email !== "" && preg_match($emailRegex, $email), "email");
                $this->validateInput($password !== "" && strlen($password) <= 126, "password");

                if (!isset($data["alert"])) {

                    $request = $user->doLogin($email, $password); //Fazendo o login
					
                    if ( $request ) {

						//header("location: ". BASE_URL . "Login");

                    } else {

						$this->data["emailError"] = true;
						$this->data["passwordError"] = true;
                        $this->data["passwordText"] = "Conta não foi encontrada em nosso sistema. Revise os seus dados ou crie uma nova conta";
                        
                    };
                };

            };

			
			$this->loadView("Login/index", $this->data);

		};

	}

	public function logout() {

		$user = new Users();
		$user->logout();
		header("Location: " . BASE_URL . "Login");

	}

}
