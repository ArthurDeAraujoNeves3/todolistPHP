<?php
class Task extends Model {

    public function newTask( string $name, string $desc, string $projectId ) {

        $id = uniqid();

        $sql = $this->db->prepare("INSERT INTO tasks(name, description, status, projectId, id) VALUES(:name, :desc, :status, :projectId, :id)");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":status", 0);
        $sql->bindValue(":projectId", $projectId);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function getTask( string $id ) {

        $sql = $this->db->prepare("SELECT * FROM tasks WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function listTasks( string $projectId ) {

        $sql = $this->db->prepare("SELECT * FROM tasks WHERE projectId = :id");
        $sql->bindValue(":id", $projectId);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function updateTask( string $name, string $desc, string $status, string $id ) {

        $sql = $this->db->prepare("UPDATE tasks SET name = :name, description = :desc, status = :status WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function deleteTask( string $id ) {

        $sql = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }

    public function deleteChildrens( string $id ) {

        $sql = $this->db->prepare("DELETE FROM subtasks WHERE taskId = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function checkAllChildrens( string $id, int $status ) {

        $sql = $this->db->prepare("UPDATE subtasks SET status = :status WHERE taskId = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":status", $status);
        $sql->execute();

    }

}
