<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Mpraktikum;
use App\Models\Model_api_web;
use App\Models\Mpraktikumguru;

class Praktikum extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Mpraktikum = new Mpraktikum();
        $this->Mpraktikumguru = new Mpraktikumguru();
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

    public function viewpdfpraktikum($id_praktikum)
    {
        $data['getdata'] = $this->Mpraktikum->getpraktikummodul(
            $id_praktikum
        );

        return view('t_siswa/SpdfFilePraktikum', $data);
    }

    /* ========================== praktikum guru ============================== */
    public function praktikumgurudetail($id)
    {
        $data = $this->Mpraktikum->getdetailpraktikum($id);
        $hasil['tampildata'] = $data;
        $hasil['kelass'] = $this->Mpraktikum->getKelasByUser();
        $hasil['games'] = $this->Mpraktikum->getLinkGames();


        $this->Model_api_web = new Model_api_web();
        $hasil['praktikum'] = array(
            "id_praktikum" => $this->Mpraktikum->encrypt($data->id_praktikum),
        );

        return view('t_guru/Gpraktikum_detail', $hasil);
    }

    public function viewUpdatePraktikum($id)
    {
        $data = $this->Mpraktikum->datadetailPraktikum($id);
        echo json_encode($data);
    }

    public function viewNilaiGuruPraktikum()
    {
        $where = [
            'kode_kelas' => session()->get('kode_kelas'),
            'id_user' => session()->get('id'),
        ];
        $getDataPraktikum = $this->Mpraktikum->join('praktikum_dikelas', 'praktikum_dikelas.id_praktikum = praktikum.id_praktikum', 'INNER');
        $getDataPraktikum = $getDataPraktikum->where($where);

        $data = [
            'tampildata' => $getDataPraktikum->paginate(8, 'tampildata'),
            'pager' => $getDataPraktikum->pager,
        ];

        foreach ($data['tampildata'] as $prak) {
            $jmlPraktikum = $this->Mpraktikum->JumlahPesertaPraktikum($prak['id_praktikum']);
            $jmlSeluruhSiswa = $this->Mpraktikum->getSiswaSeluruhnya();
            $jmlikutPraktikum = $jmlPraktikum->jml;
            $jmlSiswa = ($jmlSeluruhSiswa->jml) - 1;

            $data['nilai'][$prak['id_praktikum']] = $jmlPraktikum->jml;
            $data['sisa'][$prak['id_praktikum']] = $jmlSiswa - $jmlikutPraktikum;
        }

        return view('t_guru/Gpraktikumhasil', $data);
    }

    public function viewNilaiGuruPraktikumDetail($id)
    {
        $data['tampildata'] = $this->Mpraktikum->getPraktikumGuruDetail($id);
        return view('t_guru/Gpraktikumdetail', $data);
    }

    public function viewPraktikumList()
    {
        $where = [
            'kode_kelas' => session()->get('kode_kelas'),
        ];
        $prak = $this->Mpraktikumguru->join('praktikum_dikelas', 'praktikum_dikelas.id_praktikum = praktikum.id_praktikum', 'INNER');
        $prak = $prak->join('tbl_user', 'tbl_user.id=praktikum.id_user', 'INNER');
        $prak = $prak->where($where);
        $prak = $prak->orderBy('praktikum.id_praktikum', 'DESC');


        $data = [
            'praktikums' => $prak->paginate(5, 'praktikum'),
            'pager' => $prak->pager,
        ];

        //$data['praktikums'] = $this->Mpraktikum->getpraktikumkelas();

        $data['kelass'] = $this->Mpraktikum->getKelasByUser();
        $data['games'] = $this->Mpraktikum->getLinkGames();

        return view('t_guru/Gpraktikum', $data);
    }

    public function praktikum_delete($id)
    {
        helper(['form', 'url']);
        $id_praktikum = $id;
        $kode_kelas = session()->get('kode_kelas');

        $getKelasPrak = $this->Mpraktikum->getjmlKelasPraktikum($id_praktikum);
        $jmlprak = count($getKelasPrak);
        if ($jmlprak > 1) {
            $db = db_connect();

            $db->transStart();

            $db->table('praktikum_dikelas')->delete(array('id_praktikum' => $id_praktikum, 'kode_kelas' => $kode_kelas));

            $db->table('praktikum')->delete(array('id_praktikum' => $id_praktikum));

            $where = array(
                'id_praktikum' => $id_praktikum,
                'kode_kelas' => session()->get('kode_kelas'),
            );

            $db->table('posting_status')->delete($where);

            $db->transComplete();
        } else {
            $db = db_connect();

            $db->transStart();

            $db->table('praktikum')->delete(array('id_praktikum' => $id_praktikum));

            $db->table('praktikum_dikelas')->delete(array('id_praktikum' => $id_praktikum, 'kode_kelas' => $kode_kelas));

            $db->table('praktikum')->delete(array('id_praktikum' => $id_praktikum));

            $where = array(
                'id_praktikum' => $id_praktikum,
                'kode_kelas' => session()->get('kode_kelas'),
            );

            $db->table('posting_status')->delete($where);

            $db->transComplete();
        }

        if ($db->transStatus() == FALSE) {
            # Something went wrong.
            $db->transRollback();
            session()->setFlashdata('error', 'Mohon Maaf Data Praktikum Tidak Bisa Di Hapus !');
            return redirect()->to(base_url('praktikum/guru/detail/' . $id_praktikum));
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $db->transCommit();
            session()->setFlashdata('success', 'Data Praktikum Berhasil Di Hapus !');
            return redirect()->to(base_url('praktikum/guru/list'));
        }
        $db->close();
    }

    public function praktikum_update()
    {
        $request = service('request');
        helper(['form', 'url']);

        $id_praktikum = $request->getPost('id_praktikum');
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
                'judul' => $judul,
                'komentar' => $komentar,
                'id_games' => $games,
                'id_user' => $id_user,
            );

            $db->table('praktikum')->update($getDataPraktikum, array('id_praktikum' => $id_praktikum));

            $getDataKelasPrak = array(
                'tgl_publis' => $tanggal_posting,
                'waktu_publis' => $waktu_posting,
                'tgl_batas' => $tanggal_batas,
                'waktu_batas' => $waktu_batas,
            );

            $db->table('praktikum_dikelas')->update($getDataKelasPrak, array('id_praktikum' => $id_praktikum, 'kode_kelas' => session()->get('kode_kelas')));

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

        $jmlkelas = count($kelas);
        $nomor = 1;
        $arrKelas = "";
        foreach ($kelas as $getkels) {
            if ($nomor == $jmlkelas) {
                $arrKelas .= "'" . $getkels . "'";
            } else {
                $arrKelas .= "'" . $getkels . "',";
            }
            $nomor++;
        }

        $cekKelas = $this->Mpraktikum->getKodePraktikumdikelas($games, $arrKelas);
        if (!empty($cekKelas)) {
            $tmpkelas = "[";
            foreach ($cekKelas as $getdatakelas) {
                $tmpkelas .= $getdatakelas->nama . ",";
            }
            $tmpkelas .= "]";

            session()->setFlashdata('error', "Mohon Maaf, kelas " . $tmpkelas . " sudah pernah melakukan praktikum yang sama !");
            echo json_encode(array("status" => 1));
        } else {

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

                    $getDataPosting = array(
                        "id_user" => session()->get('id'),
                        'id_praktikum' => $idprak,
                        "kode_kelas" => $kls,
                        "judul" => $judul,
                        "status" => 'praktikum',
                        "create_date" => date("Y-m-d h:i:s"),
                        "update_date" => date("Y-m-d h:i:s"),
                    );

                    $db->table('posting_status')->insert($getDataPosting);
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
}
