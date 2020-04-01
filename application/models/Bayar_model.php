<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar_model extends CI_Model {

    public function getBayar($id = null)
    {

        if ($id === null) {

            $this->db->select('pembayaran.*,pembayaran.idbayar,wajibpajak.nama,objekpajak.nomorplat,petugaspajak.namapetugas,objekpajak.besarpajak');
            $this->db->join('wajibpajak', 'wajibpajak.idnpwp = pembayaran.idnpwpfk');
            $this->db->join('objekpajak', 'objekpajak.idobjekpajak = pembayaran.idobjekpajakfk');
            $this->db->join('petugaspajak', 'petugaspajak.idpetugas = pembayaran.idpetugasfk');
        
            return $this->db->get('pembayaran')->result_array();
        } else {
            $this->db->select('pembayaran.*,pembayaran.idbayar,wajibpajak.nama,objekpajak.nomorplat,petugaspajak.namapetugas,objekpajak.besarpajak');
		    $this->db->join('wajibpajak', 'wajibpajak.idnpwp = pembayaran.idnpwpfk');
		    $this->db->join('objekpajak', 'objekpajak.idobjekpajak = pembayaran.idobjekpajakfk');
            $this->db->join('petugaspajak', 'petugaspajak.idpetugas = pembayaran.idpetugasfk');
            
            return $this->db->get_where('pembayaran', ['idbayar' => $id])->result_array();
        }
    }

    public function deleteBayar($id)
    {
        $this->db->delete('pembayaran', ['idbayar' => $id]);
        return $this->db->affected_rows();
    }

    public function createBayar($data)
    {
        $this->db->insert('pembayaran', $data);
        return $this->db->affected_rows();
    }

    public function updateBayar($data, $id)
    {
        $this->db->update('pembayaran', $data, ['idbayar' => $id]);
        return $this->db->affected_rows();
    }

}

/* End of file Bayar_model.php */


?>