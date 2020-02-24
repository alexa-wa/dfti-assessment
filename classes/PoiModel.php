<?php

class PoiModel extends Dbh {

    protected function addPoiUser($username, $password, $isAdmin) {
        $sql = "INSERT INTO `poi_users` (`username`, `password`, `isadmin`) VALUES (?, ?, ?)";;
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$username, $password, $isAdmin]);
    }

    protected function requestPoiUser($username) {
        $sql = "SELECT * FROM `poi_users` WHERE `username` = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$username]);

        if($users = $stmt->fetch())
            return $users;

        return null;
    }

}