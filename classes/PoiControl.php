<?php

class PoiControl extends PoiModel {

    public function setPoiUser($username, $password, $isAdmin) {
        return $this->addPoiUser($username, $password, $isAdmin);
    }

    public function setNewPoi($name, $type, $country, $region, $description, $recommended, $user) {
        return $this->addNewPoi($name, $type, $country, $region, $description, $recommended, $user);
    }

    public function getPoiUser($username) {
        return $this->requestPoiUser($username);
    }

    public function getPoiByRegion($region) {
        return $this->requestPoiByRegion($region);
    }

    public function addRating($poiId) {
        return $this->iterateRating($poiId);
    }

}