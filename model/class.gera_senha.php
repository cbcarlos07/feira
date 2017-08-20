<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:17
 */
class gera_senha
{
    private $cdSenha;
    private $dsSenha;

    /**
     * @return mixed
     */
    public function getCdSenha()
    {
        return $this->cdSenha;
    }

    /**
     * @param mixed $cdSenha
     * @return gera_senha
     */
    public function setCdSenha($cdSenha)
    {
        $this->cdSenha = $cdSenha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsSenha()
    {
        return $this->dsSenha;
    }

    /**
     * @param mixed $dsSenha
     * @return gera_senha
     */
    public function setDsSenha($dsSenha)
    {
        $this->dsSenha = $dsSenha;
        return $this;
    }

}