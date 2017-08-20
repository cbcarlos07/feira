<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:01
 */
class prestadorList
{
    private $_prestador = array();
    private $_prestadorCount = 0;
    public function __construct() {
    }
    public function getPrestadorCount() {
        return $this->_prestadorCount;
    }
    private function setPrestadorCount($newCount) {
        $this->_prestadorCount = $newCount;
    }
    public function getPrestador($_prestadorNumberToGet) {
        if ( (is_numeric($_prestadorNumberToGet)) &&
            ($_prestadorNumberToGet <= $this->getPrestadorCount())) {
            return $this->_prestador[$_prestadorNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addPrestador(Prestador $_prestador_in) {
        $this->setPrestadorCount($this->getPrestadorCount() + 1);
        $this->_prestador[$this->getPrestadorCount()] = $_prestador_in;
        return $this->getPrestadorCount();
    }
    public function removePrestador(Prestador $_prestador_in) {
        $counter = 0;
        while (++$counter <= $this->getPrestadorCount()) {
            if ($_prestador_in->getAuthorAndTitle() ==
                $this->_prestador[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getPrestadorCount(); $x++) {
                    $this->_prestador[$x] = $this->_prestador[$x + 1];
                }
                $this->setPrestadorCount($this->getPrestadorCount() - 1);
            }
        }
        return $this->getPrestadorCount();
    }
}