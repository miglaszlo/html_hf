-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema hf
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hf
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hf` DEFAULT CHARACTER SET utf8 ;
USE `hf` ;

-- -----------------------------------------------------
-- Table `hf`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hf`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(15) NULL DEFAULT NULL,
  `password` VARCHAR(100) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `dark_mode` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hf`.`recipes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hf`.`recipes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL DEFAULT NULL,
  `desc` VARCHAR(1500) NULL DEFAULT NULL,
  `cooking_time` INT(11) NULL DEFAULT NULL,
  `create_date` DATE NULL DEFAULT NULL,
  `Users_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_Recipes_Users1_idx` (`Users_id` ASC),
  CONSTRAINT `fk_Recipes_Users1`
    FOREIGN KEY (`Users_id`)
    REFERENCES `hf`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hf`.`favourites`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hf`.`favourites` (
  `Users_id` INT(11) NULL DEFAULT NULL,
  `Recipes_id` INT(11) NULL DEFAULT NULL,
  INDEX `fk_Users_has_Recipes_Recipes1_idx` (`Recipes_id` ASC),
  INDEX `fk_Users_has_Recipes_Users_idx` (`Users_id` ASC),
  CONSTRAINT `fk_Users_has_Recipes_Recipes1`
    FOREIGN KEY (`Recipes_id`)
    REFERENCES `hf`.`recipes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Users_has_Recipes_Users`
    FOREIGN KEY (`Users_id`)
    REFERENCES `hf`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hf`.`ingredients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hf`.`ingredients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `unit_of_measure` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hf`.`recipe_contains`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hf`.`recipe_contains` (
  `Ingredients_id` INT(11) NOT NULL AUTO_INCREMENT,
  `Recipes_id` INT(11) NOT NULL,
  `amount` FLOAT NULL DEFAULT NULL,
  PRIMARY KEY (`Ingredients_id`, `Recipes_id`),
  UNIQUE INDEX `Ingredients_id_UNIQUE` (`Ingredients_id` ASC),
  INDEX `fk_Ingredients_has_Recipes_Recipes1_idx` (`Recipes_id` ASC),
  INDEX `fk_Ingredients_has_Recipes_Ingredients1_idx` (`Ingredients_id` ASC),
  CONSTRAINT `fk_Ingredients_has_Recipes_Ingredients1`
    FOREIGN KEY (`Ingredients_id`)
    REFERENCES `hf`.`ingredients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ingredients_has_Recipes_Recipes1`
    FOREIGN KEY (`Recipes_id`)
    REFERENCES `hf`.`recipes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
