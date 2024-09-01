<?php

class HomeController extends Controller {

    private $data = array();

    public function validateFunction( bool $isValid ) {

        if ( !$isValid ) {

            return false;

        } else {

            return true;

        };

    }

    public function listProjects(string $userId) {

        $task = new Tasks();
        $projects = $task->listProjects($userId);

        $this->data["userProjects"] = $projects;
        $this->data["projectsRows"] = count($projects);

    }

    public function index() {

        if ( !isset($_SESSION[CONF_SESSION_NAME]) ) {

            header("location: ".BASE_URL."Login");
            exit();

        } else {

            //Pegando informações do usuário
            $userId = ($_SESSION[CONF_SESSION_NAME]);
            $user = new Users();
            $user = $user->getUser($userId);
            $this->data["userName"] = $user[0]["name"];
            $this->data["userEmail"] = $user[0]["email"];

            if ( isset($_REQUEST["submit"]) ) {

                $name = $_REQUEST["projectName"];
                $desc = $_REQUEST["projectDescription"];
                
                $nameIsValid = $this->validateFunction( $name !== "" && strlen($name) <= 60 );
                $descIsValid = $this->validateFunction( strlen($desc) <= 500 );

                if ( $nameIsValid && $descIsValid ) {

                    $task = new Tasks();
                    $task->newProject($name, $desc, $userId);
                    $projects = $task->listProjects($userId);

                    $this->data["userProjects"] = $projects;
                    $this->data["projectsRows"] = count($projects);

                };

            }
            //Atualizar projetos
            elseif ( isset($_REQUEST["update"]) ) {

                $name = trim($_REQUEST["projectName"]);
                $desc = trim($_REQUEST["projectDescription"]);
                $id = trim($_REQUEST["update"]);

                echo $name, $desc, $id;

                $this->listProjects($userId);

            }
            //Faz a listagem dos projetos normalmente
            else {

                $this->listProjects($userId);

            };

            $this->loadView('Home/index', $this->data);

        };

    }

};
