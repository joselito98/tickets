-- MySQL Script generated by MySQL Workbench
-- 01/22/18 09:58:27
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bd_tickets
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_tickets
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_tickets` DEFAULT CHARACTER SET latin1 ;
USE `bd_tickets` ;

-- -----------------------------------------------------
-- Table `bd_tickets`.`entity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`entity` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`entity` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`guardianship_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`guardianship_status` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`guardianship_status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`guardianship_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`guardianship_type` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`guardianship_type` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`user` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NULL DEFAULT NULL,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(60) NULL DEFAULT NULL,
  `role` VARCHAR(45) NULL DEFAULT 'user',
  `profile_pic` VARCHAR(250) NULL DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT '1',
  `kind` INT(11) NOT NULL DEFAULT '1',
  `created_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`guardianship`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`guardianship` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`guardianship` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` INT(11) NULL DEFAULT NULL,
  `authorization` INT(11) NULL DEFAULT NULL,
  `formula` INT(11) NULL DEFAULT NULL,
  `history` INT(11) NULL DEFAULT NULL,
  `document` INT(11) NULL DEFAULT NULL,
  `authorization_date` DATE NULL DEFAULT NULL,
  `document_number` INT(11) NULL DEFAULT NULL,
  `entity` INT(11) NULL DEFAULT NULL,
  `observations` VARCHAR(200) NULL DEFAULT NULL,
  `status` INT(11) NULL DEFAULT NULL,
  `user` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_guardianshipstatus_id_idx` (`type` ASC),
  INDEX `fk_entity_id_idx` (`entity` ASC),
  INDEX `fk_guardianshipstatus_id_idx1` (`status` ASC),
  INDEX `fk_user_id_idx` (`user` ASC),
  CONSTRAINT `fk_entity_id`
    FOREIGN KEY (`entity`)
    REFERENCES `bd_tickets`.`entity` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_guardianshipstatus_id`
    FOREIGN KEY (`status`)
    REFERENCES `bd_tickets`.`guardianship_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_guardianshiptype_id`
    FOREIGN KEY (`type`)
    REFERENCES `bd_tickets`.`guardianship_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user`)
    REFERENCES `bd_tickets`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`authorization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`authorization` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`authorization` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `number` INT(11) NULL DEFAULT NULL,
  `guardianships_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_guardianship_id_idx` (`guardianships_id` ASC),
  CONSTRAINT `fk_guardianship_id`
    FOREIGN KEY (`guardianships_id`)
    REFERENCES `bd_tickets`.`guardianship` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`billing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`billing` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`billing` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `guardianship_id` INT(11) NULL DEFAULT NULL,
  `value` INT(11) NULL DEFAULT NULL,
  `description` VARCHAR(250) NULL DEFAULT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bilgua_id_idx` (`guardianship_id` ASC),
  INDEX `fk_biluse_id_idx` (`user_id` ASC),
  CONSTRAINT `fk_bilgua_id`
    FOREIGN KEY (`guardianship_id`)
    REFERENCES `bd_tickets`.`guardianship` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_biluse_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_tickets`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`category` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`kind`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`kind` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`kind` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`medical_record`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`medical_record` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`medical_record` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `number` INT(11) NULL DEFAULT NULL,
  `guardianship_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_medgua_id_idx` (`guardianship_id` ASC),
  CONSTRAINT `fk_medgua_id`
    FOREIGN KEY (`guardianship_id`)
    REFERENCES `bd_tickets`.`guardianship` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`priority`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`priority` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`priority` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`project` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`project` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`status` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bd_tickets`.`ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bd_tickets`.`ticket` ;

CREATE TABLE IF NOT EXISTS `bd_tickets`.`ticket` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `kind_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `asigned_id` INT(11) NULL DEFAULT NULL,
  `project_id` INT(11) NULL DEFAULT NULL,
  `category_id` INT(11) NULL DEFAULT NULL,
  `priority_id` INT(11) NOT NULL DEFAULT '1',
  `status_id` INT(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `fk_tickin_id_idx` (`kind_id` ASC),
  INDEX `fk_ticuse_id_idx` (`user_id` ASC),
  INDEX `fk_ticasi_id_idx` (`asigned_id` ASC),
  INDEX `fk_ticpro_id_idx` (`project_id` ASC),
  INDEX `fk_ticcat_id_idx` (`category_id` ASC),
  INDEX `fk_ticpri_id_idx` (`priority_id` ASC),
  INDEX `fk_ticsta_id_idx` (`status_id` ASC),
  CONSTRAINT `fk_ticasi_id`
    FOREIGN KEY (`asigned_id`)
    REFERENCES `bd_tickets`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticcat_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `bd_tickets`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tickin_id`
    FOREIGN KEY (`kind_id`)
    REFERENCES `bd_tickets`.`kind` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticpri_id`
    FOREIGN KEY (`priority_id`)
    REFERENCES `bd_tickets`.`priority` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticpro_id`
    FOREIGN KEY (`project_id`)
    REFERENCES `bd_tickets`.`project` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticsta_id`
    FOREIGN KEY (`status_id`)
    REFERENCES `bd_tickets`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticuse_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bd_tickets`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;