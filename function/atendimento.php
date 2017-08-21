<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 23:12
 */
$acao = $_POST['acao'];

$paciente = 0;
$especialidade = 0;
$id = 0;
if( isset( $_POST['paciente'] ) ){
    $paciente = $_POST['paciente'];
}

if( isset( $_POST['especialidade'] ) ){
    $especialidade = $_POST['especialidade'];
}

if( isset( $_POST['id'] ) ){
    $id = $_POST['id'];
}


switch ( $acao ){

    case 'L':
        getListObj( $especialidade );
        break;
    case 'I':
        inserir( $paciente, $especialidade );
        break;

    case 'G':
        getObj( $id );
        break;
    case 'A':
        update( $id, $paciente, $especialidade );
        break;
    case 'E':
        excluir( $id );
        break;
    case 'U':
        updatePaciente( $paciente, $especialidade );
        break;




}

function getListObj( $especialidade ){
    require_once "../controller/class.atendimento_controller.php";
    require_once "../services/class.atendimentoListIterator.php";


    $oc = new atendimento_controller();
    $lista = $oc->listaAtendimento( $especialidade );
    $objList = new atendimentoListIterator( $lista );
    $array = array();

    while ( $objList->hasNextAtendimento() ){
        $obj = $objList->getNextAtendimento();
        $array[] = array(
            "id"         => $obj->getCdAtendimento(),
            "paciente"   => $obj->getPaciente()->getCdPaciente(),
            "nome"       => $obj->getPaciente()->getNmPaciente(),
            "cdespec"   => $obj->getEspecialidade()->getCdEspecialidade(),
            "especialidade"   => $obj->getEspecialidade()->getDsEspecialidade()

        );
    }
  //  $dados_json = json_encode( $usuarios );

// Cria o arquivo cadastro.json
// O parâmetro "a" indica que o arquivo será aberto para escrita
  //  $fp = fopen("../tables/data3.json", "a");

    // Escreve o conteúdo JSON no arquivo
    //$escreve = fwrite($fp, $dados_json);


  //  fclose($fp);
    echo json_encode( array( "objetos" => $array ) );


}

function inserir ( $paciente, $especialidade ){
    require_once "../controller/class.atendimento_controller.php";
    require_once "../model/class.atendimento.php";
    require_once "../model/class.paciente.php";
    require_once "../model/class.especialidade.php";

    $obj = new atendimento();
    $obj->setPaciente( new paciente() );
    $obj->getPaciente()->setCdPaciente( $paciente );
    $obj->setEspecialidade( new especialidade() );
    $obj->getEspecialidade()->setCdEspecialidade( $especialidade );
    $oc = new atendimento_controller();
    $teste = $oc->insert( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function update ( $id, $paciente, $especialidade ){
    require_once "../controller/class.atendimento_controller.php";
    require_once "../model/class.atendimento.php";
    require_once "../model/class.paciente.php";
    require_once "../model/class.especialidade.php";

    $obj = new atendimento();
    $obj->setCdAtendimento( $id );
    $obj->setPaciente( new paciente() );
    $obj->getPaciente()->setCdPaciente( $paciente );
    $obj->setEspecialidade( new especialidade() );
    $obj->getEspecialidade()->setCdEspecialidade( $especialidade );
    $oc = new atendimento_controller();
    $teste = $oc->update( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}


function updatePaciente ( $paciente, $especialidade ){
    require_once "../controller/class.atendimento_controller.php";
    require_once "../model/class.atendimento.php";
    require_once "../model/class.paciente.php";
    require_once "../model/class.especialidade.php";
    //echo "Alterou paciente";

    $oc = new atendimento_controller();
    $p = $oc->getPacAtd( $paciente );

    if( $p > 0 ){
        $obj = new atendimento();
        $obj->setPaciente( new paciente() );
        $obj->getPaciente()->setCdPaciente( $paciente );
        $obj->setEspecialidade( new especialidade() );
        $obj->getEspecialidade()->setCdEspecialidade( $especialidade );

        $teste = $oc->updatePaciente( $obj );
        if( $teste ){

            echo json_encode( array( "sucesso" => 1 ) );

        }
        else{

            echo json_encode( array( "sucesso" => 0 ) );

        }
    }else{

        $obj = new atendimento();
        $obj->setPaciente( new paciente() );
        $obj->getPaciente()->setCdPaciente( $paciente );
        $obj->setEspecialidade( new especialidade() );
        $obj->getEspecialidade()->setCdEspecialidade( $especialidade );

        $teste = $oc->insert( $obj );
        if( $teste ){

            echo json_encode( array( "sucesso" => 1 ) );

        }
        else{

            echo json_encode( array( "sucesso" => 0 ) );

        }

    }


}


function getObj($id){
    require_once "../controller/class.atendimento_controller.php";
    require_once "../model/class.atendimento.php";

    $oc = new atendimento_controller(); //oc Objeto Controller
    $obj = $oc->getAtendimento( $id );

    $array['id']             = $obj->getCdAtendimento();
    $array['especialidade']  = $obj->getEspecialidade()->getCdEspecialidade();
    $array['paciente']       = $obj->getPaciente()->getCdPaciente();

    echo json_encode( $array );

}

function excluir( $id ){
    require_once "../controller/class.atendimento_controller.php";
    $oc = new atendimento_controller();
    $teste = $oc->delete( $id );
    if( $teste ){
        echo json_encode( array( "success" => 1) );
    }else{
        echo json_encode( array( "success" => 0) );
    }
}
