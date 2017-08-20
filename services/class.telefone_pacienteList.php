<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:01
 */
class telefone_pacienteList
{
    private $_telefone_paciente = array();
    private $_telefone_pacienteCount = 0;
    public function __construct() {
    }
    public function getTelefone_pacienteCount() {
        return $this->_telefone_pacienteCount;
    }
    private function setTelefone_pacienteCount($newCount) {
        $this->_telefone_pacienteCount = $newCount;
    }
    public function getTelefone_paciente($_telefone_pacienteNumberToGet) {
        if ( (is_numeric($_telefone_pacienteNumberToGet)) &&
            ($_telefone_pacienteNumberToGet <= $this->getTelefone_pacienteCount())) {
            return $this->_telefone_paciente[$_telefone_pacienteNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addTelefone_paciente(Telefone_paciente $_telefone_paciente_in) {
        $this->setTelefone_pacienteCount($this->getTelefone_pacienteCount() + 1);
        $this->_telefone_paciente[$this->getTelefone_pacienteCount()] = $_telefone_paciente_in;
        return $this->getTelefone_pacienteCount();
    }
    public function removeTelefone_paciente(Telefone_paciente $_telefone_paciente_in) {
        $counter = 0;
        while (++$counter <= $this->getTelefone_pacienteCount()) {
            if ($_telefone_paciente_in->getAuthorAndTitle() ==
                $this->_telefone_paciente[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getTelefone_pacienteCount(); $x++) {
                    $this->_telefone_paciente[$x] = $this->_telefone_paciente[$x + 1];
                }
                $this->setTelefone_pacienteCount($this->getTelefone_pacienteCount() - 1);
            }
        }
        return $this->getTelefone_pacienteCount();
    }
}