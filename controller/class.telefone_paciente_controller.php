<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:55
 */
class telefone_paciente_controller
{
    public function insert ( telefone_paciente $telefone_paciente ){
        require_once "../dao/class.telefone_paciente_dao.php";
        $objDao = new telefone_paciente_dao();
        $teste = $objDao->insert( $telefone_paciente );
        return $teste;
    }

    public function update ( telefone_paciente $telefone_paciente ){
        require_once "../dao/class.telefone_paciente_dao.php";
        $objDao = new telefone_paciente_dao();
        $teste = $objDao->update( $telefone_paciente );
        return $teste;
    }

    public function delete ( $telefone_paciente ){
        require_once "../dao/class.telefone_paciente_dao.php";
        $objDao = new telefone_paciente_dao();
        $teste = $objDao->delete( $telefone_paciente );
        return $teste;
    }


    public function listaTelefone_paciente( $telefone_paciente ){
        require_once "../dao/class.telefone_paciente_dao.php";
        $objDao = new telefone_paciente_dao();
        $teste = $objDao->listaTelefone_paciente( $telefone_paciente );
        return $teste;
    }

    public function getTelefone_paciente( $telefone_paciente ){
        require_once "../dao/class.telefone_paciente_dao.php";
        $objDao = new telefone_paciente_dao();
        $teste = $objDao->getTelefone_paciente( $telefone_paciente );
        return $teste;
    }

}