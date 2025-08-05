<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function registro() {
        $this->load->view('registro');
    }

    public function guardar_registro() {
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        
        // Validar que las contraseñas coincidan
        if ($password !== $confirm_password) {
            $this->session->set_flashdata('error_registro', 'Las contraseñas no coinciden');
            redirect('welcome');
            return;
        }
        
        // Validar longitud mínima de contraseña
        if (strlen($password) < 6) {
            $this->session->set_flashdata('error_registro', 'La contraseña debe tener al menos 6 caracteres');
            redirect('welcome');
            return;
        }
        
        $data = [
            'nombre' => $this->input->post('nombre'),
            'email' => $this->input->post('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        if ($this->Usuario_model->registrar($data)) {
            $this->session->set_flashdata('mensaje', 'Registro exitoso. Ahora puedes iniciar sesión.');
            redirect('welcome');
        } else {
            $this->session->set_flashdata('error_registro', 'Error al registrar. El email ya existe.');
            redirect('welcome');
        }
    }

    public function login() {
        $this->load->view('login');
    }

    public function iniciar_sesion() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $usuario = $this->Usuario_model->verificar_usuario($email, $password);

        if ($usuario) {
            $this->session->set_userdata('usuario', $usuario);
            redirect('libros');
        } else {
            $this->session->set_flashdata('error', 'Correo o contraseña incorrectos');
            redirect('welcome');
        }
    }

    public function panel() {
        if (!$this->session->userdata('usuario')) {
            redirect('welcome');
        }
        redirect('libros'); // Redirigir al catálogo de libros
    }

    public function salir() {
        $this->session->sess_destroy();
        redirect('Welcome');
    }
}
