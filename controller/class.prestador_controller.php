<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:55
 */
class prestador_controller
{
    public function insert ( prestador $prestador ){
        require_once "../dao/class.prestador_dao.php";
        $objDao = new prestador_dao();
        $teste = $objDao->insert( $prestador );
        return $teste;
    }

    public function update ( prestador $prestador ){
        require_once "../dao/class.prestador_dao.php";
        $objDao = new prestador_dao();
        $teste = $objDao->update( $prestador );
        return $teste;
    }

    public function delete ( $prestador ){
        require_once "../dao/class.prestador_dao.php";
        $objDao = new prestador_dao();
        $teste = $objDao->delete( $prestador );
        return $teste;
    }


    public function listaPrestador( $prestador ){
        require_once "../dao/class.prestador_dao.php";
        $objDao = new prestador_dao();
        $teste = $objDao->listaPrestador( $prestador );
        return $teste;
    }

    public function getPrestador( $prestador ){
        require_once "../dao/class.prestador_dao.php";
        $objDao = new prestador_dao();
        $teste = $objDao->getPrestador( $prestador );
        return $teste;
    }

}