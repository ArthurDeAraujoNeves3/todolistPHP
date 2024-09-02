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
    public function listTasks(string $projectId) {

        $task = new Tasks();
        $tasks = $task->listTasks($projectId);

        $this->data["projectTasks"] = $tasks;
        $this->data["projectsTasksRows"] = count($tasks);

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
            
            //Criar novos projetos
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
            //Alterar status do projeto
            elseif ( isset($_REQUEST["changeStatus"]) ) {

                $id = $_REQUEST["changeStatus"];
                
                $tasks = new Tasks();
                $project = $tasks->getProject($id);

                $projectName = $project[0]["name"];
                $projectDesc = $project[0]["description"];
                $projectStatus = $project[0]["status"];

                $projectStatus == 0 ? $projectStatus = 1 : $projectStatus = 0 ;
                
                $tasks->updateProject($projectName, $projectDesc, $projectStatus, $id);
                $this->listProjects($userId);

            }
            //Atualizar projetos
            elseif ( isset($_REQUEST["update"]) ) {

                $name = trim($_REQUEST["projectName"]);
                $desc = trim($_REQUEST["projectDescription"]);
                $id = trim($_REQUEST["update"]);

                $tasks = new Tasks();
                $tasks->updateProject($name, $desc, 0, $id);

                $this->listProjects($userId);

            }
            //Deletar projeto
            elseif ( isset($_REQUEST["delete"]) ) {

                $id = $_REQUEST["delete"];
                
                $tasks = new Tasks();
                $tasks->deleteProject($id);

                $this->listProjects($userId);

            }
            //Faz a listagem dos projetos normalmente
            else {

                $this->listProjects($userId);

            };

            //Tarefas
            //Criar novas tarefas
            if ( isset($_REQUEST["newTask"]) ) {

                $name = $_REQUEST["taskName"];
                $desc = $_REQUEST["taskDescription"];
                
                $nameIsValid = $this->validateFunction( $name !== "" && strlen($name) <= 60 );
                $descIsValid = $this->validateFunction( strlen($desc) <= 500 );

                if ( $nameIsValid && $descIsValid ) {

                    $projectId = $_REQUEST["newTask"];

                    $task = new Tasks();
                    $task->newTask($name, $desc, $projectId);
                    $this->listTasks($projectId);

                };

            }
            //Alterar status da tarefa
            elseif ( isset($_REQUEST["changeStatusTask"]) ) {

                $id = $_REQUEST["changeStatusTask"];
                
                $tasks = new Tasks();
                $task = $tasks->getTask($id);

                $taskName = $task[0]["name"];
                $taskDesc = $task[0]["description"];
                $taskStatus = $task[0]["status"];

                $taskStatus == 0 ? $taskStatus = 1 : $taskStatus = 0 ;
                
                $tasks->updateTask($taskName, $taskDesc, $taskStatus, $id);
                $this->listTasks($id);

            }
            //Atualizar tarefas 
            elseif ( isset($_REQUEST["updateTask"]) ) {

                $name = $_REQUEST["taskName"];
                $desc = $_REQUEST["taskDescription"];
                $id = $_REQUEST["updateTask"];

                $tasks = new Tasks();
                $tasks->updateTask($name, $desc, 0, $id);

                $this->listProjects($id);

            }
            elseif ( isset($_REQUEST["deleteTask"]) ) {

                $id = $_REQUEST["deleteTask"];
                
                $tasks = new Tasks();
                $tasks->deleteTask($id);

                $this->listTasks($userId);

            }

            //Verificando se ele está com o projeto aberto
            if ( isset($_GET["name"]) && isset($_GET["desc"]) && isset($_GET["id"]) ) {

                $name = trim($_GET["name"]);
                $desc = trim($_GET["desc"]);
                $id = trim($_GET["id"]);

                $task = new Tasks();
                $project = $task->getProject( $id );

                $status = $project[0]['status'];
                
                $this->listTasks($id);
                $this->data["seeDetails"] = true;
                $this->data["productDetails"] = [

                    "name" => $name,
                    "desc" => $desc,
                    "status" => $status,
                    "id" => $id

                ];

            };
            
            $this->loadView('Home/index', $this->data);

        };

    }

};
