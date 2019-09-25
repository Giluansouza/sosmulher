-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `email` VARCHAR(80) NULL,
  `password` VARCHAR(255) NULL,
  `forget` VARCHAR(255) NULL,
  `cpf` VARCHAR(11) NULL,
  `rg` VARCHAR(20) NULL,
  `date_birth` DATE NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `occurrences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `occurrences` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `real_time` INT(1) NULL,
  `plaintiff` VARCHAR(45) NULL,
  `name_victim` VARCHAR(255) NULL,
  `name_accused` VARCHAR(255) NULL,
  `note` TEXT NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `uf_initials` VARCHAR(2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `addresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` INT UNSIGNED NULL,
  `city_id` INT NULL,
  `occurrences_id` INT UNSIGNED NULL,
  `cep` VARCHAR(10) NULL,
  `public_place` VARCHAR(255) NULL,
  `complement` VARCHAR(255) NULL,
  `district` VARCHAR(100) NULL,
  `latitude` FLOAT(7,2) NULL,
  `longitude` FLOAT(7,2) NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_address_user_idx` (`users_id` ASC),
  INDEX `fk_address_occurrence_idx` (`occurrences_id` ASC),
  INDEX `fk_address_city_idx` (`city_id` ASC),
  CONSTRAINT `fk_address_user`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_address_occurrence`
    FOREIGN KEY (`occurrences_id`)
    REFERENCES `occurrences` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_address_city`
    FOREIGN KEY (`city_id`)
    REFERENCES `cities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users_has_occurrences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users_has_occurrences` (
  `users_id` INT UNSIGNED NOT NULL,
  `occurrences_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`users_id`, `occurrences_id`),
  INDEX `fk_users_has_occurrences_occurrences1_idx` (`occurrences_id` ASC),
  INDEX `fk_users_has_occurrences_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_occurrences_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_occurrences_occurrences1`
    FOREIGN KEY (`occurrences_id`)
    REFERENCES `occurrences` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
