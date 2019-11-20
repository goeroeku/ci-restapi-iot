<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Iot extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Iot_model','iot');
	}

    public function baca_get() {
        $alat = $this->get('alat');
        if ($alat==null) {
            $data= $this->iot->get();
        }
        else {
            $all = $this->get('all');
            if ($all==null){
                $data= $this->iot->get($alat);
            }
            else {
                $data= $this->iot->get($alat,$all);
            }
        }
        if ($data) {
            $this->response([
                'status' => true,
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        }
        else {
            $this->response([
                'status' => false,
                'message' => 'data not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
	}

    public function tambah_post() {
        $data = [
            'alat' => $this->post('alat'),
            'nilai' => $this->post('nilai')
        ];
        if ($this->iot->add($data)>0) {
            $this->response([
                'status' => true,
                'message' => 'Added a resource'
            ], REST_Controller::HTTP_CREATED);
        }
        else {
            $this->response([
                'status' => false,
                'message' => 'Added a resource'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
