<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 23:12
 */
require_once "../include/error.php";
$acao = $_POST['acao'];

$descricao = "";
$id = 0;
if( isset( $_POST['descricao'] ) ){
    $descricao = $_POST['descricao'];
}

if( isset( $_POST['id'] ) ){
    $id = $_POST['id'];
}


switch ( $acao ){

    case 'L':
        getListObj();
        break;
    case 'I':
        inserir( $descricao );
        break;

    case 'G':
        getObj( $id );
        break;
    case 'A':
        update( $id, $descricao );
        break;
    case 'E':
        excluir( $id );
        break;




}

function getListObj(){
    require_once "../controller/class.tipo_conselho_controller.php";
    require_once "../services/class.tipo_conselhoListIterator.php";
    require_once "../model/class.tipo_conselho.php";

    $oc = new tipo_conselho_controller();
    $lista = $oc->listaTipo_conselho( '%%' );
    $objList = new tipo_conselhoListIterator( $lista );
    $array = array();

    while ( $objList->hasNextTipo_conselho() ){
        $obj = $objList->getNextTipo_conselho();
        $array[] = array(
            "id"     => $obj->getCdTipoConselho(),
            "name"   => $obj->getDsTipoConselho()
        );
    }
    echo json_encode( array( "objetos" => $array ) );


}

function inserir ( $descricao ){
    require_once "../controller/class.tipo_conselho_controller.php";
    require_once "../model/class.tipo_conselho.php";

    $obj = new tipo_conselho();
    $obj->setDsTipoConselho( $descricao );
    $oc = new tipo_conselho_controller();
    $teste = $oc->insert( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function update ( $id, $descricao ){
    require_once "../controller/class.tipo_conselho_controller.php";
    require_once "../model/class.tipo_conselho.php";

    $obj = new tipo_conselho();
    $obj->setDsTipoConselho( $descricao );
    $obj->setCdTipoConselho( $id );
    $oc = new tipo_conselho_controller();
    $teste = $oc->update( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function getObj($id){
    require_once "../controller/class.tipo_conselho_controller.php";
    require_once "../model/class.tipo_conselho.php";

    $oc = new tipo_conselho_controller(); //oc Objeto Controller
    $obj = $oc->getTipo_conselho( $id );

    $array['id']         = $obj->getCdTipoConselho();
    $array['descricao']  = $obj->getDsTipoConselho();

    echo json_encode( $array );

}

function excluir( $id ){
    require_once "../controller/class.tipo_conselho_controller.php";
    $oc = new tipo_conselho_controller();
    $teste = $oc->delete( $id );
    if( $teste ){
        echo json_encode( array( "success" => 1) );
    }else{
        echo json_encode( array( "success" => 0) );
    }
}
