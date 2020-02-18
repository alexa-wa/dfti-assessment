<?php

class PoiModel extends Dbh {

    protected function getAllUsers() {
        $sql = "SELECT * FROM `approved`";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute();

        if($users = $stmt->fetchAll())
            return $users;

        return null;
    }

}