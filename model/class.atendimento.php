<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:42
 */
class atendimento
{
 private $cdAtendimento;
 private $especialidade;
 private $paciente;

    /**
     * @return mixed
     */
    public function getCdAtendimento()
    {
        return $this->cdAtendimento;
    }

    /**
     * @param mixed $cdAtendimento
     * @return atendimento
     */
    public function setCdAtendimento($cdAtendimento)
    {
        $this->cdAtendimento = $cdAtendimento;
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
     * @return atendimento
     */
    public function setEspecialidade( especialidade $especialidade)
    {
        $this->especialidade = $especialidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @param mixed $paciente
     * @return atendimento
     */
    public function setPaciente( paciente $paciente)
    {
        $this->paciente = $paciente;
        return $this;
    }


}