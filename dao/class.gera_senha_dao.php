<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:20
 */
class gera_senha_dao
{
   private $connection;
   public function insert ( gera_senha $gera_senha ){

       require_once "class.connection_factory.php";
       $teste = false;
       $this->connection = new connection();
       $this->connection->beginTransaction();
       try{

           $sql = "INSERT INTO gera_senha 
                  (CD_SENHA, DS_SENHA)  
                  VALUES
                  ( NULL, :DS_SENHA )";
           $stmt = $this->connection->prepare( $sql );
           $stmt->bindValue( ":DS_SENHA", $gera_senha->getDsSenha(), PDO::PARAM_STR );
           $stmt->execute();
           $this->connection->commit();
           $teste = true;
           $this->connection = null;


       }catch ( PDOException $exception ){
           Echo "Erro: ".$exception->getMessage();
       }
       return $teste;
   }

    public function update ( gera_senha $gera_senha ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE gera_senha SET
                     DS_SENHA = :DS_SENHA
                    WHERE CD_SENHA = :CD_SENHA";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":DS_SENHA", $gera_senha->getDsSenha(), PDO::PARAM_STR );
            $stmt->bindValue( ":CD_SENHA", $gera_senha->getCdSenha(), PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    

    public function delete ( $gera_senha ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "DELETE FROM gera_senha WHERE CD_SENHA = :CD_SENHA";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_SENHA", $gera_senha, PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function listaGera_senha( $gera_senha ){
        require_once "class.connection_factory.php";
        require_once "../model/class.gera_senha.php";
        require_once "../services/class.gera_senhaList.php";

        $this->connection = new connection();
        $objList = new gera_senhaList();
        try{

            $sql = "SELECT * FROM gera_senha WHERE DS_SENHA LIKE :USUARIO";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":USUARIO", $gera_senha, PDO::PARAM_STR );
            $stmt->execute();
            while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){
                $obj = new gera_senha();
                $obj->setCdSenha( $row['CD_SENHA'] );
                $obj->setDsSenha( $row['DS_SENHA'] );
                $objList->addGera_senha( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

    public function getGera_Senha( $gera_senha ){
        require_once "class.connection_factory.php";
        require_once "../model/class.gera_senha.php";
        $obj = null;
        $this->connection = new connection();

        try{

            $sql = "SELECT * FROM gera_senha WHERE CD_SENHA = :CD_SENHA";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_SENHA", $gera_senha, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new gera_senha();
                $obj->setCdSenha( $row['CD_SENHA'] );
                $obj->setDsSenha( $row['DS_SENHA'] );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $obj;
    }

 

}