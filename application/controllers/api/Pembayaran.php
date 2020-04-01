<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pembayaran extends REST_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bayar_model', 'bayar');
        
    }
    

    public function index_get()
    {
        $id = $this->get('idbayar');
        if ($id === null) {
            $bayar = $this->bayar->getBayar();
        } else {
            $bayar = $this->bayar->getBayar($id);
        }

        if ($bayar)
            {
                $this->response([
                    'status' => TRUE,
                    'data' => $bayar
                ], REST_Controller::HTTP_OK); 
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'idbayar tidak ditemukan'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
    }

    public function index_delete()
    {
        $id = $this->delete('idbayar');
        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'masukkan id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->bayar->deleteBayar($id)>0) {
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
            'idobjekpajakfk' => $this->post('idobjekpajakfk'),
            'idpetugasfk' => $this->post('idpetugaspajakfk'),
            'idnpwpfk' => $this->post('idnpwpfk')
        ];

        if ($this->bayar->createbayar($data)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'data telah ditambahkan'
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
        $id = $this->put('idbayar');
        $data = [
            'idobjekpajakfk' => $this->put('idobjekpajakfk'),
            'idpetugasfk' => $this->put('idpetugaspajakfk'),
            'idnpwpfk' => $this->put('idnpwpfk'),
            'tanggal' => $this->put('tanggal')
        ];

        if ($this->bayar->updateBayar($data, $id)>0) {
            $this->response([
                'status' => TRUE,
                'message' => 'data bayar telah diubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'gagal diubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}

/* End of file Pembayaran.php */

?>