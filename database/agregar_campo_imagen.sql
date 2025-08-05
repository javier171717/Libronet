-- Script para agregar campo de imagen a la tabla libros
USE libronet;

-- Agregar columna para la imagen del libro
ALTER TABLE libros 
ADD COLUMN imagen VARCHAR(255) DEFAULT NULL 
AFTER descripcion;

-- Verificar que la columna se agregó correctamente
DESCRIBE libros; 