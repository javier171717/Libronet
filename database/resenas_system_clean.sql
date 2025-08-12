-- Sistema de Reseñas y Comentarios para SanabriaCod
-- Archivo SQL limpio que verifica existencia antes de crear

-- Verificar y crear tabla principal de reseñas
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'resenas') = 0,
    'CREATE TABLE resenas (
        id INT PRIMARY KEY AUTO_INCREMENT,
        libro_id INT NOT NULL,
        usuario_id INT NOT NULL,
        calificacion INT(1) NOT NULL CHECK (calificacion >= 1 AND calificacion <= 5),
        titulo VARCHAR(100) NOT NULL,
        comentario TEXT NOT NULL,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        estado ENUM("activa", "moderada", "eliminada") DEFAULT "activa",
        FOREIGN KEY (libro_id) REFERENCES libros(id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
        UNIQUE KEY unique_usuario_libro (usuario_id, libro_id)
    )',
    'SELECT "Tabla resenas ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar y crear tabla de likes en reseñas
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'likes_resenas') = 0,
    'CREATE TABLE likes_resenas (
        id INT PRIMARY KEY AUTO_INCREMENT,
        resena_id INT NOT NULL,
        usuario_id INT NOT NULL,
        fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (resena_id) REFERENCES resenas(id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
        UNIQUE KEY unique_usuario_resena (usuario_id, resena_id)
    )',
    'SELECT "Tabla likes_resenas ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar y crear tabla de respuestas a comentarios
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'respuestas_comentarios') = 0,
    'CREATE TABLE respuestas_comentarios (
        id INT PRIMARY KEY AUTO_INCREMENT,
        resena_id INT NOT NULL,
        usuario_id INT NOT NULL,
        respuesta TEXT NOT NULL,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        estado ENUM("activa", "moderada", "eliminada") DEFAULT "activa",
        FOREIGN KEY (resena_id) REFERENCES resenas(id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
    )',
    'SELECT "Tabla respuestas_comentarios ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar y crear tabla de reportes de reseñas
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reportes_resenas') = 0,
    'CREATE TABLE reportes_resenas (
        id INT PRIMARY KEY AUTO_INCREMENT,
        resena_id INT NOT NULL,
        usuario_reportador_id INT NOT NULL,
        motivo ENUM("spam", "inapropiado", "spoiler", "otro") NOT NULL,
        descripcion TEXT,
        fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        estado ENUM("pendiente", "revisado", "resuelto") DEFAULT "pendiente",
        FOREIGN KEY (resena_id) REFERENCES resenas(id) ON DELETE CASCADE,
        FOREIGN KEY (usuario_reportador_id) REFERENCES usuarios(id) ON DELETE CASCADE
    )',
    'SELECT "Tabla reportes_resenas ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Crear índices solo si no existen
-- Índice para resenas por libro
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'resenas' AND INDEX_NAME = 'idx_resenas_libro') = 0,
    'CREATE INDEX idx_resenas_libro ON resenas(libro_id)',
    'SELECT "Índice idx_resenas_libro ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Índice para resenas por usuario
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'resenas' AND INDEX_NAME = 'idx_resenas_usuario') = 0,
    'CREATE INDEX idx_resenas_usuario ON resenas(usuario_id)',
    'SELECT "Índice idx_resenas_usuario ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Índice para resenas por calificación
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'resenas' AND INDEX_NAME = 'idx_resenas_calificacion') = 0,
    'CREATE INDEX idx_resenas_calificacion ON resenas(calificacion)',
    'SELECT "Índice idx_resenas_calificacion ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Índice para resenas por fecha
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'resenas' AND INDEX_NAME = 'idx_resenas_fecha') = 0,
    'CREATE INDEX idx_resenas_fecha ON resenas(fecha_creacion)',
    'SELECT "Índice idx_resenas_fecha ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Índice para likes por reseña
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'likes_resenas' AND INDEX_NAME = 'idx_likes_resena') = 0,
    'CREATE INDEX idx_likes_resena ON likes_resenas(resena_id)',
    'SELECT "Índice idx_likes_resena ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Índice para respuestas por reseña
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'respuestas_comentarios' AND INDEX_NAME = 'idx_respuestas_resena') = 0,
    'CREATE INDEX idx_respuestas_resena ON respuestas_comentarios(resena_id)',
    'SELECT "Índice idx_respuestas_resena ya existe" as mensaje'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Insertar datos de ejemplo solo si la tabla está vacía
INSERT INTO resenas (libro_id, usuario_id, calificacion, titulo, comentario) 
SELECT 1, 1, 5, 'Excelente libro de programación', 'Este libro me ayudó mucho a entender los conceptos básicos de programación. Muy recomendado para principiantes.'
WHERE NOT EXISTS (SELECT 1 FROM resenas WHERE libro_id = 1 AND usuario_id = 1);

INSERT INTO resenas (libro_id, usuario_id, calificacion, titulo, comentario) 
SELECT 1, 2, 4, 'Muy bueno para empezar', 'Contenido claro y bien estructurado. Ideal para quienes quieren aprender desde cero.'
WHERE NOT EXISTS (SELECT 1 FROM resenas WHERE libro_id = 1 AND usuario_id = 2);

INSERT INTO resenas (libro_id, usuario_id, calificacion, titulo, comentario) 
SELECT 2, 1, 5, 'Obra maestra de la literatura', 'Una historia conmovedora que te hace reflexionar sobre la vida y las relaciones humanas.'
WHERE NOT EXISTS (SELECT 1 FROM resenas WHERE libro_id = 2 AND usuario_id = 1);

-- Mensaje final
SELECT 'Sistema de reseñas configurado correctamente' as mensaje; 