<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Model_api_web;
use CodeIgniter\HTTP\Response;

class Apigames extends ResourceController
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
        $validate = $this->validation->run($data, 'valgames');
        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $token = $this->request->getPost('token');
        $gettoken = $this->Model_api_web->cektoken($token);

        if ($gettoken) {
            $id_user = $this->request->getPost('id_user');
            $id_praktikum = $this->request->getPost('id_praktikum');
            $post_status = $this->request->getPost('post_status');
            $post_fault_counter = $this->request->getPost('post_fault_counter');
            $post_waktu_pengerjaan = $this->request->getPost('post_waktu_pengerjaan');
            $pre_status = $this->request->getPost('pre_status');
            $pre_fault_counter = $this->request->getPost('pre_fault_counter');
            $pre_waktu_games = $this->request->getPost('pre_waktu_games');
            $expe_waktu_pengerjaan = $this->request->getPost('expe_waktu_pengerjaan');
            $expe_status = $this->request->getPost('expe_status');

            $cek_penilaian = $this->Model_api_web->cek_data_value($id_user, $id_praktikum);

            $db = db_connect();
            $db->transStart();

            if ($cek_penilaian) {
                $data = array(
                    'pre_waktu_games' => $pre_waktu_games,
                    'pre_fault_counter' => $pre_fault_counter,
                    'pre_status' => $pre_status,
                    'post_status' => $post_status,
                    'post_fault_counter' => $post_fault_counter,
                    'post_waktu_pengerjaan' => $post_waktu_pengerjaan,
                    'expe_status' => $expe_status,
                    'expe_waktu_pengerjaan' => $expe_waktu_pengerjaan,
                    'update_date' => date("Y-m-d H:i:s"),
                );

                $where = array(
                    'id_user' => $id_user,
                    'id_praktikum' => $id_praktikum,
                );
                $db->table('praktikum_getvalue')->update($data, $where);
            } else {
                $data = array(
                    'id_user' => $id_user,
                    'id_praktikum' => $id_praktikum,
                    'pre_waktu_games' => $pre_waktu_games,
                    'pre_fault_counter' => $pre_fault_counter,
                    'pre_status' => $pre_status,
                    'post_status' => $post_status,
                    'post_fault_counter' => $post_fault_counter,
                    'post_waktu_pengerjaan' => $post_waktu_pengerjaan,
                    'expe_status' => $expe_status,
                    'expe_waktu_pengerjaan' => $expe_waktu_pengerjaan,
                    'create_date' =>  date("Y-m-d H:i:s"),
                );
                $db->table('praktikum_getvalue')->insert($data);
            }
            $wherestatugames = array(
                'id_user' => $id_user,
                'id_praktikum' => $id_praktikum,
            );

            $datastatusgames = array(
                'game_selesai' => 1,
                'update_date' => date('d M Y H:i:s'),
            );
            $db->table('praktikum_status_games')->update(array('game_selesai' => 1), $wherestatugames);

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                # Something went wrong.
                $db->transRollback();
                $error['status'] = "0";
                $error['error'] = "Maaf Praktikum Test tidak berhasil disimpan !";
                return $this->respond($error);
            } else {
                # Everything is Perfect. 
                # Committing data to the database.
                $db->transCommit();
                $berhasil['status'] = "1";
                $berhasil['success'] = "Data test praktikum berhasil disimpan !";
                return $this->respond($berhasil);
            }

            $db->close();
        } else {
            $error['status'] = "0";
            $error['error'] = "Maaf Praktikum Test tidak dapat di akses !";
            return $this->respond($error);
        }
    }
}
