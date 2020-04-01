<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wajib_model extends CI_Model {

    public function getWajib($id = null)
    {
        if ($id === null) {
            return $this->db->get('wajibpajak')->result_array();
        } else {
            return $this->db->get_where('wajibpajak', ['idnpwp' => $id])->result_array();
        }
    }

    public function deleteWajib($id)
    {
        $this->db->delete('wajibpajak', ['idnpwp' => $id]);
        return $this->db->affected_rows();
        
    }

    public function createWajib($data)
    {
        $this->db->insert('wajibpajak', $data);
        return $this->db->affected_rows();
    }

    public function updateWajib($data, $idnpwp)
    {
        $this->db->update('wajibpajak', $data, ['idnpwp' => $idnpwp]);
        return $this->db->affected_rows();
    }

}

/* End of file Wajib_model.php */

?>