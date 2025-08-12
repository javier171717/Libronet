<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

    public function registrar($data) {
        return $this->db->insert('usuarios', $data);
    }

    public function verificar_usuario($email, $password) {
        $query = $this->db->get_where('usuarios', ['email' => $email]);
        $usuario = $query->row();

        if ($usuario && password_verify($password, $usuario->password)) {
            return $usuario;
        }
        return false;
    }

    // Contar total de usuarios
    public function contar_usuarios() {
        return $this->db->count_all('usuarios');
    }

    // Obtener usuarios más activos (por cantidad de libros)
    public function obtener_usuarios_activos($limite = 5) {
        $this->db->select('u.id, u.nombre, u.email, COUNT(l.id) as total_libros');
        $this->db->from('usuarios u');
        $this->db->join('libros l', 'l.usuario_id = u.id', 'left');
        $this->db->group_by('u.id');
        $this->db->order_by('total_libros', 'DESC');
        $this->db->limit($limite);
        return $this->db->get()->result();
    }
}
