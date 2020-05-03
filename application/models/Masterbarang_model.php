<?php

class Masterbarang_model extends CI_Model
{
    public function getMasterBarang($id = null)
    {
        if ($id === null) {
            return $this->db->get('tbl_barang')->result_array();
        } else {
            return $this->db->get_where('tbl_barang', ['id_barang' => $id])->result_array();
        }
    }

    public function deleteMasterbarang($id)
    {
        $this->db->delete('tbl_barang', ['id_barang' => $id]);
        return $this->db->affected_rows();
    }

    public function createMasterbarang($data)
    {
        $this->db->insert('tbl_barang', $data);
        return $this->db->affected_rows();
    }

    public function UpdateMasterbarang($data, $id)
    {
        $this->db->update('tbl_barang', $data, ['id_barang' => $id]);
        return $this->db->affected_rows();
    }
}