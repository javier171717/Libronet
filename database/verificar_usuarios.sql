-- Script para verificar y agregar usuario de prueba
-- Ejecuta este script en phpMyAdmin

USE libronet;

-- Verificar que la tabla usuarios existe
SHOW TABLES LIKE 'usuarios';

-- Verificar la estructura de la tabla
DESCRIBE usuarios;

-- Ver si hay usuarios en la tabla
SELECT * FROM usuarios;

-- Agregar un usuario de prueba si no existe
INSERT INTO usuarios (nombre, email, password) VALUES 
('Usuario Prueba', 'test@libronet.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE id=id;

-- Verificar que el usuario se agregó
SELECT * FROM usuarios WHERE email = 'test@libronet.com'; 