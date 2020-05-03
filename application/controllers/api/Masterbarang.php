<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Masterbarang extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MasterBarang_model', 'masterbarang');
    }
    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {

            $masterBarang = $this->masterbarang->getMasterBarang();
        } else {

            $masterBarang = $this->masterbarang->getMasterBarang($id);
        }

        if ($masterBarang) {

            $this->response([
                'status' => true,
                'data' => $masterBarang
            ], REST_Controller::HTTP_OK);
        } else {

            $this->response([
                'status' => false,
                'message' => 'id not found!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            if ($this->masterbarang->deleteMasterbarang($id) > 0) {

                $this->response([
                    'status' => false,
                    'id' => $id,
                    'message' => 'deleted!'
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            } else {

                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'kode_barang' => $this->post('kode_barang'),
            'jenis_logistik' => $this->post('jenis_logistik'),
            'id_kategori' => $this->post('id_kategori'),
            'nama_barang' => $this->post('nama_barang'),
            'tgl' => $this->post('tgl'),
            'keterangan' => $this->post('keterangan'),
            'stat' => $this->post('stat')
        ];

        if ($this->masterbarang->createMasterbarang($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new master barang has been created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to created new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');

        $data = [
            'kode_barang' => $this->put('kode_barang'),
            'jenis_logistik' => $this->put('jenis_logistik'),
            'id_kategori' => $this->put('id_kategori'),
            'nama_barang' => $this->put('nama_barang'),
            'tgl' => $this->put('tgl'),
            'keterangan' => $this->put('keterangan'),
            'stat' => $this->put('stat')
        ];

        if ($this->masterbarang->UpdateMasterbarang($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new master barang has been Updated.'
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }
}
