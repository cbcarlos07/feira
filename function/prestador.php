<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 23:12
 */
require_once "../include/error.php";
$acao = $_POST['acao'];

$nome = "";
$id = 0;
$especialidade = 0;
$tipo_conselho = 0;
$nr_conselho = "";
if( isset( $_POST['nome'] ) ){
    $nome = $_POST['nome'];
}

if( isset( $_POST['id'] ) ){
    $id = $_POST['id'];
}

if( isset( $_POST['especialidade'] ) ){
    $especialidade = $_POST['especialidade'];
}

if( isset( $_POST['tipo_conselho'] ) ){
    $tipo_conselho = $_POST['tipo_conselho'];
}

if( isset( $_POST['nr_conselho'] ) ){
    $nr_conselho = $_POST['nr_conselho'];
}




switch ( $acao ){

    case 'L':
        getListObj();
        break;
    case 'I':
        inserir( $nome, $especialidade );
        break;

    case 'G':
        getObj( $id );
        break;
    case 'A':
        update( $id, $nome,  $especialidade );
        break;
    case 'E':
        excluir( $id );
        break;




}

function getListObj(){
    require_once "../controller/class.prestador_controller.php";
    require_once "../services/class.prestadorListIterator.php";
    require_once "../model/class.prestador.php";

    $oc = new prestador_controller();
    $lista = $oc->listaPrestador( '%%' );
    $objList = new prestadorListIterator( $lista );
    $array = array();

    while ( $objList->hasNextPrestador() ){
        $obj = $objList->getNextPrestador();
        $array[] = array(
            "id"     => $obj->getCdPrestador(),
            "name"   => $obj->getNmPrestador(),
            "especialidade" => $obj->getEspecialidade()->getDsEspecialidade()
        );
    }
    echo json_encode( array( "objetos" => $array ) );


}

function inserir ( $nome, $especialidade ){
    require_once "../controller/class.prestador_controller.php";
    require_once "../model/class.prestador.php";
    require_once "../model/class.tipo_conselho.php";
    require_once "../model/class.especialidade.php";

    $obj = new prestador();
    $obj->setNmPrestador( $nome );
    $obj->setEspecialidade( new especialidade() );
    $obj->getEspecialidade()->setCdEspecialidade( $especialidade );
    $oc = new prestador_controller();
    $teste = $oc->insert( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function update ( $id, $nome,  $especialidade ){
    require_once "../controller/class.prestador_controller.php";
    require_once "../model/class.prestador.php";
    require_once "../model/class.tipo_conselho.php";
    require_once "../model/class.especialidade.php";

    $obj = new prestador();
    $obj->setCdPrestador( $id );
    $obj->setNmPrestador( $nome );
    $obj->setEspecialidade( new especialidade() );
    $obj->getEspecialidade()->setCdEspecialidade( $especialidade );
    $oc = new prestador_controller();
    $teste = $oc->update( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function getObj($id){
    require_once "../controller/class.prestador_controller.php";
    require_once "../model/class.prestador.php";

    $oc = new prestador_controller(); //oc Objeto Controller
    $obj = $oc->getPrestador( $id );

    $array['id']         = $obj->getCdPrestador();
    $array['nome']       = $obj->getNmPrestador();
    $array['especialidade']  = $obj->getEspecialidade()->getCdEspecialidade();

    echo json_encode( $array );

}

function excluir( $id ){
    require_once "../controller/class.prestador_controller.php";
    $oc = new prestador_controller();
    $teste = $oc->delete( $id );
    if( $teste ){
        echo json_encode( array( "success" => 1) );
    }else{
        echo json_encode( array( "success" => 0) );
    }
}
