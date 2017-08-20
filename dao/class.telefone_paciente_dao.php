<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:20
 */
class telefone_paciente_dao
{
   private $connection;
   public function insert ( telefone_paciente $telefone_paciente ){

       require_once "class.connection_factory.php";
       $teste = false;
       $this->connection = new connection();
       $this->connection->beginTransaction();
       try{

           $sql = "INSERT INTO telefone_paciente 
                  (CD_PACIENTE, NR_TELEFONE, TP_TELEFONE, OBS_TELEFONE)  
                  VALUES
                  ( :CD_PACIENTE, :NR_TELEFONE, :TP_TELEFONE, :OBS_TELEFONE )";
           $stmt = $this->connection->prepare( $sql );
           $stmt->bindValue( ":CD_PACIENTE", $telefone_paciente->getPaciente(), PDO::PARAM_INT );
           $stmt->bindValue( ":NR_TELEFONE", $telefone_paciente->getNrTelefone(), PDO::PARAM_STR );
           $stmt->bindValue( ":TP_TELEFONE", $telefone_paciente->getTpTelefone(), PDO::PARAM_STR );
           $stmt->bindValue( ":OBS_TELEFONE", $telefone_paciente->getObsTelefone(), PDO::PARAM_STR );
           $stmt->execute();
           $this->connection->commit();
           $teste = true;
           $this->connection = null;


       }catch ( PDOException $exception ){
           Echo "Erro: ".$exception->getMessage();
       }
       return $teste;
   }

    public function update ( telefone_paciente $telefone_paciente ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE telefone_paciente SET
                       NR_TELEFONE  = :NR_TELEFONE 
                      ,TP_TELEFONE  = :TP_TELEFONE
                      ,OBS_TELEFONE = :OBS_TELEFONE
                    WHERE CD_PACIENTE = :CD_PACIENTE";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":CD_PACIENTE", $telefone_paciente->getPaciente(), PDO::PARAM_INT );
            $stmt->bindValue( ":NR_TELEFONE", $telefone_paciente->getNrTelefone(), PDO::PARAM_STR );
            $stmt->bindValue( ":TP_TELEFONE", $telefone_paciente->getTpTelefone(), PDO::PARAM_STR );
            $stmt->bindValue( ":OBS_TELEFONE", $telefone_paciente->getObsTelefone(), PDO::PARAM_STR );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    

    public function delete ( $telefone_paciente ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "DELETE FROM telefone_paciente WHERE CD_PACIENTE = :CD_PACIENTE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_PACIENTE", $telefone_paciente, PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function listaTelefone_paciente( $telefone_paciente ){
        require_once "class.connection_factory.php";
        require_once "../model/class.telefone_paciente.php";
        require_once "../services/class.telefone_pacienteList.php";

        $this->connection = new connection();
        $objList = new telefone_pacienteList();
        try{

            $sql = "SELECT * FROM telefone_paciente WHERE CD_PACIENTE = :PACIENTE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":PACIENTE", $telefone_paciente, PDO::PARAM_STR );
            $stmt->execute();
            while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){
                $obj = new telefone_paciente();
                $obj->setPaciente( $row['CD_PACIENTE'] );
                $obj->setNrTelefone( $row['NR_TELEFONE'] );
                $obj->setTpTelefone( $row['TP_TELEFONE'] );
                $obj->setObsTelefone( $row['OBS_TELEFONE'] );

                $objList->addTelefone_paciente( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

    public function getTelefone_paciente( $telefone_paciente ){
        require_once "class.connection_factory.php";
        require_once "../model/class.telefone_paciente.php";
        $obj = null;
        $this->connection = new connection();

        try{

            $sql = "SELECT * FROM telefone_paciente WHERE CD_PACIENTE = :CD_PACIENTE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_PACIENTE", $telefone_paciente, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new telefone_paciente();
                $obj->setPaciente( $row['CD_PACIENTE'] );
                $obj->setNrTelefone( $row['NR_TELEFONE'] );
                $obj->setTpTelefone( $row['TP_TELEFONE'] );
                $obj->setObsTelefone( $row['OBS_TELEFONE'] );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $obj;
    }

 

}