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

        $task = new Project();
        $projects = $task->list($userId);

        $this->data["projects"] = $projects;
        $this->data["projectsRows"] = count($projects);

    }
    public function listTasks(string $projectId) {

        $task = new Task();
        $tasks = $task->list($projectId);

        $this->data["projectTasks"] = $tasks;
        
    }
    public function listSubTasks(string $projectId) {

        $task = new SubTask();
        $tasks = $task->list($projectId);

        $this->data["projectTasks"] = $tasks;
        
    }

    public function index() {

        if ( !isset($_SESSION[CONF_SESSION_NAME]) ) {

            header("location: ".BASE_URL."Login");
            exit();

        } else {

            if ( isset($_REQUEST["logout"]) ) {

                session_destroy();

            };

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

                    $task = new Project();
                    $task->new($name, $desc, $userId);
                    $task->list($userId);

                    $this->listProjects($userId);
                };

            }
            //Alterar status do projeto
            elseif ( isset($_REQUEST["changeStatus"]) ) {

                $id = $_REQUEST["changeStatus"];
                
                $projectObj = new Project();
                $project = $projectObj->get($id); //Produto específico
                $projects = $projectObj->list($userId); //Todos os produtos

                $projectName = $project[0]["name"];
                $projectDesc = $project[0]["description"];
                $projectStatus = $project[0]["status"];

                $projectStatus == 0 ? $projectStatus = 1 : $projectStatus = 0 ;
                
                $taskObj = new Task();
                $tasks = $taskObj->list($id);

                //Atualizando as subtarefas
                foreach($tasks as $task) {

                    $taskId = $task["id"];
                    $taskObj->checkAllChildrens($taskId, $projectStatus);

                };

                //Atualizando as tarefas
                foreach($projects as $project) {

                    $pId = $project["id"];
                    $projectObj->checkAllChildrens($pId, $projectStatus);

                }
                
                $projectObj->update($projectName, $projectDesc, $projectStatus, $id);
                $this->listProjects($userId);

            }
            //Atualizar projetos
            elseif ( isset($_REQUEST["update"]) ) {

                $name = trim($_REQUEST["projectName"]);
                $desc = trim($_REQUEST["projectDescription"]);
                $id = trim($_REQUEST["update"]);

                $tasks = new Project();
                $tasks->update($name, $desc, 0, $id);

                $this->listProjects($userId);

            }
            //Deletar projeto
            elseif ( isset($_REQUEST["delete"]) ) {

                $id = $_REQUEST["delete"];
                
                $projectObj = new Project();
                $projects = $projectObj->list($userId);

                $taskObj = new Task();
                $tasks = $taskObj->list($id);
                
                //Deletando as subtarefas
                foreach($tasks as $task) {

                    $taskId = $task["id"];
                    $taskObj->deleteAllChildrens($taskId);

                };

                //Deletando as tarefas
                foreach($projects as $project) {

                    $pid = $project["id"];
                    $projectObj->deleteAllChildrens($pid);

                };
                
                $projectObj->delete($id);
                $this->listProjects($userId);

            }
            //Faz a listagem dos projetos normalmente
            else {

                $this->listProjects($userId);

            };

            //Tarefas & Subtarefas
            //Como eles compartilham o mesmo name, estou diferenciando pelo parâmetro tasks que está no url
            //Criar novas tarefas
            if ( isset($_REQUEST["newTask"]) ) {

                $name = $_REQUEST["taskName"];
                $desc = $_REQUEST["taskDescription"];
                    
                $nameIsValid = $this->validateFunction( $name !== "" && strlen($name) <= 60 );
                $descIsValid = $this->validateFunction( strlen($desc) <= 500 );

                if ( !isset($_GET["tasks"]) ) {

                    if ( $nameIsValid && $descIsValid ) {

                        $projectId = $_REQUEST["newTask"];

                        $task = new Task();
                        $task->new($name, $desc, $projectId);
                        $this->listTasks($projectId);

                    };

                } else {

                    if ( $nameIsValid && $descIsValid ) {

                        $projectId = $_REQUEST["newTask"];

                        $task = new SubTask();
                        $task->new($name, $desc, $projectId);
                        $this->listSubTasks($projectId);

                    };

                }

            }
            //Alterar status da tarefa
            elseif ( isset($_REQUEST["changeStatusTask"]) ) {

                $id = $_REQUEST["changeStatusTask"];
                
                $taskObj = new Task();
                $task = $taskObj->get($id);

                $taskName = $task[0]["name"];
                $taskDesc = $task[0]["description"];
                $taskStatus = $task[0]["status"];

                $taskStatus == 0 ? $taskStatus = 1 : $taskStatus = 0 ;

                $taskObj->checkAllChildrens($id, $taskStatus);

                $taskObj->update($taskName, $taskDesc, $taskStatus, $id);
                $this->listTasks($id);

            }
            //Atualizar tarefas 
            elseif ( isset($_REQUEST["updateTask"]) ) {

                $name = $_REQUEST["taskName"];
                $desc = $_REQUEST["taskDescription"];
                $id = $_REQUEST["updateTask"];

                $tasks = new Task();
                $tasks->update($name, $desc, 0, $id);

                $this->listProjects($id);

            }
            elseif ( isset($_REQUEST["deleteTask"]) ) {

                echo "asdas";

                $id = $_REQUEST["deleteTask"];
                
                $taskObj = new Task();

                $taskObj->deleteAllChildrens($id);
                $taskObj->delete($id);

                $this->listTasks($id);
                
            }

            //Subtarefas
            //Criar novas subtarefas
            if ( isset($_REQUEST["newSubTask"]) ) {

                $name = $_REQUEST["subTaskName"];
                $desc = $_REQUEST["subTaskDescription"];
                
                $nameIsValid = $this->validateFunction( $name !== "" && strlen($name) <= 60 );
                $descIsValid = $this->validateFunction( strlen($desc) <= 500 );

                if ( $nameIsValid && $descIsValid ) {

                    $projectId = $_REQUEST["newSubTask"];

                    $task = new SubTask();
                    $task->new($name, $desc, $projectId);
                    $this->listSubTasks($projectId);

                };

            }
            //Alterar status da subtarefa
            elseif ( isset($_REQUEST["changeStatusSubTask"]) ) {

                $id = $_REQUEST["changeStatusSubTask"];
                
                $tasks = new SubTask();
                $task = $tasks->get($id);

                $taskName = $task[0]["name"];
                $taskDesc = $task[0]["description"];
                $taskStatus = $task[0]["status"];

                $taskStatus == 0 ? $taskStatus = 1 : $taskStatus = 0 ;
                
                $tasks->update($taskName, $taskDesc, $taskStatus, $id);
                $this->listSubTasks($id);

            }
            //Atualizar subtarefas 
            elseif ( isset($_REQUEST["updateSubTask"]) ) {

                $name = $_REQUEST["taskName"];
                $desc = $_REQUEST["taskDescription"];
                $id = $_REQUEST["updateSubTask"];

                $tasks = new SubTask();
                $tasks->update($name, $desc, 0, $id);

                $this->listSubTasks($id);

            }
            elseif ( isset($_REQUEST["deleteSubTask"]) ) {

                $id = $_REQUEST["deleteSubTask"];
                
                $tasks = new SubTask();
                $tasks->delete($id);

                $this->listSubTasks($userId);

            }

            //Verificando se ele está com o projeto aberto
            if ( isset($_GET["name"]) && isset($_GET["desc"]) && isset($_GET["id"]) && !isset($_GET["tasks"]) && !isset($_GET["subtasks"]) ) {

                $name = trim($_GET["name"]);
                $desc = trim($_GET["desc"]);
                $id = trim($_GET["id"]);

                $task = new Project();
                $project = $task->get( $id );

                $status = $project[0]['status'];
                
                $this->listTasks($id);
                $this->data["seeDetails"] = true;
                $this->data["productDetails"] = [

                    "name" => $name,
                    "desc" => $desc,
                    "status" => $status,
                    "id" => $id

                ];

            }
            //Tarefas 
            elseif ( isset($_GET["tasks"]) && $_GET["tasks"] == true ) {

                $name = trim($_GET["name"]);
                $desc = trim($_GET["desc"]);
                $id = trim($_GET["id"]);

                $task = new Task();
                $project = $task->get( $id );
                
                $status = $project[0]['status'];
                
                $this->listSubTasks($id);
                $this->data["seeDetails"] = true;
                $this->data["productDetails"] = [

                    "name" => $name,
                    "desc" => $desc,
                    "status" => $status,
                    "id" => $id

                ];

            }
            //Subtarefas
            elseif ( isset($_GET["subtasks"]) && $_GET["subtasks"] == true ) {

                $name = trim($_GET["name"]);
                $desc = trim($_GET["desc"]);
                $id = trim($_GET["id"]);

                $task = new SubTask();
                $project = $task->get( $id );
                
                $status = $project[0]['status'];
                
                $this->listSubTasks($id);
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
