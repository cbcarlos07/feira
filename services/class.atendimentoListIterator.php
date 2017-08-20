<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:02
 */
class atendimentoListIterator
{
    protected $atendimentoList;
    protected $currentAtendimento = 0;

    public function __construct(AtendimentoList $atendimentoList_in) {
        $this->atendimentoList = $atendimentoList_in;
    }
    public function getCurrentAtendimento() {
        if (($this->currentAtendimento > 0) &&
            ($this->atendimentoList->getAtendimentoCount() >= $this->currentAtendimento)) {
            return $this->atendimentoList->getAtendimento($this->currentAtendimento);
        }
    }
    public function getNextAtendimento() {
        if ($this->hasNextAtendimento()) {
            return $this->atendimentoList->getAtendimento(++$this->currentAtendimento);
        } else {
            return NULL;
        }
    }
    public function hasNextAtendimento() {
        if ($this->atendimentoList->getAtendimentoCount() > $this->currentAtendimento) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}