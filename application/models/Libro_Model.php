<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libro_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'libros';
    }

    // Obtener todos los libros
    public function obtener_libros() {
        $this->db->order_by('titulo', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Obtener un libro por ID
    public function obtener_libro($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Agregar nuevo libro
    public function agregar_libro($data) {
        // Asegurar que siempre tenga fecha_agregado
        if (!isset($data['fecha_agregado']) || empty($data['fecha_agregado'])) {
            $data['fecha_agregado'] = date('Y-m-d H:i:s');
        }
        
        // Asegurar que tenga usuario_id
        if (!isset($data['usuario_id'])) {
            $data['usuario_id'] = $this->session->userdata('usuario')->id;
        }
        
        return $this->db->insert($this->table, $data);
    }

    // Actualizar libro
    public function actualizar_libro($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    // Eliminar libro
    public function eliminar_libro($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    // Buscar libros por título o autor
    public function buscar_libros($termino) {
        $this->db->like('titulo', $termino);
        $this->db->or_like('autor', $termino);
        $this->db->or_like('genero', $termino);
        $this->db->order_by('titulo', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Obtener libros por género
    public function obtener_por_genero($genero) {
        $this->db->where('genero', $genero);
        $this->db->order_by('titulo', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Contar total de libros
    public function contar_libros() {
        return $this->db->count_all($this->table);
    }

    // Subir imagen del libro
    public function subir_imagen($archivo, $id_libro) {
        $config['upload_path'] = './uploads/libros/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'libro_' . $id_libro . '_' . time();
        $config['overwrite'] = TRUE;

        // Cargar librería de upload
        $CI =& get_instance();
        $CI->load->library('upload', $config);

        if ($CI->upload->do_upload($archivo)) {
            $upload_data = $CI->upload->data();
            return $upload_data['file_name'];
        } else {
            return FALSE;
        }
    }

    // Eliminar imagen del libro
    public function eliminar_imagen($nombre_archivo) {
        $ruta_archivo = './uploads/libros/' . $nombre_archivo;
        if (file_exists($ruta_archivo)) {
            return unlink($ruta_archivo);
        }
        return FALSE;
    }

    // Verificar si un usuario es propietario del libro
    public function es_propietario($libro_id, $usuario_id) {
        $libro = $this->db->get_where($this->table, [
            'id' => $libro_id,
            'usuario_id' => $usuario_id
        ])->row();
        
        return $libro !== null;
    }

    // Obtener el usuario_id del propietario del libro
    public function obtener_propietario($libro_id) {
        $libro = $this->db->select('usuario_id')
                         ->where('id', $libro_id)
                         ->get($this->table)
                         ->row();
        return $libro ? $libro->usuario_id : null;
    }
} 