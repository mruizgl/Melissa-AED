CREATE TABLE `alumnos`(
dni CHARACTER(20),
nombre CHARACTER(50),
apellidos CHARACTER(50),
fechanacimiento BIGINT,
CONSTRAINT pk_alumnos PRIMARY KEY(dni)
);
CREATE TABLE `asignaturas`(
id int AUTO_INCREMENT,
nombre CHARACTER(50),
curso CHARACTER(50),
CONSTRAINT pk_asignaturas PRIMARY KEY(id),
CONSTRAINT uc_nombrecurso UNIQUE(nombre,curso)
);
CREATE TABLE `matriculas`(
`id` int AUTO_INCREMENT,
`dni` CHARACTER(20),
`year` int,
CONSTRAINT `pk_matriculas` PRIMARY KEY(`id`),
CONSTRAINT `fk_alumnos` FOREIGN KEY(`dni`) REFERENCES `alumnos`(`dni`),
CONSTRAINT `uc_dniyear` UNIQUE(`dni`,`year`)
);
CREATE TABLE asignatura_matricula(
id int AUTO_INCREMENT,
idmatricula int,
idasignatura int,
CONSTRAINT pk_asignatura_matriculas PRIMARY KEY(id),
CONSTRAINT fk_matriculas FOREIGN KEY(idmatricula) REFERENCES matriculas(id),
CONSTRAINT fk_asignaturas FOREIGN KEY(idasignatura) REFERENCES asignaturas(id)
);
`nombre`, `apellidos`, `fechanacimiento`
INSERT INTO `alumnos` (`dni`,) VALUES ('12345678Z', 'Ana', 'Martín',
'968972400000');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES
('87654321X', 'Marcos', 'Afonso Jiménez', '874278000000');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES
('12312312K', 'María Luisa', 'Gutiérrez', '821234400000');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (1, 'BAE', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (2, 'PGV', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (3, 'LND', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (4, 'AED', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (5, 'DSW', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (6, 'DPL', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (7, 'PRO', '1º DAM');
Laravel 53INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (8, 'PGL', '2º DAM');
INSERT INTO `matriculas` (`id`, `dni`,`year`) VALUES (1, '12345678Z', 2023);
INSERT INTO `asignatura_matricula` (`idmatricula`,`idasignatura`) VALUES (1, 2);
CREATE TABLE monedas (
id INT AUTO_INCREMENT,
pais VARCHAR(50) NOT NULL,
nombre VARCHAR(50) NOT NULL,
CONSTRAINT pk_monedas PRIMARY KEY(id),
CONSTRAINT uq_nombre_pais UNIQUE(nombre,pais)
);
CREATE TABLE historicos (
id INT PRIMARY KEY AUTO_INCREMENT,
moneda_id INT NOT NULL,
equivalenteeuro FLOAT NOT NULL,
CONSTRAINT fk_monedas FOREIGN KEY(moneda_id) REFERENCES monedas(id),
fecha VARCHAR(20) NOT NULL
);