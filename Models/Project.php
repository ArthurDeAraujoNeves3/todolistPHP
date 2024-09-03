<?php
interface Models {

    public function new( string $name, string $desc, string $userId );
    public function get( string $id );
    public function list( string $id );
    public function update( string $name, string $desc, string $status, string $id );
    public function delete( string $id );

};
interface ModelsWithChildrens extends Models {

    public function deleteAllChildrens( string $id );
    public function checkAllChildrens( string $id, int $status );

};

class Project extends Model implements ModelsWithChildrens {

    public function new( string $name, string $desc, string $userId ) {

        $id = uniqid();

        $sql = $this->db->prepare("INSERT INTO projects(name, status, description, userId, id) VALUES (:name, :status, :desc, :userId, :id)");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":status", 0);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":userId", $userId);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function list( string $id ) {

        $sql = $this->db->prepare("SELECT * FROM projects WHERE userId = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function get( string $id ) {

        $sql = $this->db->prepare("SELECT * FROM projects WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function update( string $name, string $desc, string $status, string $id ) {

        $sql = $this->db->prepare("UPDATE projects SET name = :name, description = :desc, status = :status WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":desc", $desc);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function delete( string $id ) {

        $sql = $this->db->prepare("DELETE FROM projects WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

    }

    //Funções para alterar as tarefas 
    public function deleteAllChildrens( string $id ) {

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

};
