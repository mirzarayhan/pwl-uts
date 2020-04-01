<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Objek_pajak extends REST_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Objek_model', 'objek');
        
    }
    

    public function index_get()
    {
        $id = $this->get('idobjekpajak');
        if ($id === null) {
            $objek = $this->objek->getObjek();
        } else {
            $objek = $this->objek->getObjek($id);
        }

        if ($objek) {
            $this->response([
                'status' => true,
                'data' => $objek
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        $idobjekpajak = $this->delete('idobjekpajak');

        if ($idobjekpajak === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'masukkan id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->objek->deleteObjek($idobjekpajak)>0) {
                $this->response([
                    'status' => TRUE,
                    'id' => $idobjekpajak,
                    'message' => 'terhapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'id objek pajak tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'merk' => $this->post('merk'),
            'nomorplat' => $this->post('nomorplat'),
            'jeniskendaraan' => $this->post('jeniskendaraan'),
            'besarpajak' => $this->post('besarpajak'),
            'warna' => $this->post('warna'),
            'tahun' => $this->post('tahun'),
            'masa_stnk' => $this->post('masa_stnk')
        ];

        if ($this->objek->createObjek($data)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'objek telah ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'gagal ditambahkan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('idobjekpajak');
        $data = [
            'merk' => $this->put('merk'),
            'nomorplat' => $this->put('nomorplat'),
            'jeniskendaraan' => $this->put('jeniskendaraan'),
            'besarpajak' => $this->put('besarpajak'),
            'warna' => $this->put('warna'),
            'tahun' => $this->put('tahun'),
            'masa_stnk' => $this->put('masa_stnk')
        ];

        if ($this->objek->updateObjek($data, $id)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'objek telah diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'gagal diubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}

/* End of file Objek_pajak.php */


?>