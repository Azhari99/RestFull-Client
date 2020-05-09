<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Permintaan extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permintaan_model', 'permintaan');
    }

    public function index_put()
    {
        $documentno = $this->put('documentno');

        $data = [
            'status' => $this->put('status')
        ];

        if ($this->permintaan->updatePermintaan($data, $documentno) > 0) {
            $this->response([
                'statusRes' => true,
                'message' => 'new master barang has been Updated.'
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        } else {
            $this->response([
                'statusRes' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }
}
