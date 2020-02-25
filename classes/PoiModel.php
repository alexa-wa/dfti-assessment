<?php

class PoiModel extends Dbh {

    protected function addPoiUser($username, $password, $isAdmin) {
        $sql = "INSERT INTO `poi_users` (`username`, `password`, `isadmin`) VALUES (?, ?, ?)";;
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$username, $password, $isAdmin]);
    }

    protected function addNewPoi($name, $type, $country, $region, $description) {
        $sql = "INSERT INTO `pointsofinterest` (`name`, `type`, `country`, `region`, `description`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$name, $type, $country, $region, $description]);
    }

    protected function requestPoiUser($username) {
        $sql = "SELECT * FROM `poi_users` WHERE `username` LIKE ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$username]);

        if($users = $stmt->fetch())
            return $users;

        return null;
    }

    protected function requestPoiByRegion($region) {
        $sql = "SELECT * FROM `pointsofinterest` WHERE `region` = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$region]);

        if($users = $stmt->fetchAll())
            return $users;

        return null;
    }

}