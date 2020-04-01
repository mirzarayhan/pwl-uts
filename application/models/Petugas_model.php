<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model {

    public function getPetugas($id = null)
    {
        if ($id === null) {
            return $this->db->get('petugaspajak')->result_array();
        } else {
            return $this->db->get_where('petugaspajak', ['idpetugas' => $id])->result_array();
        }
    }

    public function deletePetugas($id)
    {
        $this->db->delete('petugaspajak', ['idpetugas' => $id]);
        return $this->db->affected_rows();
        
    }

    public function createPetugas($data)
    {
        $this->db->insert('petugaspajak', $data);
        return $this->db->affected_rows();
    }

    public function updatePetugas($data, $id)
    {
        $this->db->update('petugaspajak', $data, ['idpetugas' => $id]);
        return $this->db->affected_rows();
    }

}

/* End of file Petugas_model.php */

?>