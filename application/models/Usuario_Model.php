<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

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
}
