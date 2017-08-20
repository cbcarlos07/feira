<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:20
 */
class tipo_conselho_dao
{
   private $connection;
   public function insert ( tipo_conselho $tipo_conselho ){

       require_once "class.connection_factory.php";
       $teste = false;
       $this->connection = new connection();
       $this->connection->beginTransaction();
       try{

           $sql = "INSERT INTO tipo_conselho 
                  (CD_TIPO_CONSELHO, DS_TIPO_CONSELHO)  
                  VALUES
                  (NULL, :DS_TIPO_CONSELHO)";
           $stmt = $this->connection->prepare( $sql );
           $stmt->bindValue( ":DS_TIPO_CONSELHO", $tipo_conselho->getDsTipoConselho(), PDO::PARAM_STR );
           $stmt->execute();
           $this->connection->commit();
           $teste = true;
           $this->connection = null;


       }catch ( PDOException $exception ){
           Echo "Erro: ".$exception->getMessage();
       }
       return $teste;
   }

    public function update ( tipo_conselho $tipo_conselho ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE tipo_conselho SET
                     DS_TIPO_CONSELHO = :DS_TIPO_CONSELHO
                    WHERE CD_TIPO_CONSELHO = :CD_TIPO_CONSELHO";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":DS_TIPO_CONSELHO", $tipo_conselho->getDsTipoConselho(), PDO::PARAM_STR );
            $stmt->bindValue( ":CD_TIPO_CONSELHO", $tipo_conselho->getCdTipoConselho(), PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    

    public function delete ( $tipo_conselho ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "DELETE FROM tipo_conselho WHERE CD_TIPO_CONSELHO = :CD_TIPO_CONSELHO";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_TIPO_CONSELHO", $tipo_conselho, PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function listaTipo_conselho( $tipo_conselho ){
        require_once "class.connection_factory.php";
        require_once "../model/class.tipo_conselho.php";
        require_once "../services/class.tipo_conselhoList.php";

        $this->connection = new connection();
        $objList = new tipo_conselhoList();
        try{

            $sql = "SELECT * FROM tipo_conselho WHERE DS_TIPO_CONSELHO LIKE :USUARIO";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":USUARIO", $tipo_conselho, PDO::PARAM_STR );
            $stmt->execute();
            while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){
                $obj = new tipo_conselho();
                $obj->setCdTipoConselho( $row['CD_TIPO_CONSELHO'] );
                $obj->setDsTipoConselho( $row['DS_TIPO_CONSELHO'] );
                $objList->addTipo_conselho( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

    public function getTipo_conselho( $tipo_conselho ){
        require_once "class.connection_factory.php";
        require_once "../model/class.tipo_conselho.php";
        $obj = null;
        $this->connection = new connection();

        try{

            $sql = "SELECT * FROM tipo_conselho WHERE CD_TIPO_CONSELHO = :CD_TIPO_CONSELHO";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_TIPO_CONSELHO", $tipo_conselho, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new tipo_conselho();
                $obj->setCdTipoConselho( $row['CD_TIPO_CONSELHO'] );
                $obj->setDsTipoConselho( $row['DS_TIPO_CONSELHO'] );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $obj;
    }



}