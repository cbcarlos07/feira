-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema feira
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema feira
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `feira` DEFAULT CHARACTER SET latin1 ;
USE `feira` ;

-- -----------------------------------------------------
-- Table `feira`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`usuario` ;

CREATE TABLE IF NOT EXISTS `feira`.`usuario` (
  `CD_USUARIO` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `NM_USUARIO` VARCHAR(100) NULL,
  `DS_LOGIN` VARCHAR(45) NULL,
  `DS_SENHA` VARCHAR(100) NULL,
  `SN_ATIVO` CHAR(1) NULL,
  `SN_SENHA_ATUAL` CHAR(1) NULL,
  PRIMARY KEY (`CD_USUARIO`),
  UNIQUE INDEX `DS_LOGIN_UNIQUE` (`DS_LOGIN` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `feira`.`especialidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`especialidade` ;

CREATE TABLE IF NOT EXISTS `feira`.`especialidade` (
  `CD_ESPECIALIDADE` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `DS_ESPECIALIDADE` VARCHAR(45) NULL,
  PRIMARY KEY (`CD_ESPECIALIDADE`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `feira`.`gera_senha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`gera_senha` ;

CREATE TABLE IF NOT EXISTS `feira`.`gera_senha` (
  `CD_SENHA` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `DS_SENHA` VARCHAR(45) NULL,
  PRIMARY KEY (`CD_SENHA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `feira`.`paciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`paciente` ;

CREATE TABLE IF NOT EXISTS `feira`.`paciente` (
  `CD_PACIENTE` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `NM_PACIENTE` VARCHAR(100) NULL,
  `NR_CEP` VARCHAR(8) NULL,
  `NR_CASA` VARCHAR(5) NULL,
  `DS_COMPLEMENTO` VARCHAR(45) NULL,
  `DT_NASCIMENTO` DATE NULL,
  PRIMARY KEY (`CD_PACIENTE`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `feira`.`prestador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`prestador` ;

CREATE TABLE IF NOT EXISTS `feira`.`prestador` (
  `CD_PRESTADOR` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `NM_PRESTADOR` VARCHAR(100) NULL,
  `CD_ESPECIALIDADE` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`CD_PRESTADOR`),
  INDEX `fk_prestador_especialidade_idx` (`CD_ESPECIALIDADE` ASC),
  CONSTRAINT `fk_prestador_especialidade`
    FOREIGN KEY (`CD_ESPECIALIDADE`)
    REFERENCES `feira`.`especialidade` (`CD_ESPECIALIDADE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `feira`.`telefone_paciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`telefone_paciente` ;

CREATE TABLE IF NOT EXISTS `feira`.`telefone_paciente` (
  `CD_PACIENTE` INT UNSIGNED NOT NULL,
  `NR_TELEFONE` VARCHAR(15) NULL,
  `TP_TELEFONE` CHAR(1) NULL,
  `OBS_TELEFONE` VARCHAR(45) NULL,
  INDEX `fk_telefone_paciente_paciente1_idx` (`CD_PACIENTE` ASC),
  CONSTRAINT `fk_telefone_paciente_paciente1`
    FOREIGN KEY (`CD_PACIENTE`)
    REFERENCES `feira`.`paciente` (`CD_PACIENTE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `feira`.`tipo_conselho`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`tipo_conselho` ;

CREATE TABLE IF NOT EXISTS `feira`.`tipo_conselho` (
  `CD_TIPO_CONSELHO` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `DS_TIPO_CONSELHO` VARCHAR(45) NULL,
  PRIMARY KEY (`CD_TIPO_CONSELHO`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5;


-- -----------------------------------------------------
-- Table `feira`.`atendimento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `feira`.`atendimento` ;

CREATE TABLE IF NOT EXISTS `feira`.`atendimento` (
  `CD_ATENDIMENTO` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `CD_PACIENTE` INT UNSIGNED NOT NULL,
  `CD_ESPECIALIDADE` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`CD_ATENDIMENTO`),
  INDEX `fk_atendimento_especialidade1_idx` (`CD_ESPECIALIDADE` ASC),
  INDEX `fk_atendimento_paciente1_idx` (`CD_PACIENTE` ASC),
  CONSTRAINT `fk_atendimento_especialidade1`
    FOREIGN KEY (`CD_ESPECIALIDADE`)
    REFERENCES `feira`.`especialidade` (`CD_ESPECIALIDADE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_atendimento_paciente1`
    FOREIGN KEY (`CD_PACIENTE`)
    REFERENCES `feira`.`paciente` (`CD_PACIENTE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `feira` ;

-- -----------------------------------------------------
-- Placeholder table for view `feira`.`v_atendimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `feira`.`v_atendimentos` (`CD_ATENDIMENTO` INT, `CD_PACIENTE` INT, `NM_PACIENTE` INT, `CD_ESPECIALIDADE` INT, `DS_ESPECIALIDADE` INT);

-- -----------------------------------------------------
-- Placeholder table for view `feira`.`v_especialidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `feira`.`v_especialidade` (`DS_ESPECIALIDADE` INT, `COUNT(*)` INT);

-- -----------------------------------------------------
-- View `feira`.`v_atendimentos`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `feira`.`v_atendimentos` ;
DROP TABLE IF EXISTS `feira`.`v_atendimentos`;
USE `feira`;
CREATE  OR REPLACE VIEW `feira`.`v_atendimentos` AS
SELECT A.CD_ATENDIMENTO
	  ,A.CD_PACIENTE
	  ,P.NM_PACIENTE
      ,A.CD_ESPECIALIDADE
	  ,E.DS_ESPECIALIDADE	
  FROM atendimento   A
  JOIN especialidade E
  JOIN paciente      P
 WHERE A.CD_ESPECIALIDADE = E.CD_ESPECIALIDADE
   AND A.CD_PACIENTE = P.CD_PACIENTE	
 ORDER BY 3 ;

-- -----------------------------------------------------
-- View `feira`.`v_especialidade`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `feira`.`v_especialidade` ;
DROP TABLE IF EXISTS `feira`.`v_especialidade`;
USE `feira`;
CREATE  OR REPLACE VIEW `feira`.`v_especialidade` AS
SELECT E.DS_ESPECIALIDADE
	   ,COUNT(*)	
  FROM atendimento   A
  JOIN especialidade E   
WHERE A.CD_ESPECIALIDADE = E.CD_ESPECIALIDADE
GROUP BY A.CD_ESPECIALIDADE;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `feira`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `feira`;
INSERT INTO `feira`.`usuario` (`CD_USUARIO`, `NM_USUARIO`, `DS_LOGIN`, `DS_SENHA`, `SN_ATIVO`, `SN_SENHA_ATUAL`) VALUES (NULL, 'Administrador', 'admin', '25d55ad283aa400af464c76d713c07ad', 'S', 'S');

COMMIT;

