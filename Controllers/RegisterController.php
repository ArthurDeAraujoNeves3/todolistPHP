<?php

class RegisterController extends Controller
{

    private $data = array();

    public function validateInput(bool $isValid, string $inputName) {

        if (!$isValid) {

            $this->data["alert"] = "Por favor, insira dados válidos!";
            $this->data["$inputName" . "Error"] = true; //Faz a junção do nome do input com Error e envia para o front
        
        };

        return $this->data;

    }

    public function index() {

        $user = new Users();

        if ($user->isLogged() == true) {

            header("location: " . BASE_URL . "Home");

        } else {
            
            //Se houve o envio do formulário
            if ( isset($_REQUEST["submit"]) ) {

                $name = trim($_REQUEST["name"] ?? "");
                $this->data["name"] = $name;
                $email = trim($_REQUEST["email"] ?? "");
                $this->data["email"] = $email;
                $password = trim($_REQUEST["password"] ?? "");
                $this->data["password"] = $password;

                $emailRegex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

                $this->validateInput($name !== "" && strlen($name) <= 126, "name");
                $this->validateInput($email !== "" && preg_match($emailRegex, $email), "email");
                $this->validateInput($password !== "" && strlen($password) >= 8 && strlen($password) <= 126, "password");

                if (!isset($data["alert"])) {

                    $request = $user->verifyEmail($email); //Verificando se o email já está no sistema
                    
                    if ( !$request ) {

                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $userId = uniqid();
                        $user->addUser($name, $email, $passwordHash, $userId);

                        header("location: ". BASE_URL . "Home");

                    } else {

                        $this->data["emailText"] = "Email já cadastrado!";
                        $this->data["emailError"] = true;
                        
                    };
                };

            };
        
            $this->loadView("Register/index", $this->data);
        };
    }
}
