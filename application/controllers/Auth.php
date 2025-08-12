<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_Model');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function registro() {
        $this->load->view('registro');
    }

    public function guardar_registro() {
        $nombre = trim($this->input->post('nombre'));
        $email = trim($this->input->post('email'));
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        
        // Validar nombre (solo letras, espacios y acentos, máximo 50 caracteres)
        if (empty($nombre)) {
            $this->session->set_flashdata('error_registro', 'El nombre es obligatorio');
            redirect('welcome');
            return;
        }
        
        if (strlen($nombre) > 50) {
            $this->session->set_flashdata('error_registro', 'El nombre no puede superar los 50 caracteres');
            redirect('welcome');
            return;
        }
        
        // Validar que el nombre solo contenga letras, espacios y acentos
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $nombre)) {
            $this->session->set_flashdata('error_registro', 'El nombre solo puede contener letras y espacios');
            redirect('welcome');
            return;
        }
        
        // Validar que tenga al menos 2 palabras (nombre y apellido)
        $palabras = explode(' ', $nombre);
        $palabras = array_filter($palabras); // Eliminar espacios vacíos
        if (count($palabras) < 2) {
            $this->session->set_flashdata('error_registro', 'Ingresa tu nombre completo (nombre y apellido)');
            redirect('welcome');
            return;
        }
        
        // Validar email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('error_registro', 'Ingresa un correo electrónico válido');
            redirect('welcome');
            return;
        }
        
        // Validar que las contraseñas coincidan
        if ($password !== $confirm_password) {
            $this->session->set_flashdata('error_registro', 'Las contraseñas no coinciden');
            redirect('welcome');
            return;
        }
        
        // Validar longitud mínima de contraseña
        if (strlen($password) < 8) {
            $this->session->set_flashdata('error_registro', 'La contraseña debe tener al menos 8 caracteres');
            redirect('welcome');
            return;
        }
        
        // Validar que la contraseña tenga al menos una mayúscula, una minúscula y un número
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $password)) {
            $this->session->set_flashdata('error_registro', 'La contraseña debe contener al menos una mayúscula, una minúscula y un número');
            redirect('welcome');
            return;
        }
        
        $data = [
            'nombre' => $nombre,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        if ($this->Usuario_Model->registrar($data)) {
            // Los flashdata se limpian automáticamente después de ser mostrados
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

        $usuario = $this->Usuario_Model->verificar_usuario($email, $password);

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

    // Método para validar credenciales en tiempo real via AJAX
    public function validar_credenciales() {
        // Solo permitir peticiones AJAX
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $email = trim($this->input->post('email'));
        $password = $this->input->post('password');

        $response = ['valid' => false, 'message' => ''];

        // Validar que ambos campos tengan contenido
        if (empty($email) || empty($password)) {
            $response['message'] = 'Por favor completa ambos campos';
            echo json_encode($response);
            return;
        }

        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = 'Formato de correo electrónico inválido';
            echo json_encode($response);
            return;
        }

        // Verificar credenciales en la base de datos
        $usuario = $this->Usuario_Model->verificar_usuario($email, $password);

        if ($usuario) {
            $response['valid'] = true;
            $response['message'] = 'Credenciales válidas';
        } else {
            $response['message'] = 'Correo o contraseña incorrectos';
        }

        echo json_encode($response);
    }
}
