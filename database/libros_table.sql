-- Script para crear la tabla de libros en la base de datos libronet
-- Ejecuta este script en phpMyAdmin o en tu cliente MySQL
USE libronet;
-- Crear tabla de libros si no existe
CREATE TABLE IF NOT EXISTS `libros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `anio` int(4) NOT NULL,
  `descripcion` text,
  `fecha_agregado` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- Insertar algunos libros de ejemplo
INSERT INTO `libros` (
    `titulo`,
    `autor`,
    `genero`,
    `anio`,
    `descripcion`
  )
VALUES (
    'Don Quijote de la Mancha',
    'Miguel de Cervantes',
    'novela',
    1605,
    'La obra maestra de la literatura española'
  ),
  (
    'Cien años de soledad',
    'Gabriel García Márquez',
    'novela',
    1967,
    'Una de las obras más importantes del realismo mágico'
  ),
  (
    'El Señor de los Anillos',
    'J.R.R. Tolkien',
    'fantasia',
    1954,
    'Una épica trilogía de fantasía'
  ),
  (
    '1984',
    'George Orwell',
    'ciencia-ficcion',
    1949,
    'Una distopía que presenta una sociedad totalitaria'
  ),
  (
    'El Principito',
    'Antoine de Saint-Exupéry',
    'novela',
    1943,
    'Una fábula poética sobre el amor y la amistad'
  );
-- Verificar que la tabla se creó correctamente
SELECT *
FROM libros
LIMIT 5;