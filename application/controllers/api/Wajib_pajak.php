<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Wajib_pajak extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Wajib_model', 'wajib');
        
    }

    public function index_get()
    {
        $id = $this->get('idnpwp');

        if ($id === null) {
            $wajib = $this->wajib->getWajib();
        } else {
            $wajib = $this->wajib->getWajib($id);
        }

        if ($wajib)
            {
                $this->response([
                    'status' => TRUE,
                    'data' => $wajib
                ], REST_Controller::HTTP_OK); 
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'wajib pajak tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
    }
    
    public function index_delete()
    {
        $id = $this->delete('idnpwp');

        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'masukkan id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->wajib->deleteWajib($id)>0) {
                $this->response([
                    'status' => TRUE,
                    'id' => $id,
                    'message' => 'terhapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'id npwp pajak tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'idobjekpajakfk' => $this->post('idobjekpajakfk'),
            'namalengkap' => $this->post('namalengkap'),
            'alamat' => $this->post('alamat'),
            'notelp' => $this->post('notelp'),
            'password' => $this->post('password')
        ];

        if ($this->wajib->createWajib($data)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'data wajib telah ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'data gagal ditambahkan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $idnpwp = $this->put('idnpwp');
        $data = [
            'nama' => $this->put('nama'),
            'idobjekpajakfk' => $this->put('idobjekpajakfk'),
            'namalengkap' => $this->put('namalengkap'),
            'alamat' => $this->put('alamat'),
            'notelp' => $this->put('notelp'),
            'password' => $this->put('password')
        ];

        if ($this->wajib->updateWajib($data, $idnpwp)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'data wajib telah diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'data gagal diubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}


?>