<?php
$pdo->exec("
CREATE TABLE roles (
    id INT AUTO_INCREMENT,
    nombre VARCHAR(20) NOT NULL,
    CONSTRAINT pk_roles PRIMARY KEY (id)
  )
");
$pdo->exec("
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    password VARCHAR(250) NOT NULL,
    rol INT NOT NULL DEFAULT 1,
    CONSTRAINT pk_usuarios PRIMARY KEY (id),
    FOREIGN KEY (rol) REFERENCES roles(id)
  )
");

$pdo->exec("
INSERT INTO roles (id,nombre) VALUES (1,'usuario'), (2,'admin');
");

?>