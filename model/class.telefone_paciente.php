<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:13
 */
class telefone_paciente
{
    private $paciente;
    private $nrTelefone;
    private $tpTelefone;
    private $obsTelefone;

    /**
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @param mixed $paciente
     * @return telefone_paciente
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrTelefone()
    {
        return $this->nrTelefone;
    }

    /**
     * @param mixed $nrTelefone
     * @return telefone_paciente
     */
    public function setNrTelefone($nrTelefone)
    {
        $this->nrTelefone = $nrTelefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTpTelefone()
    {
        return $this->tpTelefone;
    }

    /**
     * @param mixed $tpTelefone
     * @return telefone_paciente
     */
    public function setTpTelefone($tpTelefone)
    {
        $this->tpTelefone = $tpTelefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObsTelefone()
    {
        return $this->obsTelefone;
    }

    /**
     * @param mixed $obsTelefone
     * @return telefone_paciente
     */
    public function setObsTelefone($obsTelefone)
    {
        $this->obsTelefone = $obsTelefone;
        return $this;
    }


}