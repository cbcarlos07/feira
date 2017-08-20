<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:02
 */
class tipo_conselhoListIterator
{
    protected $tipo_conselhoList;
    protected $currentTipo_conselho = 0;

    public function __construct(Tipo_conselhoList $tipo_conselhoList_in) {
        $this->tipo_conselhoList = $tipo_conselhoList_in;
    }
    public function getCurrentTipo_conselho() {
        if (($this->currentTipo_conselho > 0) &&
            ($this->tipo_conselhoList->getTipo_conselhoCount() >= $this->currentTipo_conselho)) {
            return $this->tipo_conselhoList->getTipo_conselho($this->currentTipo_conselho);
        }
    }
    public function getNextTipo_conselho() {
        if ($this->hasNextTipo_conselho()) {
            return $this->tipo_conselhoList->getTipo_conselho(++$this->currentTipo_conselho);
        } else {
            return NULL;
        }
    }
    public function hasNextTipo_conselho() {
        if ($this->tipo_conselhoList->getTipo_conselhoCount() > $this->currentTipo_conselho) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}