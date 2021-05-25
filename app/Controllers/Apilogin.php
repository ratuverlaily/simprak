<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Model_api_web;
use App\Models\Mauth;
use CodeIgniter\HTTP\Response;

class Apilogin extends ResourceController
{
    protected $format = 'json';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->Model_api_web = new Model_api_web();
    }

    public function index()
    {
        $data = $this->Model_api_web->get_users();
        return $this->respond($data);
    }

    public function create()
    {
        //$data = $this->request->getPost();
        //$validate = $this->validation->run($data, 'login_user');

        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $kode_praktikum = $this->request->getPost('kode_praktikum');

        $this->Mauth = new Mauth();
        $cek = $this->Mauth->login($email, $password);
        if ($cek) {
            $id_user = $cek['id'];
            $getidprak = $this->Model_api_web->praktikumid($kode_praktikum);

            if ($getidprak) {
                $id_praktikum = $getidprak->id_praktikum;

                $cekstatusprak = $this->Model_api_web->get_statusgames_praktikum($id_user, $id_praktikum);
                if ($cekstatusprak) {
                    if ($cekstatusprak->game_selesai == 1) {
                        $error['status'] = "4";
                        $error['massage'] = "Maaf tidak bisa login kembali karena status anda sudah selesai pada praktikum ini !";
                        return $this->respond($error);
                    } else {
                        $getdata['username'] = $cek['username'];
                        $getdata['id_user'] = $id_user;
                        $getdata['id_praktikum'] = $id_praktikum;
                        $getdata['id_games'] = $getidprak->id_games;
                        $getdata['judul_games'] = $getidprak->judul;
                        $getdata['kode_kelas'] = $cekstatusprak->kode_kelas;
                        $getdata['status'] = "5";
                        $getdata['massage'] = "login berhasil";
                        return $this->respond($getdata);
                    }
                } else {
                    $error['status'] = "3";
                    $error['error'] = "Maaf tidak bisa masuk, Silahkan cek kode praktikum anda pada sistem !";
                    return $this->respond($error);
                }
            } else {
                $error['status'] = "2";
                $error['error'] = "Kode Praktikum Salah !";
                return $this->respond($error);
            }
        } else {
            $error['status'] = "1";
            $error['error'] = "Maaf Username dan Password Anda Salah !";
            return $this->respond($error);
        }
    }
}
