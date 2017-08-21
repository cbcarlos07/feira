<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:20
 */
class prestador_dao
{
   private $connection;
   public function insert ( prestador $prestador ){

       require_once "class.connection_factory.php";
       $teste = false;
       $this->connection = new connection();
       $this->connection->beginTransaction();

       try{

           $sql = "INSERT INTO prestador 
                  (CD_PRESTADOR, NM_PRESTADOR, CD_ESPECIALIDADE)  
                  VALUES
                  ( NULL, :NM_PRESTADOR,  :CD_ESPECIALIDADE )";
           $stmt = $this->connection->prepare( $sql );
           $stmt->bindValue( ":NM_PRESTADOR", $prestador->getNmPrestador(), PDO::PARAM_STR );
           $stmt->bindValue( ":CD_ESPECIALIDADE", $prestador->getEspecialidade()->getCdEspecialidade(), PDO::PARAM_INT );
           $stmt->execute();
           $this->connection->commit();
           $teste = true;
           $this->connection = null;


       }catch ( PDOException $exception ){
           Echo "Erro: ".$exception->getMessage();
       }
       return $teste;
   }

    public function update ( prestador $prestador ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE prestador SET
                       NM_PRESTADOR = :NM_PRESTADOR
                      ,CD_ESPECIALIDADE = :CD_ESPECIALIDADE
                    WHERE CD_PRESTADOR = :CD_PRESTADOR";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":NM_PRESTADOR", $prestador->getNmPrestador(), PDO::PARAM_STR );
            $stmt->bindValue( ":CD_ESPECIALIDADE", $prestador->getEspecialidade()->getCdEspecialidade(), PDO::PARAM_INT );
            $stmt->bindValue( ":CD_PRESTADOR", $prestador->getCdPrestador(), PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    

    public function delete ( $prestador ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "DELETE FROM prestador WHERE CD_PRESTADOR = :CD_PRESTADOR";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_PRESTADOR", $prestador, PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function listaPrestador( $prestador ){
        require_once "class.connection_factory.php";
        require_once "../model/class.prestador.php";
        require_once "../model/class.especialidade.php";
        require_once "../model/class.tipo_conselho.php";
        require_once "../services/class.prestadorList.php";

        $this->connection = new connection();
        $objList = new prestadorList();
        try{

            $sql = "SELECT P.*, E.DS_ESPECIALIDADE
                      FROM prestador P
                      JOIN especialidade E 
                  WHERE P.NM_PRESTADOR LIKE :PACIENTE
                    AND P.CD_ESPECIALIDADE = E.CD_ESPECIALIDADE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":PACIENTE", $prestador, PDO::PARAM_STR );
            $stmt->execute();
            while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){
                $obj = new prestador();
                $obj->setCdPrestador( $row['CD_PRESTADOR'] );
                $obj->setNmPrestador( $row['NM_PRESTADOR'] );
                $obj->setEspecialidade( new especialidade() );
                $obj->getEspecialidade()->setCdEspecialidade( $row['CD_ESPECIALIDADE'] );
                $obj->getEspecialidade()->setDsEspecialidade( $row['DS_ESPECIALIDADE'] );
                $objList->addPrestador( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

    public function getPrestador( $prestador ){
        require_once "class.connection_factory.php";
        require_once "../model/class.prestador.php";
        require_once "../model/class.especialidade.php";
        require_once "../model/class.tipo_conselho.php";
        $obj = null;
        $this->connection = new connection();

        try{

            $sql = "SELECT P.*, E.DS_ESPECIALIDADE FROM prestador P
                    JOIN especialidade E
                    WHERE P.CD_PRESTADOR = :CD_PRESTADOR
                      AND E.CD_ESPECIALIDADE = P.CD_ESPECIALIDADE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_PRESTADOR", $prestador, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new prestador();
                $obj->setCdPrestador( $row['CD_PRESTADOR'] );
                $obj->setNmPrestador( $row['NM_PRESTADOR'] );
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