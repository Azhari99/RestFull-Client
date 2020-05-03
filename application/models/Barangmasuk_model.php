<?php

class Barangmasuk_model extends CI_Model
{
    public function getBarangmasuk($id = null)
    {
        if ($id === null) {
            return $this->db->get('tbl_barang_masuk')->result_array();
        } else {
            return $this->db->get_where('tbl_barang_masuk', ['id_barang_masuk' => $id])->result_array();
        }
    }

    public function deleteBarangmasuk($id)
    {
        $this->db->delete('tbl_barang_masuk', ['id_barang_masuk' => $id]);
        return $this->db->affected_rows();
    }

    public function createBarangmasuk($data)
    {
        $this->db->insert('tbl_barang_masuk', $data);
        return $this->db->affected_rows();
    }

    public function updateBarangmasuk($data, $id)
    {
        $this->db->update('tbl_barang_masuk', $data, ['id_barang_masuk' => $id]);
        return $this->db->affected_rows();
    }
}