<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:01
 */
class tipo_conselhoList
{
    private $_tipo_conselho = array();
    private $_tipo_conselhoCount = 0;
    public function __construct() {
    }
    public function getTipo_conselhoCount() {
        return $this->_tipo_conselhoCount;
    }
    private function setTipo_conselhoCount($newCount) {
        $this->_tipo_conselhoCount = $newCount;
    }
    public function getTipo_conselho($_tipo_conselhoNumberToGet) {
        if ( (is_numeric($_tipo_conselhoNumberToGet)) &&
            ($_tipo_conselhoNumberToGet <= $this->getTipo_conselhoCount())) {
            return $this->_tipo_conselho[$_tipo_conselhoNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addTipo_conselho(Tipo_conselho $_tipo_conselho_in) {
        $this->setTipo_conselhoCount($this->getTipo_conselhoCount() + 1);
        $this->_tipo_conselho[$this->getTipo_conselhoCount()] = $_tipo_conselho_in;
        return $this->getTipo_conselhoCount();
    }
    public function removeTipo_conselho(Tipo_conselho $_tipo_conselho_in) {
        $counter = 0;
        while (++$counter <= $this->getTipo_conselhoCount()) {
            if ($_tipo_conselho_in->getAuthorAndTitle() ==
                $this->_tipo_conselho[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getTipo_conselhoCount(); $x++) {
                    $this->_tipo_conselho[$x] = $this->_tipo_conselho[$x + 1];
                }
                $this->setTipo_conselhoCount($this->getTipo_conselhoCount() - 1);
            }
        }
        return $this->getTipo_conselhoCount();
    }
}