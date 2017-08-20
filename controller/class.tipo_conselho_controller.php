<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:55
 */
class tipo_conselho_controller
{
    public function insert ( tipo_conselho $tipo_conselho ){
        require_once "../dao/class.tipo_conselho_dao.php";
        $objDao = new tipo_conselho_dao();
        $teste = $objDao->insert( $tipo_conselho );
        return $teste;
    }

    public function update ( tipo_conselho $tipo_conselho ){
        require_once "../dao/class.tipo_conselho_dao.php";
        $objDao = new tipo_conselho_dao();
        $teste = $objDao->update( $tipo_conselho );
        return $teste;
    }

    public function delete ( $tipo_conselho ){
        require_once "../dao/class.tipo_conselho_dao.php";
        $objDao = new tipo_conselho_dao();
        $teste = $objDao->delete( $tipo_conselho );
        return $teste;
    }


    public function listaTipo_conselho( $tipo_conselho ){
        require_once "../dao/class.tipo_conselho_dao.php";
        $objDao = new tipo_conselho_dao();
        $teste = $objDao->listaTipo_conselho( $tipo_conselho );
        return $teste;
    }

    public function getTipo_conselho( $tipo_conselho ){
        require_once "../dao/class.tipo_conselho_dao.php";
        $objDao = new tipo_conselho_dao();
        $teste = $objDao->getTipo_conselho( $tipo_conselho );
        return $teste;
    }

}