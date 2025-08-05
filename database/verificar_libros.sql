-- Script para verificar todos los libros en la base de datos
USE libronet;

-- Ver todos los libros
SELECT id, titulo, autor, genero, anio,
       CASE 
           WHEN contenido_completo IS NOT NULL THEN 'SÍ'
           ELSE 'NO'
       END as tiene_contenido,
       LENGTH(contenido_completo) as longitud_contenido
FROM libros 
ORDER BY id; 