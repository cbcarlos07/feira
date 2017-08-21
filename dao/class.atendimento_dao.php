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
                    WHERE CD_ATENDIMENTO = :CD_ATENDIMENTO";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":CD_ESPECIALIDADE", $atendimento->getEspecialidade()->getCdEspecialidade(), PDO::PARAM_INT );
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

    public function updatePaciente ( atendimento $atendimento ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE atendimento SET
                      CD_ESPECIALIDADE = :CD_ESPECIALIDADE
                    WHERE CD_PACIENTE = :CD_PACIENTE";
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

            $sql = "SELECT * FROM v_atendimentos A WHERE A.CD_ESPECIALIDADE = :atendimento ";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":atendimento", $atendimento, PDO::PARAM_INT );
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

    public function getPacAtd( $atendimento ){
        require_once "class.connection_factory.php";
        require_once "../model/class.atendimento.php";
        $obj = 0;
        $this->connection = new connection();

        try{

            $sql = "SELECT * FROM atendimento WHERE CD_PACIENTE = :CD_PACIENTE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_PACIENTE", $atendimento, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = 1;
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $obj;
    }

 

}