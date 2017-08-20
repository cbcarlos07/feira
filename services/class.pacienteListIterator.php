<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:02
 */
class pacienteListIterator
{
    protected $pacienteList;
    protected $currentPaciente = 0;

    public function __construct(PacienteList $pacienteList_in) {
        $this->pacienteList = $pacienteList_in;
    }
    public function getCurrentPaciente() {
        if (($this->currentPaciente > 0) &&
            ($this->pacienteList->getPacienteCount() >= $this->currentPaciente)) {
            return $this->pacienteList->getPaciente($this->currentPaciente);
        }
    }
    public function getNextPaciente() {
        if ($this->hasNextPaciente()) {
            return $this->pacienteList->getPaciente(++$this->currentPaciente);
        } else {
            return NULL;
        }
    }
    public function hasNextPaciente() {
        if ($this->pacienteList->getPacienteCount() > $this->currentPaciente) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}