<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favoritos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Favorito_Model', 'Libro_Model']);
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('usuario')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $usuario = $this->session->userdata('usuario');
        $data['usuario'] = $usuario;
        $data['libros'] = $this->Favorito_Model->obtener_favoritos_usuario($usuario->id);
        $this->load->view('favoritos/index', $data);
    }

    public function agregar($libro_id) {
        $usuario = $this->session->userdata('usuario');
        $this->Favorito_Model->agregar($usuario->id, (int)$libro_id);
        $this->session->set_flashdata('mensaje', 'Libro agregado a favoritos');
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('libros');
        redirect($referer);
    }

    public function eliminar($libro_id) {
        $usuario = $this->session->userdata('usuario');
        $this->Favorito_Model->eliminar($usuario->id, (int)$libro_id);
        $this->session->set_flashdata('mensaje', 'Libro eliminado de favoritos');
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('libros');
        redirect($referer);
    }
} 