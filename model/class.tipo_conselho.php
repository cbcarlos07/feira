<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:05
 */
class tipo_conselho
{
    private $cdTipoConselho;
    private $dsTipoConselho;

    /**
     * @return mixed
     */
    public function getCdTipoConselho()
    {
        return $this->cdTipoConselho;
    }

    /**
     * @param mixed $cdTipoConselho
     * @return tipo_conselho
     */
    public function setCdTipoConselho($cdTipoConselho)
    {
        $this->cdTipoConselho = $cdTipoConselho;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsTipoConselho()
    {
        return $this->dsTipoConselho;
    }

    /**
     * @param mixed $dsTipoConselho
     * @return tipo_conselho
     */
    public function setDsTipoConselho($dsTipoConselho)
    {
        $this->dsTipoConselho = $dsTipoConselho;
        return $this;
    }


}