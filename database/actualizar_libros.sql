-- Script para actualizar la tabla libros
USE libronet;

-- 1. Crear tabla temporal para respaldar los datos
CREATE TABLE libros_temp AS SELECT * FROM libros;

-- 2. Eliminar la tabla original
DROP TABLE libros;

-- 3. Crear la tabla con la nueva estructura
CREATE TABLE IF NOT EXISTS `libros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `anio` int(4) NOT NULL,
  `descripcion` text,
  `fecha_agregado` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `contenido_completo` text,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- 4. Restaurar los datos con un usuario_id por defecto (asumiendo que el ID 1 existe)
INSERT INTO libros (
    titulo,
    autor,
    genero,
    anio,
    descripcion,
    fecha_agregado,
    usuario_id,
    imagen,
    contenido_completo
)
SELECT 
    titulo,
    autor,
    genero,
    anio,
    descripcion,
    fecha_agregado,
    1 as usuario_id, -- Asignar todos los libros existentes al usuario con ID 1
    imagen,
    contenido_completo
FROM libros_temp;

-- 5. Eliminar la tabla temporal
DROP TABLE libros_temp;

-- 6. Verificar que la migración fue exitosa
SELECT * FROM libros LIMIT 5; 