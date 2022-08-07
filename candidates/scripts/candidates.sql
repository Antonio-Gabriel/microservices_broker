
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- candidate
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `candidate`;

CREATE TABLE `candidate`
(
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(80) NOT NULL,
    `category_id` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `candidate_fi_904832` (`category_id`),
    CONSTRAINT `candidate_fk_904832`
        FOREIGN KEY (`category_id`)
        REFERENCES `category` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category`
(
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(80) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
