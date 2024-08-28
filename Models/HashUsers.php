<?php
class HashUsers extends Model{
    public function addHashUser($id_user, $hash_user){
        $sql = $this->db->prepare("INSERT INTO hash_users SET id_user = :id_user, hash_user  = :hash_user, situation = '1'");
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':hash_user', $hash_user);
        $sql->execute();
    }

    public function InactiveHash($id_user, $hash_user){
        $sql = $this->db->prepare("UPDATE hash_users SET situation = '0' WHERE id_user = :id_user AND hash_user = :hash_user");
        $sql->bindValue(':id_user', $id_user);
        $sql->bindValue(':hash_user', $hash_user);
        $sql->execute();
    }

    public function getInfoUserByHashActive($hash_user){
        $data = array();
        $sql = $this->db->prepare("SELECT users.email AS email, h.id_user, users.type AS type_user FROM hash_users h INNER JOIN users ON users.id = h.id_user WHERE h.hash_user = :hash_user AND h.situation = '1'");
        $sql->bindValue(':hash_user', $hash_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
        }   

        return $data;
    }

    public function existHashActive($hash_user){
        $result = '';
        $sql = $this->db->prepare("SELECT hash_user FROM hash_users WHERE hash_user = :hash_user AND situation = '1'");
        $sql->bindValue(':hash_user', $hash_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $result = $row['hash_user'];
        }

        return $result;
    }
}