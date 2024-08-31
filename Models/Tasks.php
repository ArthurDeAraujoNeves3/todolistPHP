<?php
class Tasks extends Model {

    public function newProject( string $name, string $desc, string $userId ) {

        $sql = $this->db->prepare("INSERT INTO projects(name, status, description, userId, id) VALUES (:name, :status, :desc, :userId, :id)");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":status", 0);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":userId", $userId);
        $id = uniqid();
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function listProjects(string $id) {

        $sql = $this->db->prepare("SELECT * FROM projects WHERE userId = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }

};
