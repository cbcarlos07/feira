<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 20:59
 */
class usuario
{
    private $cdUsuario;
    private $nmUsuario;
    private $dsLogin;
    private $dsSenha;
    private $snAtivo;

    /**
     * @return mixed
     */
    public function getCdUsuario()
    {
        return $this->cdUsuario;
    }

    /**
     * @param mixed $cdUsuario
     * @return usuario
     */
    public function setCdUsuario($cdUsuario)
    {
        $this->cdUsuario = $cdUsuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmUsuario()
    {
        return $this->nmUsuario;
    }

    /**
     * @param mixed $nmUsuario
     * @return usuario
     */
    public function setNmUsuario($nmUsuario)
    {
        $this->nmUsuario = $nmUsuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsLogin()
    {
        return $this->dsLogin;
    }

    /**
     * @param mixed $dsLogin
     * @return usuario
     */
    public function setDsLogin($dsLogin)
    {
        $this->dsLogin = $dsLogin;
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
     * @return usuario
     */
    public function setDsSenha($dsSenha)
    {
        $this->dsSenha = $dsSenha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnAtivo()
    {
        return $this->snAtivo;
    }

    /**
     * @param mixed $snAtivo
     * @return usuario
     */
    public function setSnAtivo($snAtivo)
    {
        $this->snAtivo = $snAtivo;
        return $this;
    }


}