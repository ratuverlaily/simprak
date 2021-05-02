<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Model_api_web;
use CodeIgniter\HTTP\Response;

class Apiposttest extends ResourceController
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
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'pos_test');
        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $id_user = $this->request->getPost('id_user');
        $id_praktikum = $this->request->getPost('id_praktikum');
        $post_status = $this->request->getPost('post_status');
        $post_fault_counter = $this->request->getPost('post_fault_counter');
        $post_waktu_pengerjaan = $this->request->getPost('post_waktu_pengerjaan');

        $cek_penilaian = $this->Model_api_web->cek_data_value($id_user, $id_praktikum);

        if ($cek_penilaian) {
            $data = array(
                'post_status' => $post_status,
                'post_fault_counter' => $post_fault_counter,
                'post_waktu_pengerjaan' => $post_waktu_pengerjaan,
                'update_date' => date('d M Y H:i:s'),
            );

            $where = array(
                'id_user' => $id_user,
                'id_praktikum' => $id_praktikum,
            );

            $this->Model_api_web->update_post_test($data, $where);
            $berhasil['status'] = "1";
            $berhasil['success'] = "Data Post Test Berhasil Disimpan !";
            return $this->respond($berhasil);
        } else {
            $data = array(
                'id_user' => $id_user,
                'id_praktikum' => $id_praktikum,
                'post_status' => $post_status,
                'post_fault_counter' => $post_fault_counter,
                'post_waktu_pengerjaan' => $post_waktu_pengerjaan,
                'create_date' => date('d M Y H:i:s'),
            );
            $this->Model_api_web->insert_post_test($data);
            $berhasil['status'] = "1";
            $berhasil['success'] = "Data Post Test Berhasil Disimpan !";
            return $this->respond($berhasil);
        }
    }
}
