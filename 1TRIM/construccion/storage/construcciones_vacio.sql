CREATE DATABASE construcciones;
USE construcciones;

CREATE TABLE roles (
  id INT AUTO_INCREMENT,
  nombre VARCHAR(20) NOT NULL,
  CONSTRAINT pk_roles PRIMARY KEY (id)
);

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  password VARCHAR(250) NOT NULL,
  rol INT NOT NULL DEFAULT 1,
  CONSTRAINT pk_usuarios PRIMARY KEY (id),
  FOREIGN KEY (rol) REFERENCES roles(id),
  CONSTRAINT uq_usuarios UNIQUE KEY(nombre)
);

CREATE TABLE tableros (
  id INT AUTO_INCREMENT,
  usuario_id INT NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  contenido VARCHAR(200),
  fecha BIGINT,
  CONSTRAINT pk_tableros PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);



CREATE TABLE figuras (
  id INT AUTO_INCREMENT,
  imagen BLOB,
  tipo_imagen VARCHAR(50),
  CONSTRAINT pk_figuras PRIMARY KEY (id)
);

create table figuras_tableros(
id int AUTO_INCREMENT,
tablero_id int NOT NULL,
figura_id int NOT NULL,
posicion int NOT NULL,
CONSTRAINT pk_ft PRIMARY KEY(id),
CONSTRAINT fk_tablero FOREIGN KEY(tablero_id) REFERENCES tableros(id),
CONSTRAINT fk_figura FOREIGN KEY(figura_id) REFERENCES figuras(id),
CONSTRAINT uq_tablero_posicion UNIQUE KEY(tablero_id,posicion)


);

INSERT INTO roles (id,nombre) VALUES (1,'usuario'), (2,'admin');
