CREATE TABLE  `users` (
 `id` INT NOT NULL AUTO_INCREMENT ,
 `login` VARCHAR( 20 ) NOT NULL ,
 `password` VARCHAR( 35 ) NOT NULL ,
 `email` VARCHAR( 50 ) NOT NULL ,
 `reg_date` VARCHAR( 32 ) NOT NULL ,
 `name_user` VARCHAR( 32 ) NOT NULL ,
 `lastname` VARCHAR( 32 ) NOT NULL ,
PRIMARY KEY (  `id` )
);
