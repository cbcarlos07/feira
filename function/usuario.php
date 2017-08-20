<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 23:12
 */
$acao = $_POST['acao'];

$login = "";
$senha = "";
$lembrar = "";
$nome = "";
if( isset( $_POST['login'] ) ){
    $login = $_POST['login'];
}

if( isset( $_POST['nome'] ) ){
    $nome = $_POST['nome'];
}
if( isset( $_POST['senha'] ) ){
    $senha = $_POST['senha'];
}

if( isset( $_POST['lembrar'] ) ){
    $lembrar = $_POST['lembrar'];
}

switch ( $acao ){

    case 'L':
        logar( $login, $senha, $lembrar );
        break;
    case 'U':
        getListUsuarios();
        break;
    case 'I':
        inserir( $nome, $login, $senha );
        break;


}

function logar( $login, $senha, $lembrar ){
    require_once "../controller/class.usuario_controller.php";
    $usuarioController = new usuario_controller();

    $usuario = $usuarioController->loginSenha( $login, $senha );
    // var_dump($usuario);
    if( $usuario != null){
        session_start();
        if( $usuario->getSnSenhaAtual() == 'S' ){

            if( $lembrar == 'S' ){
                $ck_login  = "login";
                $ck_vlogin = $login;
                setcookie( $ck_login, $ck_vlogin, time() + ( 86400 * 30 ), "/" ); //86400 = 1 dia

                $ck_pwd  = "senha";
                $ck_vpwd = $senha;
                setcookie( $ck_pwd, $ck_vpwd, time() + ( 86400 * 30 ), "/" ); //86400 = 1 dia

                $ck_remember  = "checked";
                $ck_vremember = 'S';
                setcookie( $ck_remember, $ck_vremember, time() + ( 86400 * 30 ), "/" ); //86400 = 1 dia
            }

            $_SESSION['login'] = $login;
            $nome = explode(" ", $usuario->getNmUsuario() );
            $_SESSION['nome'] = $nome[0];
            $_SESSION['sobrenome'] = $nome[count($nome) - 1];
            $retorno['sucesso'] = 1;
            $retorno['codigo']  = $usuario->getCdUsuario();
            echo json_encode( $retorno );


        }else{
            $_SESSION['login'] = $login;
            $retorno['sucesso'] = 0;
            $retorno['codigo']  = $usuario->getCdUsuario();
            echo json_encode( $retorno );

        }

    }else{

        echo json_encode( array( "sucesso" => -1 ) );
    }
}

function getListUsuarios(){
    require_once "../controller/class.usuario_controller.php";
    require_once "../services/class.usuarioListIterator.php";
    require_once "../model/class.usuario.php";

    $uc = new usuario_controller();
    $lista = $uc->listaUsuario( '%%' );
    $userList = new usuarioListIterator( $lista );
    $usuarios = array();

    while ( $userList->hasNextUsuario() ){
        $usuario = $userList->getNextUsuario();
        $usuarios[] = array(
            "codigo" => $usuario->getCdUsuario(),
            "nome"   => $usuario->getNmUsuario(),
            "login"  => $usuario->getDsLogin(),
            "ativo"  => $usuario->getSnAtivo()
        );
    }

    echo json_encode( array( "usuarios" => $usuarios ) );


}

function inserir ( $nome, $login, $senha ){
    require_once "../controller/class.usuario_controller.php";
    require_once "../model/class.usuario.php";

    $usuario = new usuario();
    $usuario->setNmUsuario( $nome );
    $usuario->setDsLogin( $login );
    $usuario->setDsSenha( $senha );
    $uc = new usuario_controller();
    $teste = $uc->insert( $usuario );
    if( $teste ){

        echo json_encode( array( "sucesso" => 1 ) );

    }
    else{

        echo json_encode( array( "sucesso" => 0 ) );

    }



}