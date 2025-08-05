<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        // Si el usuario está logueado, redirigir al catálogo
        if ($this->session->userdata('usuario')) {
            redirect('libros');
        } else {
            // Si no está logueado, mostrar la página de inicio
            $this->load->view('inicio');
        }
    }
}
