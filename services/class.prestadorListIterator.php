<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:02
 */
class prestadorListIterator
{
    protected $prestadorList;
    protected $currentPrestador = 0;

    public function __construct(PrestadorList $prestadorList_in) {
        $this->prestadorList = $prestadorList_in;
    }
    public function getCurrentPrestador() {
        if (($this->currentPrestador > 0) &&
            ($this->prestadorList->getPrestadorCount() >= $this->currentPrestador)) {
            return $this->prestadorList->getPrestador($this->currentPrestador);
        }
    }
    public function getNextPrestador() {
        if ($this->hasNextPrestador()) {
            return $this->prestadorList->getPrestador(++$this->currentPrestador);
        } else {
            return NULL;
        }
    }
    public function hasNextPrestador() {
        if ($this->prestadorList->getPrestadorCount() > $this->currentPrestador) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}