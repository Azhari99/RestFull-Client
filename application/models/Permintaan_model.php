<?php

class Permintaan_model extends CI_Model
{
    public function updatePermintaan($data, $documentno)
    {
        $this->db->update('tbl_permintaan', $data, ['documentno' => $documentno]);
        return $this->db->affected_rows();
    }
}