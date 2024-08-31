<?php
class Tasks extends Model {

    //Funções para os projetos

    public function newProject( string $name, string $desc, string $userId ) {

        $id = uniqid();

        $sql = $this->db->prepare("INSERT INTO projects(name, status, description, userId, id) VALUES (:name, :status, :desc, :userId, :id)");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":status", 0);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":userId", $userId);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function listProjects(string $id) {

        $sql = $this->db->prepare("SELECT * FROM projects WHERE userId = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function editProject( string $name, string $desc, string $id ) {



    }
    public function deleteProject( string $id ) {

        $sql = $this->db->prepare("DELETE FROM projects WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }

    //Funções para as tarefas

    public function createTask( string $name, string $userId ) {

        $id = uniqid();

    }

};
