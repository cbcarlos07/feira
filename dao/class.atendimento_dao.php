<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:20
 */
class atendimento_dao
{
   private $connection;
   public function insert ( atendimento $atendimento ){

       require_once "class.connection_factory.php";
       $teste = false;
       $this->connection = new connection();
       $this->connection->beginTransaction();
       try{

           $sql = "INSERT INTO atendimento 
                  (CD_ATENDIMENTO, CD_ESPECIALIDADE, CD_PACIENTE)  
                  VALUES
                  ( NULL, :CD_ESPECIALIDADE, :CD_PACIENTE )";
           $stmt = $this->connection->prepare( $sql );
           $stmt->bindValue( ":CD_ESPECIALIDADE", $atendimento->getEspecialidade()->getCdEspecialidade(), PDO::PARAM_INT );
           $stmt->bindValue( ":CD_PACIENTE", $atendimento->getPaciente()->getCdPaciente(), PDO::PARAM_INT );
           $stmt->execute();
           $this->connection->commit();
           $teste = true;
           $this->connection = null;


       }catch ( PDOException $exception ){
           Echo "Erro: ".$exception->getMessage();
       }
       return $teste;
   }

    public function update ( atendimento $atendimento ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE atendimento SET
                      CD_ESPECIALIDADE = :CD_ESPECIALIDADE
                     ,CD_PACIENTE = :CD_PACIENTE
                    WHERE CD_ATENDIMENTO = :CD_ATENDIMENTO";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":CD_ESPECIALIDADE", $atendimento->getEspecialidade()->getCdEspecialidade(), PDO::PARAM_INT );
            $stmt->bindValue( ":CD_PACIENTE", $atendimento->getPaciente()->getCdPaciente(), PDO::PARAM_INT );
            $stmt->bindValue( ":CD_ATENDIMENTO", $atendimento->getCdAtendimento(), PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    

    public function delete ( $atendimento ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "DELETE FROM atendimento WHERE CD_ATENDIMENTO = :CD_ATENDIMENTO";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_ATENDIMENTO", $atendimento, PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function listaAtendimento( $atendimento ){
        require_once "class.connection_factory.php";
        require_once "../model/class.atendimento.php";
        require_once "../model/class.paciente.php";
        require_once "../model/class.especialidade.php";
        require_once "../services/class.atendimentoList.php";

        $this->connection = new connection();
        $objList = new atendimentoList();
        try{

            $sql = "SELECT  A.*
                           ,P.NM_PACIENTE
                           ,E.DS_ESPECIALIDADE 
                      FROM atendimento A
                      JOIN especialidade E
                      JOIN paciente      P
                     WHERE P.NM_PACIENTE LIKE :atendimento
                       AND P.CD_PACIENTE = A.CD_PACIENTE
                       AND E.CD_ESPECIALIDADE = A.CD_ESPECIALIDADE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":atendimento", $atendimento, PDO::PARAM_STR );
            $stmt->execute();
            while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){
                $obj = new atendimento();
                $obj->setCdAtendimento( $row['CD_ATENDIMENTO'] );
                $obj->setPaciente( new paciente() );
                $obj->getPaciente()->setCdPaciente( $row['CD_PACIENTE'] );
                $obj->getPaciente()->setNmPaciente( $row['NM_PACIENTE'] );
                $obj->setEspecialidade( new especialidade() );
                $obj->getEspecialidade()->setCdEspecialidade( $row['CD_ESPECIALIDADE'] );
                $obj->getEspecialidade()->setDsEspecialidade( $row['DS_ESPECIALIDADE'] );
                $objList->addAtendimento( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

    public function getAtendimento( $atendimento ){
        require_once "class.connection_factory.php";
        require_once "../model/class.atendimento.php";
        $obj = null;
        $this->connection = new connection();

        try{

            $sql = "SELECT * FROM atendimento WHERE CD_ESPECIALIDADE = :CD_ESPECIALIDADE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_ESPECIALIDADE", $atendimento, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new atendimento();
                $obj->setCdAtendimento( $row['CD_ATENDIMENTO'] );
                $obj->setPaciente( new paciente() );
                $obj->getPaciente()->setCdPaciente( $row['CD_PACIENTE'] );
                $obj->getPaciente()->setNmPaciente( $row['NM_PACIENTE'] );
                $obj->setEspecialidade( new especialidade() );
                $obj->getEspecialidade()->setCdEspecialidade( $row['CD_ESPECIALIDADE'] );
                $obj->getEspecialidade()->setDsEspecialidade( $row['DS_ESPECIALIDADE'] );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $obj;
    }

 

}