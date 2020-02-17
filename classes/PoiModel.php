<?php

class PoiModel extends Dbh {

    protected function getAllUsers() {
        $sql = "SELECT * FROM `approved` WHERE `login` = 'winnie'";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute();

        if($users = $stmt->fetchAll())
            return $users;

        return null;
    }

}