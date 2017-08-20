<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:01
 */
class gera_senhaList
{
    private $_gera_senha = array();
    private $_gera_senhaCount = 0;
    public function __construct() {
    }
    public function getGera_senhaCount() {
        return $this->_gera_senhaCount;
    }
    private function setGera_senhaCount($newCount) {
        $this->_gera_senhaCount = $newCount;
    }
    public function getGera_senha($_gera_senhaNumberToGet) {
        if ( (is_numeric($_gera_senhaNumberToGet)) &&
            ($_gera_senhaNumberToGet <= $this->getGera_senhaCount())) {
            return $this->_gera_senha[$_gera_senhaNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addGera_senha(Gera_senha $_gera_senha_in) {
        $this->setGera_senhaCount($this->getGera_senhaCount() + 1);
        $this->_gera_senha[$this->getGera_senhaCount()] = $_gera_senha_in;
        return $this->getGera_senhaCount();
    }
    public function removeGera_senha(Gera_senha $_gera_senha_in) {
        $counter = 0;
        while (++$counter <= $this->getGera_senhaCount()) {
            if ($_gera_senha_in->getAuthorAndTitle() ==
                $this->_gera_senha[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getGera_senhaCount(); $x++) {
                    $this->_gera_senha[$x] = $this->_gera_senha[$x + 1];
                }
                $this->setGera_senhaCount($this->getGera_senhaCount() - 1);
            }
        }
        return $this->getGera_senhaCount();
    }
}