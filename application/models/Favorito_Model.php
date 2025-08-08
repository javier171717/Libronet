<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorito_Model extends CI_Model {

    private $table = 'favoritos';

    public function es_favorito($usuario_id, $libro_id) {
        return $this->db->where('usuario_id', $usuario_id)
                        ->where('libro_id', $libro_id)
                        ->count_all_results($this->table) > 0;
    }

    public function agregar($usuario_id, $libro_id) {
        if ($this->es_favorito($usuario_id, $libro_id)) {
            return TRUE;
        }
        return $this->db->insert($this->table, [
            'usuario_id' => $usuario_id,
            'libro_id' => $libro_id,
            'creado_en' => date('Y-m-d H:i:s')
        ]);
    }

    public function eliminar($usuario_id, $libro_id) {
        return $this->db->where('usuario_id', $usuario_id)
                        ->where('libro_id', $libro_id)
                        ->delete($this->table);
    }

    public function contar_por_libro($libro_id) {
        return $this->db->where('libro_id', $libro_id)
                        ->count_all_results($this->table);
    }

    public function contar_para_libros($libro_ids) {
        if (empty($libro_ids)) return [];
        $this->db->select('libro_id, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where_in('libro_id', $libro_ids);
        $this->db->group_by('libro_id');
        $rows = $this->db->get()->result();
        $map = [];
        foreach ($rows as $row) {
            $map[$row->libro_id] = (int)$row->total;
        }
        return $map;
    }

    public function obtener_ids_libros_favoritos($usuario_id) {
        $rows = $this->db->select('libro_id')
                         ->from($this->table)
                         ->where('usuario_id', $usuario_id)
                         ->get()->result();
        return array_map(function($r) { return (int)$r->libro_id; }, $rows);
    }

    public function obtener_favoritos_usuario($usuario_id) {
        $this->db->select('l.*');
        $this->db->from($this->table . ' f');
        $this->db->join('libros l', 'l.id = f.libro_id');
        $this->db->where('f.usuario_id', $usuario_id);
        $this->db->order_by('f.creado_en', 'DESC');
        return $this->db->get()->result();
    }
} 