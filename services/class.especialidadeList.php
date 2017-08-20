<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:01
 */
class especialidadeList
{
    private $_especialidade = array();
    private $_especialidadeCount = 0;
    public function __construct() {
    }
    public function getEspecialidadeCount() {
        return $this->_especialidadeCount;
    }
    private function setEspecialidadeCount($newCount) {
        $this->_especialidadeCount = $newCount;
    }
    public function getEspecialidade($_especialidadeNumberToGet) {
        if ( (is_numeric($_especialidadeNumberToGet)) &&
            ($_especialidadeNumberToGet <= $this->getEspecialidadeCount())) {
            return $this->_especialidade[$_especialidadeNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addEspecialidade(Especialidade $_especialidade_in) {
        $this->setEspecialidadeCount($this->getEspecialidadeCount() + 1);
        $this->_especialidade[$this->getEspecialidadeCount()] = $_especialidade_in;
        return $this->getEspecialidadeCount();
    }
    public function removeEspecialidade(Especialidade $_especialidade_in) {
        $counter = 0;
        while (++$counter <= $this->getEspecialidadeCount()) {
            if ($_especialidade_in->getAuthorAndTitle() ==
                $this->_especialidade[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getEspecialidadeCount(); $x++) {
                    $this->_especialidade[$x] = $this->_especialidade[$x + 1];
                }
                $this->setEspecialidadeCount($this->getEspecialidadeCount() - 1);
            }
        }
        return $this->getEspecialidadeCount();
    }
}