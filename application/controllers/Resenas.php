<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resenas extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Resena_model', 'Libro_Model']);
        $this->load->library('session');
        $this->load->helper('url');
        
        // Debug: Verificar datos de sesión
        error_log('Resenas Controller - Usuario en sesión: ' . print_r($this->session->userdata(), true));
        
        // Verificar si el usuario está logueado
        if (!$this->session->userdata('usuario')) {
            error_log('Usuario no autenticado, redirigiendo a login');
            redirect('auth/login');
        }
    }
    
    /**
     * Mostrar formulario para agregar reseña
     */
    public function agregar($libro_id) {
        $data['libro'] = $this->Libro_Model->obtener_libro($libro_id);
        
        if (!$data['libro']) {
            show_404();
        }
        
        // Verificar si el usuario ya tiene una reseña para este libro
        $data['resena_existente'] = $this->Resena_model->get_resena_usuario(
            $libro_id, 
            $this->session->userdata('usuario')->id
        );
        
        $data['usuario'] = $this->session->userdata('usuario');
        
        $this->load->view('resenas/agregar', $data);
    }
    
    /**
     * Procesar formulario de reseña
     */
    public function guardar() {
        if ($this->input->method() !== 'post') {
            redirect('libros');
        }
        
        $this->load->library('form_validation');
        
        // Reglas de validación
        $this->form_validation->set_rules('libro_id', 'Libro', 'required|numeric');
        $this->form_validation->set_rules('calificacion', 'Calificación', 'required|numeric|greater_than[0]|less_than[6]');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('comentario', 'Comentario', 'required|min_length[20]|max_length[1000]');
        
        if ($this->form_validation->run() === FALSE) {
            // Si la validación falla, volver al formulario
            $libro_id = $this->input->post('libro_id');
            $data['libro'] = $this->Libro_Model->obtener_libro($libro_id);
            $data['usuario'] = $this->session->userdata('usuario');
            $data['error'] = validation_errors();
            $data['form_data'] = $this->input->post();
            
            $this->load->view('resenas/agregar', $data);
        } else {
            // Preparar datos para guardar
            $data = [
                'libro_id' => $this->input->post('libro_id'),
                'usuario_id' => $this->session->userdata('usuario')->id,
                'calificacion' => $this->input->post('calificacion'),
                'titulo' => $this->input->post('titulo'),
                'comentario' => $this->input->post('comentario')
            ];
            
            // Intentar guardar la reseña
            $resena_id = $this->Resena_model->crear_resena($data);
            
            if ($resena_id) {
                $this->session->set_flashdata('mensaje', '¡Reseña agregada exitosamente!');
                redirect('libros/ver/' . $data['libro_id']);
            } else {
                $this->session->set_flashdata('error', 'Ya tienes una reseña para este libro.');
                redirect('resenas/agregar/' . $data['libro_id']);
            }
        }
    }
    
    /**
     * Mostrar formulario para editar reseña
     */
    public function editar($resena_id) {
        $data['resena'] = $this->Resena_model->get_resena($resena_id);
        
        if (!$data['resena']) {
            show_404();
        }
        
        // Verificar que el usuario sea el propietario de la reseña
        if ($data['resena']->usuario_id != $this->session->userdata('usuario')->id) {
            show_error('No tienes permisos para editar esta reseña.', 403, 'Acceso Denegado');
        }
        
        $data['libro'] = $this->Libro_Model->obtener_libro($data['resena']->libro_id);
        $data['usuario'] = $this->session->userdata('usuario');
        
        $this->load->view('resenas/editar', $data);
    }
    
    /**
     * Procesar actualización de reseña
     */
    public function actualizar() {
        if ($this->input->method() !== 'post') {
            redirect('libros');
        }
        
        $this->load->library('form_validation');
        
        // Reglas de validación
        $this->form_validation->set_rules('resena_id', 'ID de Reseña', 'required|numeric');
        $this->form_validation->set_rules('calificacion', 'Calificación', 'required|numeric|greater_than[0]|less_than[6]');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('comentario', 'Comentario', 'required|min_length[20]|max_length[1000]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('resenas/editar/' . $this->input->post('resena_id'));
        } else {
            $resena_id = $this->input->post('resena_id');
            $usuario_id = $this->session->userdata('usuario')->id;
            
            // Verificar que el usuario sea el propietario
            $resena = $this->Resena_model->get_resena($resena_id);
            if (!$resena || $resena->usuario_id != $usuario_id) {
                show_error('No tienes permisos para editar esta reseña.', 403, 'Acceso Denegado');
            }
            
            $data = [
                'calificacion' => $this->input->post('calificacion'),
                'titulo' => $this->input->post('titulo'),
                'comentario' => $this->input->post('comentario')
            ];
            
            if ($this->Resena_model->actualizar_resena($resena_id, $usuario_id, $data)) {
                $this->session->set_flashdata('mensaje', '¡Reseña actualizada exitosamente!');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar la reseña.');
            }
            
            redirect('libros/ver/' . $resena->libro_id);
        }
    }
    
    /**
     * Eliminar reseña
     */
    public function eliminar($resena_id) {
        $resena = $this->Resena_model->get_resena($resena_id);
        
        if (!$resena) {
            show_404();
        }
        
        // Verificar que el usuario sea el propietario
        if ($resena->usuario_id != $this->session->userdata('usuario')->id) {
            show_error('No tienes permisos para eliminar esta reseña.', 403, 'Acceso Denegado');
        }
        
        if ($this->Resena_model->eliminar_resena($resena_id, $this->session->userdata('usuario')->id)) {
            $this->session->set_flashdata('mensaje', 'Reseña eliminada exitosamente.');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar la reseña.');
        }
        
        redirect('libros/ver/' . $resena->libro_id);
    }
    
    /**
     * Agregar/quitar like a una reseña (AJAX)
     */
    public function toggle_like() {
        if ($this->input->method() !== 'post') {
            $this->output->set_status_header(400);
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }
        
        $resena_id = $this->input->post('resena_id');
        $usuario_id = $this->session->userdata('usuario')->id;
        
        if (!$resena_id || !$usuario_id) {
            $this->output->set_status_header(400);
            echo json_encode(['error' => 'Datos incompletos']);
            return;
        }
        
        // Verificar si el usuario ya dio like
        if ($this->Resena_model->usuario_dio_like($resena_id, $usuario_id)) {
            // Quitar like
            if ($this->Resena_model->quitar_like($resena_id, $usuario_id)) {
                $total_likes = $this->Resena_model->get_likes_resena($resena_id);
                echo json_encode([
                    'success' => true,
                    'action' => 'removed',
                    'total_likes' => $total_likes,
                    'message' => 'Like removido'
                ]);
            } else {
                echo json_encode(['error' => 'Error al quitar like']);
            }
        } else {
            // Agregar like
            if ($this->Resena_model->agregar_like($resena_id, $usuario_id)) {
                $total_likes = $this->Resena_model->get_likes_resena($resena_id);
                echo json_encode([
                    'success' => true,
                    'action' => 'added',
                    'total_likes' => $total_likes,
                    'message' => 'Like agregado'
                ]);
            } else {
                echo json_encode(['error' => 'Error al agregar like']);
            }
        }
    }
    
    /**
     * Buscar reseñas
     */
    public function buscar() {
        $termino = $this->input->get('q');
        
        if (empty($termino)) {
            redirect('libros');
        }
        
        $data['termino'] = $termino;
        $data['resenas'] = $this->Resena_model->buscar_resenas($termino);
        $data['usuario'] = $this->session->userdata('usuario');
        
        $this->load->view('resenas/buscar', $data);
    }
    
    /**
     * Mostrar reseñas de un usuario específico
     */
    public function usuario($usuario_id = null) {
        if (!$usuario_id) {
            $usuario_id = $this->session->userdata('usuario')->id;
        }
        
        $data['resenas'] = $this->Resena_model->get_resenas_usuario($usuario_id);
        $data['usuario'] = $this->session->userdata('usuario');
        
        $this->load->view('resenas/usuario', $data);
    }
    
    /**
     * Mostrar reseñas más populares
     */
    public function populares() {
        $data['resenas'] = $this->Resena_model->get_resenas_populares();
        $data['usuario'] = $this->session->userdata('usuario');
        
        $this->load->view('resenas/populares', $data);
    }
    
    /**
     * Mostrar reseñas más recientes
     */
    public function recientes() {
        $data['resenas'] = $this->Resena_model->get_resenas_recientes();
        $data['usuario'] = $this->session->userdata('usuario');
        
        $this->load->view('resenas/recientes', $data);
    }
} 