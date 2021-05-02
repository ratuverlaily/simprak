<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Model_api_web;
use CodeIgniter\HTTP\Response;

class Apipretest extends ResourceController
{
    protected $format = 'json';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->Model_api_web = new Model_api_web();
    }

    public function index()
    {
    }

    public function create()
    {
        $token = $this->request->getPost('token');
        $gettoken = $this->Model_api_web->cektoken();


        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'pre_test');
        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $id_user = $this->request->getPost('id_user');
        $id_praktikum = $this->request->getPost('id_praktikum');
        $pre_status = $this->request->getPost('pre_status');
        $pre_fault_counter = $this->request->getPost('pre_fault_counter');
        $pre_waktu_games = $this->request->getPost('pre_waktu_games');

        $cek_penilaian = $this->Model_api_web->cek_data_value($id_user, $id_praktikum);

        if ($cek_penilaian) {
            $data = array(
                'pre_status' => $pre_status,
                'pre_fault_counter' => $pre_fault_counter,
                'pre_waktu_games' => $pre_waktu_games,
                'update_date' => date('d M Y H:i:s'),
            );

            $where = array(
                'id_user' => $id_user,
                'id_praktikum' => $id_praktikum,
            );

            $this->Model_api_web->update_pre_test($data, $where);
            $berhasil['status'] = "1";
            $berhasil['success'] = "Data Pre Test Berhasil Disimpan !";
            return $this->respond($berhasil);
        } else {
            $data = array(
                'id_user' => $id_user,
                'id_praktikum' => $id_praktikum,
                'pre_status' => $pre_status,
                'pre_fault_counter' => $pre_fault_counter,
                'pre_waktu_games' => $pre_waktu_games,
                'create_date' => date('d M Y H:i:s'),
            );
            $this->Model_api_web->insert_pre_test($data);
            $berhasil['status'] = "1";
            $berhasil['success'] = "Data Pre Test Berhasil Disimpan !";
            return $this->respond($berhasil);
        }
    }
}
