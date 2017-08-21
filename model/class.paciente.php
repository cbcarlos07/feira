<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:10
 */
class paciente
{
    private $cdPaciente;
    private $nmPaciente;
    private $nrCep;
    private $nrCasa;
    private $dsComplemento;
    private $especialidade;
    private $dtNascimento;

    /**
     * @return mixed
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * @param mixed $dtNascimento
     * @return paciente
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getCdPaciente()
    {
        return $this->cdPaciente;
    }

    /**
     * @param mixed $cdPaciente
     * @return paciente
     */
    public function setCdPaciente($cdPaciente)
    {
        $this->cdPaciente = $cdPaciente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmPaciente()
    {
        return $this->nmPaciente;
    }

    /**
     * @param mixed $nmPaciente
     * @return paciente
     */
    public function setNmPaciente($nmPaciente)
    {
        $this->nmPaciente = $nmPaciente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCep()
    {
        return $this->nrCep;
    }

    /**
     * @param mixed $nrCep
     * @return paciente
     */
    public function setNrCep($nrCep)
    {
        $this->nrCep = $nrCep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCasa()
    {
        return $this->nrCasa;
    }

    /**
     * @param mixed $nrCasa
     * @return paciente
     */
    public function setNrCasa($nrCasa)
    {
        $this->nrCasa = $nrCasa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsComplemento()
    {
        return $this->dsComplemento;
    }

    /**
     * @param mixed $dsComplemento
     * @return paciente
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->dsComplemento = $dsComplemento;
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
     * @return paciente
     */
    public function setEspecialidade( especialidade $especialidade)
    {
        $this->especialidade = $especialidade;
        return $this;
    }


}