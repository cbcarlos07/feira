<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/08/17
 * Time: 21:20
 */
class especialidade_dao
{
   private $connection;
   public function insert ( especialidade $especialidade ){

       require_once "class.connection_factory.php";
       $teste = false;
       $this->connection = new connection();
       $this->connection->beginTransaction();
       try{

           $sql = "INSERT INTO especialidade 
                  (CD_ESPECIALIDADE, DS_ESPECIALIDADE)  
                  VALUES
                  ( NULL, :DS_ESPECIALIDADE )";
           $stmt = $this->connection->prepare( $sql );
           $stmt->bindValue( ":DS_ESPECIALIDADE", $especialidade->getDsEspecialidade(), PDO::PARAM_STR );
           $stmt->execute();
           $this->connection->commit();
           $teste = true;
           $this->connection = null;


       }catch ( PDOException $exception ){
           Echo "Erro: ".$exception->getMessage();
       }
       return $teste;
   }

    public function update ( especialidade $especialidade ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "UPDATE especialidade SET
                     DS_ESPECIALIDADE = :DS_ESPECIALIDADE
                    WHERE CD_ESPECIALIDADE = :CD_ESPECIALIDADE";
            $stmt = $this->connection->prepare( $sql );
            $stmt->bindValue( ":DS_ESPECIALIDADE", $especialidade->getDsEspecialidade(), PDO::PARAM_STR );
            $stmt->bindValue( ":CD_ESPECIALIDADE", $especialidade->getCdEspecialidade(), PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    

    public function delete ( $especialidade ){

        require_once "class.connection_factory.php";
        $teste = false;
        $this->connection = new connection();
        $this->connection->beginTransaction();
        try{

            $sql = "DELETE FROM especialidade WHERE CD_ESPECIALIDADE = :CD_ESPECIALIDADE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_ESPECIALIDADE", $especialidade, PDO::PARAM_INT );
            $stmt->execute();
            $this->connection->commit();
            $teste = true;
            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function listaEspecialidade( $especialidade ){
        require_once "class.connection_factory.php";
        require_once "../model/class.especialidade.php";
        require_once "../services/class.especialidadeList.php";

        $this->connection = new connection();
        $objList = new especialidadeList();
        try{

            $sql = "SELECT * FROM especialidade WHERE DS_ESPECIALIDADE LIKE :USUARIO";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":USUARIO", $especialidade, PDO::PARAM_STR );
            $stmt->execute();
            while ($row = $stmt->fetch( PDO::FETCH_ASSOC )){
                $obj = new especialidade();
                $obj->setCdEspecialidade( $row['CD_ESPECIALIDADE'] );
                $obj->setDsEspecialidade( $row['DS_ESPECIALIDADE'] );
                $objList->addEspecialidade( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

    public function getEspecialidade( $especialidade ){
        require_once "class.connection_factory.php";
        require_once "../model/class.especialidade.php";
        $obj = null;
        $this->connection = new connection();

        try{

            $sql = "SELECT * FROM especialidade WHERE CD_ESPECIALIDADE = :CD_ESPECIALIDADE";
            $stmt = $this->connection->prepare( $sql );

            $stmt->bindValue( ":CD_ESPECIALIDADE", $especialidade, PDO::PARAM_INT );
            $stmt->execute();
            if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new especialidade();
                $obj->setCdEspecialidade( $row['CD_ESPECIALIDADE'] );
                $obj->setDsEspecialidade( $row['DS_ESPECIALIDADE'] );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $obj;
    }

    public function getTotais(  ){
        require_once "class.connection_factory.php";
        require_once "../model/class.especialidade.php";
        require_once "../services/class.especialidadeList.php";
        $obj = null;
        $this->connection = new connection();
        $objList = new especialidadeList();
        try{

            $sql = "SELECT * FROM v_especialidade";
            $stmt = $this->connection->prepare( $sql );

            $stmt->execute();
            while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){
                $obj = new especialidade();
                $obj->setCdEspecialidade( $row['TOTAL'] );
                $obj->setDsEspecialidade( $row['DS_ESPECIALIDADE'] );
               // echo "Especialidade: ".$row['DS_ESPECIALIDADE'].' Total '.$row['TOTAL'].'\n';

                $objList->addEspecialidade( $obj );
            }


            $this->connection = null;


        }catch ( PDOException $exception ){
            Echo "Erro: ".$exception->getMessage();
        }
        return $objList;
    }

 

}