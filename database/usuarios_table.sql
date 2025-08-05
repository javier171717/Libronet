-- Script para crear la tabla de usuarios en la base de datos libronet
-- Ejecuta este script en phpMyAdmin o en tu cliente MySQL

USE libronet;

-- Crear tabla de usuarios si no existe
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Verificar que la tabla se creó correctamente
SHOW TABLES LIKE 'usuarios'; 