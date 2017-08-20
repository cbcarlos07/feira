<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:07
 */
class prestador
{
    private $cdPrestador;
    private $nmPrestador;
    private $tipoConselho;
    private $nrConselho;
    private $especialidade;

    /**
     * @return mixed
     */
    public function getCdPrestador()
    {
        return $this->cdPrestador;
    }

    /**
     * @param mixed $cdPrestador
     * @return prestador
     */
    public function setCdPrestador($cdPrestador)
    {
        $this->cdPrestador = $cdPrestador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmPrestador()
    {
        return $this->nmPrestador;
    }

    /**
     * @param mixed $nmPrestador
     * @return prestador
     */
    public function setNmPrestador($nmPrestador)
    {
        $this->nmPrestador = $nmPrestador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoConselho()
    {
        return $this->tipoConselho;
    }

    /**
     * @param mixed $tipoConselho
     * @return prestador
     */
    public function setTipoConselho( tipo_conselho $tipoConselho)
    {
        $this->tipoConselho = $tipoConselho;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrConselho()
    {
        return $this->nrConselho;
    }

    /**
     * @param mixed $nrConselho
     * @return prestador
     */
    public function setNrConselho($nrConselho)
    {
        $this->nrConselho = $nrConselho;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    /**
     * @param mixed $especialidade
     * @return prestador
     */
    public function setEspecialidade( especialidade $especialidade)
    {
        $this->especialidade = $especialidade;
        return $this;
    }


}