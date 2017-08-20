<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:02
 */
class telefone_pacienteListIterator
{
    protected $telefone_pacienteList;
    protected $currentTelefone_paciente = 0;

    public function __construct( telefone_pacienteList $telefone_pacienteList_in) {
        $this->telefone_pacienteList = $telefone_pacienteList_in;
    }
    public function getCurrentTelefone_paciente() {
        if (($this->currentTelefone_paciente > 0) &&
            ($this->telefone_pacienteList->getTelefone_pacienteCount() >= $this->currentTelefone_paciente)) {
            return $this->telefone_pacienteList->getTelefone_paciente($this->currentTelefone_paciente);
        }
    }
    public function getNextTelefone_paciente() {
        if ($this->hasNextTelefone_paciente()) {
            return $this->telefone_pacienteList->getTelefone_paciente(++$this->currentTelefone_paciente);
        } else {
            return NULL;
        }
    }
    public function hasNextTelefone_paciente() {
        if ($this->telefone_pacienteList->getTelefone_pacienteCount() > $this->currentTelefone_paciente) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}