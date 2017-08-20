<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:01
 */
class atendimentoList
{
    private $_atendimento = array();
    private $_atendimentoCount = 0;
    public function __construct() {
    }
    public function getAtendimentoCount() {
        return $this->_atendimentoCount;
    }
    private function setAtendimentoCount($newCount) {
        $this->_atendimentoCount = $newCount;
    }
    public function getAtendimento($_atendimentoNumberToGet) {
        if ( (is_numeric($_atendimentoNumberToGet)) &&
            ($_atendimentoNumberToGet <= $this->getAtendimentoCount())) {
            return $this->_atendimento[$_atendimentoNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addAtendimento(Atendimento $_atendimento_in) {
        $this->setAtendimentoCount($this->getAtendimentoCount() + 1);
        $this->_atendimento[$this->getAtendimentoCount()] = $_atendimento_in;
        return $this->getAtendimentoCount();
    }
    public function removeAtendimento(Atendimento $_atendimento_in) {
        $counter = 0;
        while (++$counter <= $this->getAtendimentoCount()) {
            if ($_atendimento_in->getAuthorAndTitle() ==
                $this->_atendimento[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getAtendimentoCount(); $x++) {
                    $this->_atendimento[$x] = $this->_atendimento[$x + 1];
                }
                $this->setAtendimentoCount($this->getAtendimentoCount() - 1);
            }
        }
        return $this->getAtendimentoCount();
    }
}