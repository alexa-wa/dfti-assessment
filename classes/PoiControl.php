<?php

class PoiControl extends PoiModel {

    public function setPoiUser($username, $password, $isAdmin) {
        return $this->addPoiUser($username, $password, $isAdmin);
    }

    public function getPoiUser($username) {
        return $this->requestPoiUser($username);
    }

}