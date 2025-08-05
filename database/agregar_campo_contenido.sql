-- Script para agregar campo de contenido completo del libro
USE libronet;

-- Agregar columna para el contenido completo del libro
ALTER TABLE libros 
ADD COLUMN contenido_completo LONGTEXT DEFAULT NULL 
AFTER descripcion;

-- Verificar que la columna se agregó correctamente
DESCRIBE libros; 