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

            } else {

                $task = new Tasks();
                $projects = $task->listProjects($userId);

                $this->data["userProjects"] = $projects;
                $this->data["projectsRows"] = count($projects);

            };

            $this->loadView('Home/index', $this->data);

        };

    }

};
