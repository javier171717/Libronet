-- Script para actualizar registros que no tengan fecha_agregado
USE libronet;

-- Actualizar registros que tengan fecha_agregado NULL o vacío
UPDATE libros 
SET fecha_agregado = CURRENT_TIMESTAMP 
WHERE fecha_agregado IS NULL OR fecha_agregado = '';

-- Verificar que todos los registros tengan fecha_agregado
SELECT id, titulo, fecha_agregado 
FROM libros 
ORDER BY id; 

-- Tabla para préstamos
CREATE TABLE prestamos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    libro_id INT,
    prestado_a VARCHAR(100),
    fecha_prestamo DATE,
    fecha_devolucion_esperada DATE,
    fecha_devolucion_real DATE NULL,
    notas TEXT
); 