<?php

class PoiControl extends PoiModel {

    public function setPoiUser($username, $password, $isAdmin) {
        return $this->addPoiUser($username, $password, $isAdmin);
    }

    public function setNewPoi($name, $type, $country, $region, $description) {
        return $this->addNewPoi($name, $type, $country, $region, $description);
    }

    public function getPoiUser($username) {
        return $this->requestPoiUser($username);
    }

}