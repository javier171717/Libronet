-- Sistema de Reseñas y Comentarios para SanabriaCod
-- Archivo SQL para crear las tablas necesarias

-- Tabla principal de reseñas
CREATE TABLE IF NOT EXISTS resenas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    libro_id INT NOT NULL,
    usuario_id INT NOT NULL,
    calificacion INT(1) NOT NULL CHECK (calificacion >= 1 AND calificacion <= 5),
    titulo VARCHAR(100) NOT NULL,
    comentario TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    estado ENUM('activa', 'moderada', 'eliminada') DEFAULT 'activa',
    FOREIGN KEY (libro_id) REFERENCES libros(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE KEY unique_usuario_libro (usuario_id, libro_id)
);

-- Tabla de likes en reseñas
CREATE TABLE IF NOT EXISTS likes_resenas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    resena_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (resena_id) REFERENCES resenas(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE KEY unique_usuario_resena (usuario_id, resena_id)
);

-- Tabla de respuestas a comentarios
CREATE TABLE IF NOT EXISTS respuestas_comentarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    resena_id INT NOT NULL,
    usuario_id INT NOT NULL,
    respuesta TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    estado ENUM('activa', 'moderada', 'eliminada') DEFAULT 'activa',
    FOREIGN KEY (resena_id) REFERENCES resenas(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla de reportes de reseñas
CREATE TABLE IF NOT EXISTS reportes_resenas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    resena_id INT NOT NULL,
    usuario_reportador_id INT NOT NULL,
    motivo ENUM('spam', 'inapropiado', 'spoiler', 'otro') NOT NULL,
    descripcion TEXT,
    fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'revisado', 'resuelto') DEFAULT 'pendiente',
    FOREIGN KEY (resena_id) REFERENCES resenas(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_reportador_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Índices para mejorar el rendimiento
CREATE INDEX idx_resenas_libro ON resenas(libro_id);
CREATE INDEX idx_resenas_usuario ON resenas(usuario_id);
CREATE INDEX idx_resenas_calificacion ON resenas(calificacion);
CREATE INDEX idx_resenas_fecha ON resenas(fecha_creacion);
CREATE INDEX idx_likes_resena ON likes_resenas(resena_id);
CREATE INDEX idx_respuestas_resena ON respuestas_comentarios(resena_id);

-- Insertar algunos datos de ejemplo (opcional)
INSERT INTO resenas (libro_id, usuario_id, calificacion, titulo, comentario) VALUES
(1, 1, 5, 'Excelente libro de programación', 'Este libro me ayudó mucho a entender los conceptos básicos de programación. Muy recomendado para principiantes.'),
(1, 2, 4, 'Muy bueno para empezar', 'Contenido claro y bien estructurado. Ideal para quienes quieren aprender desde cero.'),
(2, 1, 5, 'Obra maestra de la literatura', 'Una historia conmovedora que te hace reflexionar sobre la vida y las relaciones humanas.'); 