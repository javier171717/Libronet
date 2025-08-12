<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resena_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Obtener todas las reseñas de un libro
     */
    public function get_resenas_libro($libro_id, $limit = 10, $offset = 0, $orden = 'fecha_creacion DESC') {
        $this->db->select('r.*, u.nombre as nombre_usuario, u.email as email_usuario');
        $this->db->from('resenas r');
        $this->db->join('usuarios u', 'u.id = r.usuario_id');
        $this->db->where('r.libro_id', $libro_id);
        $this->db->where('r.estado', 'activa');
        $this->db->order_by($orden);
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Obtener reseña específica con información del usuario
     */
    public function get_resena($resena_id) {
        $this->db->select('r.*, u.nombre as nombre_usuario, u.email as email_usuario');
        $this->db->from('resenas r');
        $this->db->join('usuarios u', 'u.id = r.usuario_id');
        $this->db->where('r.id', $resena_id);
        $this->db->where('r.estado', 'activa');
        
        $query = $this->db->get();
        return $query->row();
    }
    
    /**
     * Obtener reseña de un usuario específico para un libro
     */
    public function get_resena_usuario($libro_id, $usuario_id) {
        $this->db->where('libro_id', $libro_id);
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('estado', 'activa');
        
        $query = $this->db->get('resenas');
        return $query->row();
    }
    
    /**
     * Crear nueva reseña
     */
    public function crear_resena($data) {
        // Verificar si el usuario ya tiene una reseña para este libro
        $resena_existente = $this->get_resena_usuario($data['libro_id'], $data['usuario_id']);
        
        if ($resena_existente) {
            return false; // Ya existe una reseña
        }
        
        $data['fecha_creacion'] = date('Y-m-d H:i:s');
        $data['fecha_actualizacion'] = date('Y-m-d H:i:s');
        
        $this->db->insert('resenas', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Actualizar reseña existente
     */
    public function actualizar_resena($resena_id, $usuario_id, $data) {
        $data['fecha_actualizacion'] = date('Y-m-d H:i:s');
        
        $this->db->where('id', $resena_id);
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('estado', 'activa');
        
        return $this->db->update('resenas', $data);
    }
    
    /**
     * Eliminar reseña (cambiar estado a eliminada)
     */
    public function eliminar_resena($resena_id, $usuario_id) {
        $this->db->where('id', $resena_id);
        $this->db->where('usuario_id', $usuario_id);
        
        return $this->db->update('resenas', ['estado' => 'eliminada']);
    }
    
    /**
     * Obtener estadísticas de reseñas de un libro
     */
    public function get_estadisticas_libro($libro_id) {
        $this->db->select('
            COUNT(*) as total_resenas,
            AVG(calificacion) as promedio_calificacion,
            SUM(CASE WHEN calificacion = 5 THEN 1 ELSE 0 END) as cinco_estrellas,
            SUM(CASE WHEN calificacion = 4 THEN 1 ELSE 0 END) as cuatro_estrellas,
            SUM(CASE WHEN calificacion = 3 THEN 1 ELSE 0 END) as tres_estrellas,
            SUM(CASE WHEN calificacion = 2 THEN 1 ELSE 0 END) as dos_estrellas,
            SUM(CASE WHEN calificacion = 1 THEN 1 ELSE 0 END) as una_estrella
        ');
        $this->db->from('resenas');
        $this->db->where('libro_id', $libro_id);
        $this->db->where('estado', 'activa');
        
        $query = $this->db->get();
        return $query->row();
    }
    
    /**
     * Obtener reseñas más recientes
     */
    public function get_resenas_recientes($limit = 5) {
        $this->db->select('r.*, u.nombre as nombre_usuario, l.titulo as titulo_libro');
        $this->db->from('resenas r');
        $this->db->join('usuarios u', 'u.id = r.usuario_id');
        $this->db->join('libros l', 'l.id = r.libro_id');
        $this->db->where('r.estado', 'activa');
        $this->db->order_by('r.fecha_creacion', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Obtener reseñas de un usuario específico
     */
    public function get_resenas_usuario($usuario_id, $limit = 10) {
        $this->db->select('r.*, l.titulo as titulo_libro, l.autor as autor_libro');
        $this->db->from('resenas r');
        $this->db->join('libros l', 'l.id = r.libro_id');
        $this->db->where('r.usuario_id', $usuario_id);
        $this->db->where('r.estado', 'activa');
        $this->db->order_by('r.fecha_creacion', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Agregar like a una reseña
     */
    public function agregar_like($resena_id, $usuario_id) {
        // Verificar si ya existe el like
        $this->db->where('resena_id', $resena_id);
        $this->db->where('usuario_id', $usuario_id);
        $existe = $this->db->get('likes_resenas')->row();
        
        if ($existe) {
            return false; // Ya existe el like
        }
        
        $data = [
            'resena_id' => $resena_id,
            'usuario_id' => $usuario_id,
            'fecha' => date('Y-m-d H:i:s')
        ];
        
        return $this->db->insert('likes_resenas', $data);
    }
    
    /**
     * Quitar like de una reseña
     */
    public function quitar_like($resena_id, $usuario_id) {
        $this->db->where('resena_id', $resena_id);
        $this->db->where('usuario_id', $usuario_id);
        
        return $this->db->delete('likes_resenas');
    }
    
    /**
     * Obtener cantidad de likes de una reseña
     */
    public function get_likes_resena($resena_id) {
        $this->db->where('resena_id', $resena_id);
        return $this->db->count_all_results('likes_resenas');
    }
    
    /**
     * Verificar si un usuario dio like a una reseña
     */
    public function usuario_dio_like($resena_id, $usuario_id) {
        $this->db->where('resena_id', $resena_id);
        $this->db->where('usuario_id', $usuario_id);
        
        return $this->db->count_all_results('likes_resenas') > 0;
    }
    
    /**
     * Buscar reseñas por texto
     */
    public function buscar_resenas($termino, $limit = 20) {
        $this->db->select('r.*, u.nombre as nombre_usuario, l.titulo as titulo_libro, l.autor as autor_libro');
        $this->db->from('resenas r');
        $this->db->join('usuarios u', 'u.id = r.usuario_id');
        $this->db->join('libros l', 'l.id = r.libro_id');
        $this->db->where('r.estado', 'activa');
        $this->db->group_start();
        $this->db->like('r.titulo', $termino);
        $this->db->or_like('r.comentario', $termino);
        $this->db->or_like('l.titulo', $termino);
        $this->db->or_like('l.autor', $termino);
        $this->db->group_end();
        $this->db->order_by('r.fecha_creacion', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Obtener reseñas más populares (por likes)
     */
    public function get_resenas_populares($limit = 10) {
        $this->db->select('r.*, u.nombre as nombre_usuario, l.titulo as titulo_libro, COUNT(lr.id) as total_likes');
        $this->db->from('resenas r');
        $this->db->join('usuarios u', 'u.id = r.usuario_id');
        $this->db->join('libros l', 'l.id = r.libro_id');
        $this->db->join('likes_resenas lr', 'lr.resena_id = r.id', 'left');
        $this->db->where('r.estado', 'activa');
        $this->db->group_by('r.id');
        $this->db->order_by('total_likes', 'DESC');
        $this->db->order_by('r.fecha_creacion', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result();
    }
} 