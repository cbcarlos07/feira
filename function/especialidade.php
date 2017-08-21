<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 23:12
 */
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
    case 'Z':
        getTotais(  );
        break;




}

function getListObj(){
    require_once "../controller/class.especialidade_controller.php";
    require_once "../services/class.especialidadeListIterator.php";
    require_once "../model/class.especialidade.php";

    $oc = new especialidade_controller();
    $lista = $oc->listaEspecialidade( '%%' );
    $objList = new especialidadeListIterator( $lista );
    $array = array();

    while ( $objList->hasNextEspecialidade() ){
        $obj = $objList->getNextEspecialidade();
        $array[] = array(
            "id"     => $obj->getCdEspecialidade(),
            "name"   => $obj->getDsEspecialidade()
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

function inserir ( $descricao ){
    require_once "../controller/class.especialidade_controller.php";
    require_once "../model/class.especialidade.php";

    $obj = new especialidade();
    $obj->setDsEspecialidade( $descricao );
    $oc = new especialidade_controller();
    $teste = $oc->insert( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function update ( $id, $descricao ){
    require_once "../controller/class.especialidade_controller.php";
    require_once "../model/class.especialidade.php";

    $obj = new especialidade();
    $obj->setDsEspecialidade( $descricao );
    $obj->setCdEspecialidade( $id );
    $oc = new especialidade_controller();
    $teste = $oc->update( $obj );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }
}

function getObj($id){
    require_once "../controller/class.especialidade_controller.php";
    require_once "../model/class.especialidade.php";

    $oc = new especialidade_controller(); //oc Objeto Controller
    $obj = $oc->getEspecialidade( $id );

    $array['id']         = $obj->getCdEspecialidade();
    $array['descricao']  = $obj->getDsEspecialidade();

    echo json_encode( $array );

}

function excluir( $id ){
    require_once "../controller/class.especialidade_controller.php";
    $oc = new especialidade_controller();
    $teste = $oc->delete( $id );
    if( $teste ){
        echo json_encode( array( "success" => 1) );
    }else{
        echo json_encode( array( "success" => 0) );
    }
}

function getTotais(){
    require_once "../controller/class.especialidade_controller.php";
    require_once "../services/class.especialidadeListIterator.php";
    require_once "../model/class.especialidade.php";

    $oc = new especialidade_controller();
    $lista = $oc->getTotais();
    $listIt = new especialidadeListIterator( $lista );
    $espec = array();
    while ( $listIt->hasNextEspecialidade() ){
        $especialidade = $listIt->getNextEspecialidade();
        $espec[] = array(
            "total" => $especialidade->getCdEspecialidade(),
            "espec" => $especialidade->getDsEspecialidade()
        );
    }
    echo json_encode( $espec );

}
