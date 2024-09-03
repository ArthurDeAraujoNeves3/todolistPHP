<?php 
class SubTask extends Model {

    public function newSubTask( string $name, string $desc, string $taskId ) {

        $id = uniqid();

        $sql = $this->db->prepare("INSERT INTO subtasks(name, description, status, taskId, id) VALUES(:name, :desc, :status, :taskId, :id)");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":status", 0);
        $sql->bindValue(":taskId", $taskId);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function getSubTask( string $id ) {

        $sql = $this->db->prepare("SELECT * FROM subtasks WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function listSubTasks( string $projectId ) {

        $sql = $this->db->prepare("SELECT * FROM subtasks WHERE taskId = :id");
        $sql->bindValue(":id", $projectId);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function updateSubTask( string $name, string $desc, string $status, string $id ) {

        $sql = $this->db->prepare("UPDATE subtasks SET name = :name, description = :desc, status = :status WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function deleteSubTask( string $id ) {

        $sql = $this->db->prepare("DELETE FROM subtasks WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }

};
