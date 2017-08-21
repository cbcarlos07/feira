<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 23:12
 */
require_once "../include/error.php";
$acao = $_POST['acao'];

$id = 0;
$nome = "";
$nascimento = "";
$nrcep = "";
$nrcasa = "";
$complemento = "";
$especialidade = 0;
$telefone = "";


if( isset( $_POST['id'] ) ){
    $id = $_POST['id'];
}

if( isset( $_POST['telefone'] ) ){
    $telefone = $_POST['telefone'];
}

if( isset( $_POST['nome'] ) ){
    $nome = $_POST['nome'];
}

if( isset( $_POST['nascimento'] ) ){
    $nascimento = $_POST['nascimento'];
}

if( isset( $_POST['nrcep'] ) ){
    $nrcep = $_POST['nrcep'];
}

if( isset( $_POST['nrcasa'] ) ){
    $nrcasa = $_POST['nrcasa'];
}

if( isset( $_POST['complemento'] ) ){
    $complemento = $_POST['complemento'];
}

if( isset( $_POST['especialidade'] ) ){
    $especialidade = $_POST['especialidade'];
}






switch ( $acao ){

    case 'L':
        getListObj();
        break;
    case 'I':
        inserir( $nome, $nascimento, $nrcep, $nrcasa, $complemento, $telefone );
        break;

    case 'G':
        getObj( $id );
        break;
    case 'A':
        update( $id, $nome, $nascimento, $nrcep, $nrcasa, $complemento, $telefone );
        break;
    case 'E':
        excluir( $id );
        break;




}

function getListObj(){
    require_once "../controller/class.paciente_controller.php";
    require_once "../services/class.pacienteListIterator.php";


    $oc = new paciente_controller();
    $lista = $oc->listaPaciente( '%%' );
    $objList = new pacienteListIterator( $lista );
    $array = array();

    while ( $objList->hasNextPaciente() ){
        $obj = $objList->getNextPaciente();
        $array[] = array(
            "id"     => $obj->getCdPaciente(),
            "name"   => $obj->getNmPaciente(),
        );
    }
    echo json_encode( array( "objetos" => $array ) );


}

function inserir ( $nome, $nascimento, $cep, $casa, $complemento, $telefone ){
    require_once "../controller/class.paciente_controller.php";
    require_once "../controller/class.telefone_paciente_controller.php";
    require_once "../model/class.paciente.php";
    require_once "../model/class.telefone_paciente.php";

    $dataArray = explode("/", $nascimento);
    $dataMySQL = $dataArray[2]."-".$dataArray[1]."-".$dataArray[0];
    $telefones = json_decode( $telefone );
    $obj = new paciente();
    $obj->setNmPaciente( $nome );
    $obj->setDtNascimento( $dataMySQL );
    $subs = array(".","-");
    $newCEP = str_replace( $subs, "", $cep );
    $obj->setNrCep( $newCEP );
    $obj->setNrCasa( $casa );
    $obj->setDsComplemento( $complemento );
    $oc = new paciente_controller();
    $teste = $oc->insert( $obj );

    $phoneObj = new telefone_paciente();
    $tc       = new telefone_paciente_controller();

    if( $teste > 0 ){
        foreach ( $telefones as $item => $value ){
            $phoneObj->setPaciente( $teste );
            $phoneObj->setNrTelefone( $value->{'Telefone'} );
            $phoneObj->setObsTelefone( $value->{'Obs'} );
            $phoneObj->setTpTelefone( $value->{'Tipo'} );
            $result = $tc->insert( $phoneObj );

        }


    }

    if( $teste > 0 ){
        echo json_encode( array( "sucesso" => 1, "paciente" => $teste ) );
    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function update ( $id, $nome, $nascimento, $cep, $casa, $complemento, $telefone ){
    require_once "../controller/class.paciente_controller.php";
    require_once "../controller/class.telefone_paciente_controller.php";
    require_once "../model/class.paciente.php";
    require_once "../model/class.telefone_paciente.php";

    $dataArray = explode("/", $nascimento);
    $dataMySQL = $dataArray[2]."-".$dataArray[1]."-".$dataArray[0];
    $telefones = json_decode( $telefone );
    $obj = new paciente();
    $obj->setCdPaciente( $id );
    $obj->setNmPaciente( $nome );
    $obj->setDtNascimento( $dataMySQL );
    $subs = array(".","-");
    $newCEP = str_replace( $subs, "", $cep );
    $obj->setNrCep( $newCEP );
    $obj->setNrCasa( $casa );
    $obj->setDsComplemento( $complemento );
    $oc = new paciente_controller();
    $teste = $oc->update( $obj );

    $phoneObj = new telefone_paciente();
    $tc       = new telefone_paciente_controller();

    if( $teste > 0 ){
        $removeFone = $tc->delete( $teste );
        foreach ( $telefones as $item => $value ){
            $phoneObj->setPaciente( $teste );
            $phoneObj->setNrTelefone( $value->{'Telefone'} );
            $phoneObj->setObsTelefone( $value->{'Obs'} );
            $phoneObj->setTpTelefone( $value->{'Tipo'} );
            $result = $tc->insert( $phoneObj );

        }


    }

    if( $teste > 0 ){
        echo json_encode( array( "sucesso" => 1 ) );
    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function getObj($id){
    require_once "../controller/class.paciente_controller.php";
    require_once "../controller/class.telefone_paciente_controller.php";
    require_once "../model/class.paciente.php";
    require_once "../model/class.telefone_paciente.php";
    require_once "../services/class.telefone_pacienteListIterator.php";

    $oc = new paciente_controller(); //oc Objeto Controller
    $tpc = new telefone_paciente_controller(); //oc Objeto Controller
    $obj = $oc->getPaciente( $id );

    $array['id']         = $obj->getCdPaciente();
    $array['nome']       = $obj->getNmPaciente();
    $array['nascimento'] = $obj->getDtNascimento();
    $array['nrcep']      = $obj->getNrCep();
    $array['nrcasa']     = $obj->getNrCasa();
    $array['complemento'] = $obj->getDsComplemento();

    $l_Tel = $tpc->listaTelefone_paciente( $obj->getCdPaciente() ) ;
    $telList = new telefone_pacienteListIterator( $l_Tel );
    $telefones = array();
    while ( $telList->hasNextTelefone_paciente() ){
        $fones = $telList->getNextTelefone_paciente();
        $telefones[] = array(
            "telefone" => $fones->getNrTelefone(),
            "tipo"     => $fones->getTpTelefone(),
            "strtipo"  => getTipoTelefone( $fones->getTpTelefone() ),
            "obs"      => $fones->getObsTelefone()
        );
    }
    $array['fones'] = $telefones;

    echo json_encode( $array );

}

 function getTipoTelefone( $tipo ){
    $tpTel = "";
    switch ( $tipo ){
        case 'C':
            $tpTel = "Celular";
            break;
        case 'R':
            $tpTel = "Residencial";
            break;
    }
    return $tpTel;
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
