<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:55
 */
class atendimento_controller
{
    public function insert ( atendimento $atendimento ){
        require_once "../dao/class.atendimento_dao.php";
        $objDao = new atendimento_dao();
        $teste = $objDao->insert( $atendimento );
        return $teste;
    }

    public function update ( atendimento $atendimento ){
        require_once "../dao/class.atendimento_dao.php";
        $objDao = new atendimento_dao();
        $teste = $objDao->update( $atendimento );
        return $teste;
    }

    public function updatePaciente ( atendimento $atendimento ){
        require_once "../dao/class.atendimento_dao.php";
        $objDao = new atendimento_dao();
        $teste = $objDao->updatePaciente( $atendimento );
        return $teste;
    }

    public function delete ( $atendimento ){
        require_once "../dao/class.atendimento_dao.php";
        $objDao = new atendimento_dao();
        $teste = $objDao->delete( $atendimento );
        return $teste;
    }


    public function listaAtendimento( $atendimento ){
        require_once "../dao/class.atendimento_dao.php";
        $objDao = new atendimento_dao();
        $teste = $objDao->listaAtendimento( $atendimento );
        return $teste;
    }

    public function getAtendimento( $atendimento ){
        require_once "../dao/class.atendimento_dao.php";
        $objDao = new atendimento_dao();
        $teste = $objDao->getAtendimento( $atendimento );
        return $teste;
    }

    public function getPacAtd( $atendimento ){
        require_once "../dao/class.atendimento_dao.php";
        $objDao = new atendimento_dao();
        $teste = $objDao->getPacAtd( $atendimento );
        return $teste;
    }

}