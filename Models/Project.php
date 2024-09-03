<?php
class Project extends Model {

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
    public function listProjects( string $id ) {

        $sql = $this->db->prepare("SELECT * FROM projects WHERE userId = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function getProject( string $id ) {

        $sql = $this->db->prepare("SELECT * FROM projects WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function updateProject( string $name, string $desc, string $status, string $id ) {

        $sql = $this->db->prepare("UPDATE projects SET name = :name, description = :desc, status = :status WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function deleteProject( string $id ) {

        $sql = $this->db->prepare("DELETE FROM projects WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }

    public function deleteChildrens( string $id ) {

        $sql = $this->db->prepare("DELETE FROM tasks WHERE projectId = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function checkAllChildrens( string $id, int $status ) {

        $sql = $this->db->prepare("UPDATE tasks SET status = :status WHERE projectId = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":status", $status);
        $sql->execute();

    }

}
