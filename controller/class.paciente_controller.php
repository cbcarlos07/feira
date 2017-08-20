<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:55
 */
class paciente_controller
{
    public function insert ( paciente $paciente ){
        require_once "../dao/class.paciente_dao.php";
        $objDao = new paciente_dao();
        $teste = $objDao->insert( $paciente );
        return $teste;
    }

    public function update ( paciente $paciente ){
        require_once "../dao/class.paciente_dao.php";
        $objDao = new paciente_dao();
        $teste = $objDao->update( $paciente );
        return $teste;
    }

    public function delete ( $paciente ){
        require_once "../dao/class.paciente_dao.php";
        $objDao = new paciente_dao();
        $teste = $objDao->delete( $paciente );
        return $teste;
    }


    public function listaPaciente( $paciente ){
        require_once "../dao/class.paciente_dao.php";
        $objDao = new paciente_dao();
        $teste = $objDao->listaPaciente( $paciente );
        return $teste;
    }

    public function getPaciente( $paciente ){
        require_once "../dao/class.paciente_dao.php";
        $objDao = new paciente_dao();
        $teste = $objDao->getPaciente( $paciente );
        return $teste;
    }

}