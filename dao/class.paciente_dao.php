<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:20
 */
class paciente_dao
{
   private $connection;
   public function insert ( paciente $paciente ){

       require_once "class.connection_factory.php";
       $teste = 0;
       $this->connection = new connection();
       $this->connection->beginTransaction();
       try{

           $sql = "INSERT INTO paciente 
                  (CD_PACIENTE, NM_PACIENTE, NR_CEP, NR_CASA, DS_COMPLEMENTO, DT_NASCIMENTO)  
                  VALUES
                  ( NULL, :NM_PACIENTE, :NR_CEP, :NR_CASA, :DS_COMPLEMENTO, :DT_NASCIMENTO )";
           $stmt = $this->connection->prepare( $sql );
           $stmt->bindValue( ":NM_PACIENTE", $paciente->getNmPaciente(), PDO::PARAM_STR );
           $stmt->bindValue( ":NR_CEP", $paciente->getNrCep(), PDO::PARAM_STR );
           $stmt->bindValue( ":NR_CASA", $paciente->getNrCasa(), PDO::PARAM_STR );
           $stmt->bindValue( ":DS_COMPLEMENTO", $paciente->getDsComplemento(), PDO::PARAM_STR );
           $stmt->bindValue( ":DT_NASCIMENTO", $paciente->getDtNascimento(), PDO::PARAM_STR );
           $stmt->execute();
           $teste = $this->connection->lastInsertId();
           $this->connection->commit();

           $this->connection = null;


       }catch ( PDOException $exception ){
           Echo "Erro: ".$exception->getMessage();
       }
       return $teste;
   }

    public function update ( paciente $paciente ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE paciente SET
                       NM_PACIENTE = :NM_PACIENTE 
                      ,NR_CEP      = :NR_CEP
                      ,NR_CASA     = :NR_CASA
                      ,DS_COMPLEMENTO = :DS_COMPLEMENTO
                      ,DT_NASCIMENTO  = :DT_NASCIMENTO
                    WHERE CD_PACIENTE = :CD_PACIENTE";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":NM_PACIENTE", $paciente->getNmPaciente(), PDO::PARAM_STR );
            $stmt->bindValue( ":NR_CEP", $paciente->getNrCep(), PDO::PARAM_STR );
            $stmt->bindValue( ":NR_CASA", $paciente->getNrCasa(), PDO::PARAM_STR );
            $stmt->bindValue( ":DS_COMPLEMENTO", $paciente->getDsComplemento(), PDO::PARAM_STR );
            $stmt->bindValue( ":CD_PACIENTE", $paciente->getCdPaciente(), PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    

    public function delete ( $paciente ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "DELETE FROM paciente WHERE CD_PACIENTE = :CD_PACIENTE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_PACIENTE", $paciente, PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function listaPaciente( $paciente ){
        require_once "class.connection_factory.php";
        require_once "../model/class.paciente.php";
        require_once "../services/class.pacienteList.php";

        $this->connection = new connection();
        $objList = new pacienteList();
        try{

            $sql = "SELECT * FROM paciente WHERE NM_PACIENTE LIKE :PACIENTE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":PACIENTE", $paciente, PDO::PARAM_STR );
            $stmt->execute();
            while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){
                $obj = new paciente();
                $obj->setCdPaciente( $row['CD_PACIENTE'] );
                $obj->setNmPaciente( $row['NM_PACIENTE'] );
                $obj->setNrCep( $row['NR_CEP'] );
                $obj->setNrCasa( $row['NR_CASA'] );
                $obj->setDsComplemento( $row['DS_COMPLEMENTO'] );
                $objList->addPaciente( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

    public function getPaciente( $paciente ){
        require_once "class.connection_factory.php";
        require_once "../model/class.paciente.php";
        $obj = null;
        $this->connection = new connection();

        try{

            $sql = "SELECT * FROM paciente WHERE CD_PACIENTE = :CD_PACIENTE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_PACIENTE", $paciente, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new paciente();
                $obj->setCdPaciente( $row['CD_PACIENTE'] );
                $obj->setNmPaciente( $row['NM_PACIENTE'] );
                $obj->setNrCep( $row['NR_CEP'] );
                $obj->setNrCasa( $row['NR_CASA'] );
                $obj->setDsComplemento( $row['DS_COMPLEMENTO'] );
                $obj->setDtNascimento( $row['DT_NASCIMENTO'] );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $obj;
    }

 

}