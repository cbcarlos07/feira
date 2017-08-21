<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 22:55
 */
class especialidade_controller
{
    public function insert ( especialidade $especialidade ){
        require_once "../dao/class.especialidade_dao.php";
        $objDao = new especialidade_dao();
        $teste = $objDao->insert( $especialidade );
        return $teste;
    }

    public function update ( especialidade $especialidade ){
        require_once "../dao/class.especialidade_dao.php";
        $objDao = new especialidade_dao();
        $teste = $objDao->update( $especialidade );
        return $teste;
    }

    public function delete ( $especialidade ){
        require_once "../dao/class.especialidade_dao.php";
        $objDao = new especialidade_dao();
        $teste = $objDao->delete( $especialidade );
        return $teste;
    }


    public function listaEspecialidade( $especialidade ){
        require_once "../dao/class.especialidade_dao.php";
        $objDao = new especialidade_dao();
        $teste = $objDao->listaEspecialidade( $especialidade );
        return $teste;
    }

    public function getEspecialidade( $especialidade ){
        require_once "../dao/class.especialidade_dao.php";
        $objDao = new especialidade_dao();
        $teste = $objDao->getEspecialidade( $especialidade );
        return $teste;
    }

    public function getTotais(  ){
        require_once "../dao/class.especialidade_dao.php";
        $objDao = new especialidade_dao();
        $teste = $objDao->getTotais(  );
        return $teste;
    }

}