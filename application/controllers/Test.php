<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(['Resena_model', 'Libro_Model']);
    }
    
    public function index() {
        echo "<h1>Test de Sistema</h1>";
        
        // Verificar sesión
        $usuario = $this->session->userdata('usuario');
        if ($usuario) {
            echo "<p style='color: green;'>✅ Usuario logueado: " . $usuario->nombre . "</p>";
            echo "<p><a href='" . base_url('libros') . "'>Ir a Libros</a></p>";
        } else {
            echo "<p style='color: red;'>❌ No hay usuario logueado</p>";
            echo "<p><a href='" . base_url('auth/login') . "'>Ir a Login</a></p>";
            return;
        }
        
        // Probar estadísticas
        $this->test_estadisticas();
    }
    
    public function test_estadisticas() {
        echo "<h2>Test de Estadísticas de Reseñas</h2>";
        
        // Obtener primer libro
        $libros = $this->Libro_Model->obtener_libros();
        if (!$libros) {
            echo "<p style='color: red;'>❌ No hay libros en la base de datos</p>";
            return;
        }
        
        $primer_libro = $libros[0];
        echo "<p>Probando estadísticas para: <strong>" . $primer_libro->titulo . "</strong></p>";
        
        // Obtener estadísticas
        $estadisticas = $this->Resena_model->get_estadisticas_libro($primer_libro->id);
        
        if ($estadisticas) {
            echo "<h3>Estadísticas Obtenidas:</h3>";
            echo "<pre>";
            print_r($estadisticas);
            echo "</pre>";
            
            echo "<h3>Propiedades Disponibles:</h3>";
            echo "<ul>";
            echo "<li>total_resenas: " . ($estadisticas->total_resenas ?? 'NO DEFINIDA') . "</li>";
            echo "<li>promedio_calificacion: " . ($estadisticas->promedio_calificacion ?? 'NO DEFINIDA') . "</li>";
            echo "<li>cinco_estrellas: " . ($estadisticas->cinco_estrellas ?? 'NO DEFINIDA') . "</li>";
            echo "<li>cuatro_estrellas: " . ($estadisticas->cuatro_estrellas ?? 'NO DEFINIDA') . "</li>";
            echo "<li>tres_estrellas: " . ($estadisticas->tres_estrellas ?? 'NO DEFINIDA') . "</li>";
            echo "<li>dos_estrellas: " . ($estadisticas->dos_estrellas ?? 'NO DEFINIDA') . "</li>";
            echo "<li>una_estrella: " . ($estadisticas->una_estrella ?? 'NO DEFINIDA') . "</li>";
            echo "</ul>";
            
            echo "<p><a href='" . base_url('libros/resenas/' . $primer_libro->id) . "' target='_blank'>📋 Ver Todas las Reseñas</a></p>";
        } else {
            echo "<p style='color: red;'>❌ No se pudieron obtener estadísticas</p>";
        }
    }
} 