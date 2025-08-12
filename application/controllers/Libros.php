<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Libro_Model', 'Usuario_Model', 'Favorito_Model', 'Resena_model']);
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
        
        // Verificar si el usuario está logueado
        if (!$this->session->userdata('usuario')) {
            redirect('auth/login');
        }
    }

    // Página principal del catálogo
    public function index() {
        $data['libros'] = $this->Libro_Model->obtener_libros();
        $data['total_libros'] = $this->Libro_Model->contar_libros();
        $data['usuario'] = $this->session->userdata('usuario');

        // Contadores e IDs de favoritos
        $libroIds = array_map(function($l){ return $l->id; }, $data['libros']);
        $data['favoritos_count'] = $this->Favorito_Model->contar_para_libros($libroIds);
        $data['mis_favoritos_ids'] = $this->Favorito_Model->obtener_ids_libros_favoritos($data['usuario']->id);
        
        $this->load->view('libros/catalogo', $data);
    }

    // Formulario para agregar libro
    public function agregar() {
        $data['usuario'] = $this->session->userdata('usuario');
        $this->load->view('libros/agregar', $data);
    }

    // Procesar agregar libro
    public function guardar() {
        $this->form_validation->set_rules('titulo', 'Título', 'required|trim');
        $this->form_validation->set_rules('autor', 'Autor', 'required|trim');
        $this->form_validation->set_rules('genero', 'Género', 'required|trim');
        $this->form_validation->set_rules('anio', 'Año', 'required|numeric');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $data['usuario'] = $this->session->userdata('usuario');
            $this->load->view('libros/agregar', $data);
        } else {
            $data = [
                'titulo' => $this->input->post('titulo'),
                'autor' => $this->input->post('autor'),
                'genero' => $this->input->post('genero'),
                'anio' => $this->input->post('anio'),
                'descripcion' => $this->input->post('descripcion'),
                'contenido_completo' => $this->input->post('contenido_completo'),
                'fecha_agregado' => date('Y-m-d H:i:s')
            ];

            // Insertar el libro primero para obtener el ID
            if ($this->Libro_Model->agregar_libro($data)) {
                $id_libro = $this->db->insert_id();
                
                // Procesar imagen si se subió
                if (!empty($_FILES['imagen']['name'])) {
                    $nombre_imagen = $this->Libro_Model->subir_imagen('imagen', $id_libro);
                    if ($nombre_imagen) {
                        // Actualizar el libro con el nombre de la imagen
                        $this->Libro_Model->actualizar_libro($id_libro, ['imagen' => $nombre_imagen]);
                    }
                }
                
                $this->session->set_flashdata('mensaje', 'Libro agregado exitosamente');
                redirect('libros');
            } else {
                $this->session->set_flashdata('error', 'Error al agregar el libro');
                redirect('libros/agregar');
            }
        }
    }

    // Ver detalles de un libro
    public function ver($id) {
        $data['libro'] = $this->Libro_Model->obtener_libro($id);
        $data['usuario'] = $this->session->userdata('usuario');
        
        if (!$data['libro']) {
            show_404();
        }
        
        // Datos de favoritos para el usuario actual
        $data['mis_favoritos_ids'] = $this->Favorito_Model->obtener_ids_libros_favoritos($data['usuario']->id);
        
        // Datos de reseñas para el libro
        $data['resenas'] = $this->Resena_model->get_resenas_libro($id, 5); // Solo las 5 más recientes
        $data['estadisticas'] = $this->Resena_model->get_estadisticas_libro($id);
        
        // Verificar si el usuario ya tiene una reseña para este libro
        $data['resena_usuario'] = $this->Resena_model->get_resena_usuario($id, $data['usuario']->id);
        
        // Obtener likes para cada reseña
        $data['likes_resena'] = [];
        $data['usuario_dio_like'] = [];
        foreach ($data['resenas'] as $resena) {
            $data['likes_resena'][$resena->id] = $this->Resena_model->get_likes_resena($resena->id);
            $data['usuario_dio_like'][$resena->id] = $this->Resena_model->usuario_dio_like($resena->id, $data['usuario']->id);
        }
        
        $this->load->view('libros/detalle', $data);
    }

    // Formulario para editar libro
    public function editar($id) {
        $data['libro'] = $this->Libro_Model->obtener_libro($id);
        $data['usuario'] = $this->session->userdata('usuario');
        
        if (!$data['libro']) {
            show_404();
        }
        
        // Verificar si el usuario es el propietario del libro
        if (!$this->Libro_Model->es_propietario($id, $data['usuario']->id)) {
            $this->session->set_flashdata('error', 'No tienes permiso para editar este libro');
            redirect('libros');
        }
        
        $this->load->view('libros/editar', $data);
    }

    // Procesar editar libro
    public function actualizar($id) {
        // Verificar si el usuario es el propietario del libro
        if (!$this->Libro_Model->es_propietario($id, $this->session->userdata('usuario')->id)) {
            $this->session->set_flashdata('error', 'No tienes permiso para editar este libro');
            redirect('libros');
            return;
        }

        $this->form_validation->set_rules('titulo', 'Título', 'required|trim');
        $this->form_validation->set_rules('autor', 'Autor', 'required|trim');
        $this->form_validation->set_rules('genero', 'Género', 'required|trim');
        $this->form_validation->set_rules('anio', 'Año', 'required|numeric');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == FALSE) {
            $data['libro'] = $this->Libro_Model->obtener_libro($id);
            $data['usuario'] = $this->session->userdata('usuario');
            $this->load->view('libros/editar', $data);
        } else {
            $data = [
                'titulo' => $this->input->post('titulo'),
                'autor' => $this->input->post('autor'),
                'genero' => $this->input->post('genero'),
                'anio' => $this->input->post('anio'),
                'descripcion' => $this->input->post('descripcion'),
                'contenido_completo' => $this->input->post('contenido_completo')
            ];

            // Procesar imagen si se subió
            if (!empty($_FILES['imagen']['name'])) {
                $nombre_imagen = $this->Libro_Model->subir_imagen('imagen', $id);
                if ($nombre_imagen) {
                    // Eliminar imagen anterior si existe
                    $libro_actual = $this->Libro_Model->obtener_libro($id);
                    if ($libro_actual && $libro_actual->imagen) {
                        $this->Libro_Model->eliminar_imagen($libro_actual->imagen);
                    }
                    $data['imagen'] = $nombre_imagen;
                }
            }

            if ($this->Libro_Model->actualizar_libro($id, $data)) {
                $this->session->set_flashdata('mensaje', 'Libro actualizado exitosamente');
                redirect('libros');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar el libro');
                redirect('libros/editar/' . $id);
            }
        }
    }

    // Eliminar libro
    public function eliminar($id) {
        // Verificar si el usuario es el propietario del libro
        if (!$this->Libro_Model->es_propietario($id, $this->session->userdata('usuario')->id)) {
            $this->session->set_flashdata('error', 'No tienes permiso para eliminar este libro');
            redirect('libros');
            return;
        }

        // Obtener información del libro antes de eliminarlo
        $libro = $this->Libro_Model->obtener_libro($id);
        
        if ($this->Libro_Model->eliminar_libro($id)) {
            // Eliminar imagen si existe
            if ($libro && $libro->imagen) {
                $this->Libro_Model->eliminar_imagen($libro->imagen);
            }
            $this->session->set_flashdata('mensaje', 'Libro eliminado exitosamente');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar el libro');
        }
        redirect('libros');
    }

    // Buscar libros
    public function buscar() {
        $termino = $this->input->get('q');
        
        if ($termino) {
            $data['libros'] = $this->Libro_Model->buscar_libros($termino);
            $data['termino'] = $termino;
        } else {
            $data['libros'] = $this->Libro_Model->obtener_libros();
            $data['termino'] = '';
        }
        
        $data['usuario'] = $this->session->userdata('usuario');
        $this->load->view('libros/buscar', $data);
    }

    // Filtrar por género
    public function genero($genero = '') {
        if ($genero) {
            $data['libros'] = $this->Libro_Model->obtener_por_genero($genero);
            $data['genero_actual'] = $genero;
        } else {
            $data['libros'] = $this->Libro_Model->obtener_libros();
            $data['genero_actual'] = '';
        }
        
        $data['usuario'] = $this->session->userdata('usuario');
        $this->load->view('libros/genero', $data);
    }

    // Leer contenido completo del libro
    public function leer($id) {
        $data['libro'] = $this->Libro_Model->obtener_libro($id);
        $data['usuario'] = $this->session->userdata('usuario');
        
        if (!$data['libro']) {
            show_404();
        }
        
        if (empty($data['libro']->contenido_completo)) {
            $this->session->set_flashdata('error', 'Este libro no tiene contenido completo disponible');
            redirect('libros/ver/' . $id);
        }
        
        $this->load->view('libros/leer', $data);
    }

    /**
     * Ver todas las reseñas de un libro
     */
    public function resenas($libro_id) {
        // Debug: Verificar datos de sesión
        error_log('Usuario en sesión: ' . print_r($this->session->userdata(), true));
        
        $data['libro'] = $this->Libro_Model->obtener_libro($libro_id);
        $data['usuario'] = $this->session->userdata('usuario');
        
        if (!$data['libro']) {
            show_404();
        }
        
        // Verificar que el usuario esté logueado
        if (!$data['usuario']) {
            redirect('auth/login');
            return;
        }
        
        // Obtener todas las reseñas del libro
        $data['resenas'] = $this->Resena_model->get_resenas_libro($libro_id, 50); // Hasta 50 reseñas
        $data['estadisticas'] = $this->Resena_model->get_estadisticas_libro($libro_id);
        
        // Obtener likes para cada reseña
        $data['likes_resena'] = [];
        $data['usuario_dio_like'] = [];
        foreach ($data['resenas'] as $resena) {
            $data['likes_resena'][$resena->id] = $this->Resena_model->get_likes_resena($resena->id);
            $data['usuario_dio_like'][$resena->id] = $this->Resena_model->usuario_dio_like($resena->id, $data['usuario']->id);
        }
        
        $this->load->view('resenas/lista', $data);
    }
} 