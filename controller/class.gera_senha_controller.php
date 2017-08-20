<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:55
 */
class gera_senha_controller
{
    public function insert ( gera_senha $gera_senha ){
        require_once "../dao/class.gera_senha_dao.php";
        $objDao = new gera_senha_dao();
        $teste = $objDao->insert( $gera_senha );
        return $teste;
    }

    public function update ( gera_senha $gera_senha ){
        require_once "../dao/class.gera_senha_dao.php";
        $objDao = new gera_senha_dao();
        $teste = $objDao->update( $gera_senha );
        return $teste;
    }

    public function delete ( $gera_senha ){
        require_once "../dao/class.gera_senha_dao.php";
        $objDao = new gera_senha_dao();
        $teste = $objDao->delete( $gera_senha );
        return $teste;
    }


    public function listaGera_senha( $gera_senha ){
        require_once "../dao/class.gera_senha_dao.php";
        $objDao = new gera_senha_dao();
        $teste = $objDao->listaGera_senha( $gera_senha );
        return $teste;
    }

    public function getGera_senha( $gera_senha ){
        require_once "../dao/class.gera_senha_dao.php";
        $objDao = new gera_senha_dao();
        $teste = $objDao->getGera_senha( $gera_senha );
        return $teste;
    }

}