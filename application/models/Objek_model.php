<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Objek_model extends CI_Model {
    public function getObjek($id = null)
    {
        if ($id === null) {
            return $this->db->get('objekpajak')->result_array();
            ;
        } else {
            return $this->db->get_where('objekpajak', ['idobjekpajak' => $id])->result_array();

        }
    }

    public function deleteObjek($idobjekpajak)
    {
        $this->db->delete('objekpajak', ['idobjekpajak' => $idobjekpajak]);
        return $this->db->affected_rows();
        
    }

    public function createObjek($data)
    {
        $this->db->insert('objekpajak', $data);
        return $this->db->affected_rows();
    }

    public function updateObjek($data, $id)
    {
        $this->db->update('objekpajak', $data, ['idobjekpajak' => $id]);
        return $this->db->affected_rows();
    }
}

/* End of file Objek_model.php */
