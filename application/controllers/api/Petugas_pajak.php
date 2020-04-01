<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Petugas_pajak extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Petugas_model', 'petugas');
        
    }
    
    public function index_get()
    {
        $id = $this->get('idpetugas');

        if ($id === null) {
            $petugas = $this->petugas->getPetugas();
        } else {
            $petugas = $this->petugas->getpetugas($id);
        }

        if ($petugas)
            {
                $this->response([
                    'status' => TRUE,
                    'data' => $petugas
                ], REST_Controller::HTTP_OK); 
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'petugas tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
    }

    public function index_delete()
    {
        $id = $this->delete('idpetugas');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'masukkan id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->petugas->deletePetugas($id)>0) {
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'terhapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'idpetugas pajak tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'namapetugas' => $this->post('namapetugas'),
            'alamat' => $this->post('alamat'),
            'notelp' => $this->post('notelp'),
            'password' => $this->post('password'),
            'level' => $this->post('level')
        ];

        if ($this->petugas->createPetugas($data)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'petugas telah ditambahkan'
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
        $id = $this->put('idpetugas');
        $data = [
            'namapetugas' => $this->put('namapetugas'),
            'alamat' => $this->put('alamat'),
            'notelp' => $this->put('notelp'),
            'password' => $this->put('password'),
            'level' => $this->put('level')
        ];

        if ($this->petugas->updatePetugas($data, $id)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'data petugas telah diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'gagal diubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}

/* End of file Petugas_pajak.php */


?>