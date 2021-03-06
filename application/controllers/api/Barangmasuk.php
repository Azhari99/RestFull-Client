<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Barangmasuk extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barangmasuk_model', 'barangmasuk');
    }
    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {

            $barangmasuk = $this->barangmasuk->getBarangmasuk();
        } else {

            $barangmasuk = $this->barangmasuk->getBarangmasuk($id);
        }

        if ($barangmasuk) {

            $this->response([
                'status' => true,
                'data' => $barangmasuk
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

            if ($this->barangmasuk->deleteBarangmasuk($id) > 0) {

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
            'nama_barang' => $this->post('nama_barang'),
            'instansi' => $this->post('instansi'),
            'jumlah' => $this->post('jumlah'),
            'documentno' => $this->post('documentno'),
            'unitprice' => $this->post('unitprice'),
            'amount' => $this->post('amount'),
            'tgl_barang_masuk' => $this->post('tgl_barang_masuk'),
            'keterangan' => $this->post('keterangan'),
            'stat' => $this->post('stat'),
            'pathDownload' => $this->post('pathDownload'),
            'jenis_id' => $this->post('jenis_id'),
            'kategori_id' => $this->post('kategori_id')
        ];

        if ($this->barangmasuk->createBarangmasuk($data) > 0) {
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
            'nama_barang' => $this->put('nama_barang'),
            'instansi' => $this->put('instansi'),
            'jumlah' => $this->put('jumlah'),
            'documentno' => $this->put('documentno'),
            'unitprice' => $this->put('unitprice'),
            'amount' => $this->put('amount'),
            'tgl_barang_masuk' => $this->put('tgl_barang_masuk'),
            'keterangan' => $this->put('keterangan'),
            'stat' => $this->put('stat'),
            'pathDownload' => $this->put('pathDownload'),
            'jenis_id' => $this->post('jenis_id'),
            'kategori_id' => $this->post('kategori_id')
        ];

        if ($this->barangmasuk->updateBarangmasuk($data, $id) > 0) {
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
