<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Libro_Model', 'Usuario_Model']);
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
        
        // Verificar si el usuario está logueado
        if (!$this->session->userdata('usuario')) {
            redirect('auth/login');
        }
    }

    // Página principal del dashboard
    public function index() {
        $data['usuario'] = $this->session->userdata('usuario');
        
        // Estadísticas generales
        $data['total_libros'] = $this->Libro_Model->contar_libros();
        $data['total_usuarios'] = $this->Usuario_Model->contar_usuarios();
        $data['libros_este_mes'] = $this->Libro_Model->contar_libros_este_mes();
        $data['libros_usuario'] = $this->Libro_Model->contar_libros_por_usuario($data['usuario']->id);
        
        // Libros por género
        $data['libros_por_genero'] = $this->Libro_Model->obtener_libros_por_genero();
        
        // Libros más recientes
        $data['libros_recientes'] = $this->Libro_Model->obtener_libros_recientes(5);
        
        // Usuarios más activos
        $data['usuarios_activos'] = $this->Usuario_Model->obtener_usuarios_activos(5);
        
        // Actividad reciente
        $data['actividad_reciente'] = $this->Libro_Model->obtener_actividad_reciente(10);
        
        $this->load->view('dashboard/index', $data);
    }

    // API para obtener datos de gráficos (AJAX)
    public function get_chart_data() {
        $data['generos'] = $this->Libro_Model->obtener_libros_por_genero();
        $data['libros_mes'] = $this->Libro_Model->obtener_libros_por_mes();
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }
} 