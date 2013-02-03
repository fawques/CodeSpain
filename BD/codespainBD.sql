SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `codespain` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `codespain` ;

-- -----------------------------------------------------
-- Table `codespain`.`Preferencias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `codespain`.`Preferencias` (
  `idPreferencias` INT NOT NULL ,
  `Zona` VARCHAR(45) NULL ,
  PRIMARY KEY (`idPreferencias`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `codespain`.`Eventos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `codespain`.`Eventos` (
  `idEventos` INT NOT NULL ,
  `Nombre` VARCHAR(50) NULL ,
  `Descripcion` VARCHAR(150) NULL ,
  `Lugar` VARCHAR(45) NULL ,
  `Fecha` DATE NULL ,
  PRIMARY KEY (`idEventos`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `codespain`.`Usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `codespain`.`Usuarios` (
  `idUsuarios` INT NOT NULL ,
  `Nombre` VARCHAR(50) NULL ,
  `Token` VARCHAR(45) NULL ,
  `Preferencias_idPreferencias` INT NOT NULL ,
  `Eventos_idEventos` INT NOT NULL ,
  PRIMARY KEY (`idUsuarios`) ,
  INDEX `fk_Usuarios_Preferencias1_idx` (`Preferencias_idPreferencias` ASC) ,
  INDEX `fk_Usuarios_Eventos1_idx` (`Eventos_idEventos` ASC) ,
  CONSTRAINT `fk_Usuarios_Preferencias1`
    FOREIGN KEY (`Preferencias_idPreferencias` )
    REFERENCES `codespain`.`Preferencias` (`idPreferencias` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5
COLLATE = big5_chinese_ci;


-- -----------------------------------------------------
-- Table `codespain`.`Oficiales`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `codespain`.`Oficiales` (
  `Eventos_idEventos` INT NOT NULL ,
  PRIMARY KEY (`Eventos_idEventos`) ,
  CONSTRAINT `fk_Oficiales_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `codespain`.`Asistir`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `codespain`.`Asistir` (
  `Usuarios_idUsuarios` INT NOT NULL ,
  `Eventos_idEventos` INT NOT NULL ,
  PRIMARY KEY (`Usuarios_idUsuarios`, `Eventos_idEventos`) ,
  INDEX `fk_Usuarios_has_Eventos_Eventos1_idx` (`Eventos_idEventos` ASC) ,
  INDEX `fk_Usuarios_has_Eventos_Usuarios1_idx` (`Usuarios_idUsuarios` ASC) ,
  CONSTRAINT `fk_Usuarios_has_Eventos_Usuarios1`
    FOREIGN KEY (`Usuarios_idUsuarios` )
    REFERENCES `codespain`.`Usuarios` (`idUsuarios` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_Eventos_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5
COLLATE = big5_chinese_ci;


-- -----------------------------------------------------
-- Table `codespain`.`Reportar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `codespain`.`Reportar` (
  `Usuarios_idUsuarios` INT NOT NULL ,
  `Eventos_idEventos` INT NOT NULL ,
  PRIMARY KEY (`Usuarios_idUsuarios`, `Eventos_idEventos`) ,
  INDEX `fk_Usuarios_has_Eventos1_Eventos1_idx` (`Eventos_idEventos` ASC) ,
  INDEX `fk_Usuarios_has_Eventos1_Usuarios1_idx` (`Usuarios_idUsuarios` ASC) ,
  CONSTRAINT `fk_Usuarios_has_Eventos1_Usuarios1`
    FOREIGN KEY (`Usuarios_idUsuarios` )
    REFERENCES `codespain`.`Usuarios` (`idUsuarios` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuarios_has_Eventos1_Eventos1`
    FOREIGN KEY (`Eventos_idEventos` )
    REFERENCES `codespain`.`Eventos` (`idEventos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5
COLLATE = big5_chinese_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
