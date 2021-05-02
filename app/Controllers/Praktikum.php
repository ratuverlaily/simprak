<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Musers;
use App\Models\Mpraktikum;
use App\Models\Model_api_web;

class Praktikum extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Mpraktikum = new Mpraktikum();
    }

    public function index()
    {
    }

    /*----------------praktikum siswa --------------------------*/
    public function viewNilaiSiswaPraktikum()
    {
        $data['tampildata'] = $this->Mpraktikum->getpraktikum();

        return view('t_siswa/Spraktikumhasil', $data);
    }

    public function praktikum_getkode($id)
    {
        $id_praktikum = $this->Mpraktikum->decrypt($id);

        $get_status_prak = $this->Mpraktikum->status_games($id_praktikum);
        if (empty($get_status_prak)) {
            $data = array(
                'id_praktikum' => $id_praktikum,
                'id_user' => session()->get('id'),
                'kode_kelas' => session()->get('kode_kelas'),
                'game_selesai' => 0,
                'create_date' => date("Y-m-d h:i:sa"),
            );
            $this->Mpraktikum->insert_status_games($data);
        }

        $datapraktikum = $this->Mpraktikum->getKodePraktikum($id_praktikum);
        $data['kode_praktikum'] =  $datapraktikum->kode_praktikum;

        return view('t_siswa/Spraktikumgames', $data);
    }

    public function praktikumdetail($id = false)
    {
        $data = $this->Mpraktikum->getdetailpraktikum($id);
        $hasil['tampildata'] = $data;

        $this->Model_api_web = new Model_api_web();
        $hasil['praktikum'] = array(
            "id_praktikum" => $this->Mpraktikum->encrypt($data->id_praktikum),
        );

        return view('t_siswa/Spraktikum_detail', $hasil);
    }

    public function getpraktikumkelas()
    {
        $data['praktikums'] = $this->Mpraktikum->getpraktikumkelas();

        return view('t_siswa/Spraktikum', $data);
    }

    /* ========================== praktikum guru ============================== */

    public function viewNilaiGuruPraktikum()
    {
        $dataPraktikum = $this->Mpraktikum->getPraktikumGuru();
        foreach ($dataPraktikum as $prak) {
            $jmlPraktikum = $this->Mpraktikum->JumlahPesertaPraktikum($prak->id_praktikum);
            $jmlSeluruhSiswa = $this->Mpraktikum->getSiswaSeluruhnya();
            $jmlikutPraktikum = $jmlPraktikum->jml;
            $jmlSiswa = ($jmlSeluruhSiswa->jml) - 1;

            $data['nilai'][$prak->id_praktikum] = $jmlPraktikum->jml;
            $data['sisa'][$prak->id_praktikum] = $jmlSiswa - $jmlikutPraktikum;
        }

        $data['tampildata'] = $dataPraktikum;
        return view('t_guru/Gpraktikumhasil', $data);
    }

    public function viewNilaiGuruPraktikumDetail($id)
    {
        $data['tampildata'] = $this->Mpraktikum->getPraktikumGuruDetail($id);
        return view('t_guru/Gpraktikumdetail', $data);
    }

    public function viewPraktikumList()
    {
        $data['praktikums'] = $this->Mpraktikum->getpraktikumkelas();
        $data['kelass'] = $this->Mpraktikum->getKelasByUser();
        $data['games'] = $this->Mpraktikum->getLinkGames();

        return view('t_guru/Gpraktikum', $data);
    }

    /* buat praktikum */
    public function praktikum_add()
    {
        helper(['form', 'url']);

        $request = service('request');

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomPraktikum = '';
        for ($i = 0; $i < 6; $i++) {
            $randomPraktikum .= $characters[rand(0, $charactersLength - 1)];
        }

        $request = service('request');
        helper(['form', 'url']);

        $judul = $request->getPost('judul');
        $komentar = $request->getPost('komentar');
        $games = $request->getPost('games');
        $id_user = session()->get('id');

        $this->Mpraktikum = new Mpraktikum();
        $makeidprak = $this->Mpraktikum->getLastIdPraktikum();
        $idprak = $makeidprak->id_praktikum + 1;

        $tanggal_batas = $request->getPost('tanggal_batas');
        $waktu_batas = $request->getPost('waktu_batas');
        $tanggal_posting = $request->getPost('tanggal_posting');
        $waktu_posting = $request->getPost('waktu_posting');
        $kelas = $request->getPost('kelas');

        $validated = $this->validate([
            'judul' => [
                'rules' => 'required',
            ],
            'komentar' => [
                'rules' => 'required',
            ],
            'games' => [
                'rules' => 'required',
            ],
            'tanggal_batas' => [
                'rules' => 'required',
            ],
            'waktu_batas' => [
                'rules' => 'required',
            ],
            'tanggal_posting' => [
                'rules' => 'required',
            ],
            'waktu_posting' => [
                'rules' => 'required',
            ],
            'kelas' => [
                'rules' => 'required',
            ],
        ]);

        if ($validated) {
            $db = db_connect();
            $db->transStart();

            $getDataPraktikum = array(
                'id_praktikum' => $idprak,
                'judul' => $judul,
                'komentar' => $komentar,
                'kode_praktikum' => $randomPraktikum,
                'id_games' => $games,
                'id_user' => $id_user,

            );

            $db->table('praktikum')->insert($getDataPraktikum);

            foreach ($kelas as $kls) {
                $getDataKelasPrak = array(
                    'id_praktikum' => $idprak,
                    'kode_kelas' => $kls,
                    'tgl_publis' => $tanggal_posting,
                    'waktu_publis' => $waktu_posting,
                    'tgl_batas' => $tanggal_batas,
                    'waktu_batas' => $waktu_batas,
                );

                $db->table('praktikum_dikelas')->insert($getDataKelasPrak);
            }

            $db->transComplete();

            if ($db->transStatus() == FALSE) {
                # Something went wrong.
                $db->transRollback();
                session()->setFlashdata('error', 'Mohon Maaf Data Praktikum Tidak Dapat Di Simpan !');
                echo json_encode(array("status" => 1));
            } else {
                # Everything is Perfect. 
                # Committing data to the database.
                $db->transCommit();
                session()->setFlashdata('success', 'Selamat Data Praktikum Bisa Di Simpan !');
                echo json_encode(array("status" => 1));
            }
            $db->close();
        } else {
            session()->setFlashdata('error', 'Mohon Maaf, Data Yang Anda Inputkan Kurang Lengkap !');
            echo json_encode(array("status" => 1));
        }
    }
}
