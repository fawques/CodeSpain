SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `codespain` ;
CREATE SCHEMA IF NOT EXISTS `codespain` DEFAULT CHARACTER SET latin1 ;
USE `codespain` ;

-- -----------------------------------------------------
-- Table `codespain`.`Eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Eventos` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Eventos` (
  `idEventos` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(50) NULL DEFAULT NULL ,
  `Descripcion` VARCHAR(150) NULL DEFAULT NULL ,
  `Lugar` VARCHAR(45) NULL DEFAULT NULL ,
  `Fecha` DATE NULL DEFAULT NULL ,
  `CoordX` DOUBLE NULL DEFAULT NULL ,
  `CoordY` DOUBLE NULL DEFAULT NULL ,
  PRIMARY KEY (`idEventos`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `codespain`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Usuarios` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Usuarios` (
  `idUsuarios` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(50) NOT NULL ,
  `Token` VARCHAR(250) NULL DEFAULT NULL ,
  `Preferencias_idPreferencias` INT(11) NULL DEFAULT NULL ,
  `Eventos_idEventos` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idUsuarios`) ,
  UNIQUE INDEX `Nombre_UNIQUE` (`Nombre` ASC) ,
  INDEX `fk_Usuarios_Preferencias1_idx` (`Preferencias_idPreferencias` ASC) ,
  INDEX `fk_Usuarios_Eventos1_idx` (`Eventos_idEventos` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `codespain`.`Asistir`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Asistir` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Asistir` (
  `Usuarios_idUsuarios` INT(11) NOT NULL ,
  `Eventos_idEventos` INT(11) NOT NULL ,
  PRIMARY KEY (`Usuarios_idUsuarios`, `Eventos_idEventos`) ,
  INDEX `fk_Usuarios_has_Eventos_Eventos1_idx` (`Eventos_idEventos` ASC) ,
  INDEX `fk_Usuarios_has_Eventos_Usuarios1_idx` (`Usuarios_idUsuarios` ASC) ,
  CONSTRAINT `fk_Usuarios_has_Eventos_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_Eventos_Usuarios1`
    FOREIGN KEY (`Usuarios_idUsuarios` )
    REFERENCES `codespain`.`Usuarios` (`idUsuarios` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `codespain`.`Oficiales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Oficiales` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Oficiales` (
  `Eventos_idEventos` INT(11) NOT NULL ,
  PRIMARY KEY (`Eventos_idEventos`) ,
  CONSTRAINT `fk_Oficiales_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `codespain`.`Preferencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Preferencias` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Preferencias` (
  `idPreferencias` INT(11) NOT NULL ,
  `Zona` VARCHAR(45) NULL DEFAULT NULL ,
  `Usuarios_idUsuarios` INT(11) NOT NULL ,
  PRIMARY KEY (`idPreferencias`, `Usuarios_idUsuarios`) ,
  INDEX `fk_Preferencias_Usuarios1_idx` (`Usuarios_idUsuarios` ASC) ,
  CONSTRAINT `fk_Preferencias_Usuarios1`
    FOREIGN KEY (`Usuarios_idUsuarios` )
    REFERENCES `codespain`.`Usuarios` (`idUsuarios` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `codespain`.`Reportar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Reportar` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Reportar` (
  `Usuarios_idUsuarios` INT(11) NOT NULL ,
  `Eventos_idEventos` INT(11) NOT NULL ,
  PRIMARY KEY (`Usuarios_idUsuarios`, `Eventos_idEventos`) ,
  INDEX `fk_Usuarios_has_Eventos1_Eventos1_idx` (`Eventos_idEventos` ASC) ,
  INDEX `fk_Usuarios_has_Eventos1_Usuarios1_idx` (`Usuarios_idUsuarios` ASC) ,
  CONSTRAINT `fk_Usuarios_has_Eventos1_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_Eventos1_Usuarios1`
    FOREIGN KEY (`Usuarios_idUsuarios` )
    REFERENCES `codespain`.`Usuarios` (`idUsuarios` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `codespain`.`Tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Tag` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Tag` (
  `Etiqueta` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Etiqueta' ,
  PRIMARY KEY (`Etiqueta`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `codespain`.`Eventos_has_Tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codespain`.`Eventos_has_Tag` ;

CREATE  TABLE IF NOT EXISTS `codespain`.`Eventos_has_Tag` (
  `Eventos_idEventos` INT(11) NOT NULL ,
  `Tag_Etiqueta` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL ,
  PRIMARY KEY (`Eventos_idEventos`, `Tag_Etiqueta`) ,
  INDEX `fk_Eventos_has_Tag_Tag1_idx` (`Tag_Etiqueta` ASC) ,
  INDEX `fk_Eventos_has_Tag_Eventos1_idx` (`Eventos_idEventos` ASC) ,
  CONSTRAINT `fk_Eventos_has_Tag_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Eventos_has_Tag_Tag1`
    FOREIGN KEY (`Tag_Etiqueta` )
    REFERENCES `codespain`.`Tag` (`Etiqueta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `codespain` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
