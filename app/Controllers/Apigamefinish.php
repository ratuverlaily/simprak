<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Model_api_web;
use CodeIgniter\HTTP\Response;

class Apigamefinish extends ResourceController
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
        $validate = $this->validation->run($data, 'statusgames');
        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $id_user = $this->request->getPost('id_user');
        $id_praktikum = $this->request->getPost('id_praktikum');
        $kode_kelas = $this->request->getPost('kode_kelas');

        $cek_status = $this->Model_api_web->cek_status_games($id_user, $id_praktikum, $kode_kelas);

        if ($cek_status) {
            $data = array(
                'game_selesai' => 1,
            );

            $where = array(
                'id_user' => $id_user,
                'id_praktikum' => $id_praktikum,
                'kode_kelas' =>  $kode_kelas,
            );

            $this->Model_api_web->update_status_games($data, $where);
            $berhasil['status'] = "1";
            $berhasil['success'] = "Berhasil Di Update Status Game !";
            return $this->respond($berhasil);
        } else {

            $berhasil['status'] = "0";
            $berhasil['error'] = "Mohon maaf anda terajadi kesalahan sistem segera hub developer !";
            return $this->respond($berhasil);
        }
    }
}
