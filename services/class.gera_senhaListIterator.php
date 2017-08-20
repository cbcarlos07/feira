<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:02
 */
class gera_senhaListIterator
{
    protected $gera_senhaList;
    protected $currentGera_senha = 0;

    public function __construct(Gera_senhaList $gera_senhaList_in) {
        $this->gera_senhaList = $gera_senhaList_in;
    }
    public function getCurrentGera_senha() {
        if (($this->currentGera_senha > 0) &&
            ($this->gera_senhaList->getGera_senhaCount() >= $this->currentGera_senha)) {
            return $this->gera_senhaList->getGera_senha($this->currentGera_senha);
        }
    }
    public function getNextGera_senha() {
        if ($this->hasNextGera_senha()) {
            return $this->gera_senhaList->getGera_senha(++$this->currentGera_senha);
        } else {
            return NULL;
        }
    }
    public function hasNextGera_senha() {
        if ($this->gera_senhaList->getGera_senhaCount() > $this->currentGera_senha) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}