<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Musers;
use App\Models\Mkelas;

class Kelas extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Mkelas = new Mkelas();
    }

    public function index()
    {
        $this->Musers = new Musers();

        if (session()->get('level') == 1) {
            $data = $this->Musers->get_view_kelas();
            if ($data) {
                $getguru = $this->Musers->get_view_kode($data->kode_kelas);
                $hasil['id_kelas'] = $data->id_kelas;
                $hasil['kode'] = $data->kode;
                $hasil['nama'] = $data->nama;
                $hasil['jurusan'] = $data->jurusan;
                $hasil['jumlah'] = $data->jumlah;
                $hasil['nama_guru'] = $getguru->fullname;
                $hasil['status'] = "Aktif";
            } else {
                $hasil['id_kelas'] = "-";
                $hasil['kode'] = "-";
                $hasil['nama'] = "-";
                $hasil['jurusan'] = "-";
                $hasil['jumlah'] = "-";
                $hasil['nama_guru'] = "-";
                $hasil['status'] = "Non Aktif";
            }
            return view('t_siswa/Skelas', $hasil);
        } else {
            $hasil['kelass'] = $this->Musers->get_user_kelas();
            return view('t_guru/Gkelas', $hasil);
        }
    }

    /* ---------- kelas fitur siswa --------------- */
    public function showKelasSiswa()
    {
        $skl = $this->Mkelas->get_sekolah();
        if ($skl) {
            $data['sekolah'] = $skl->nama;
        } else {
            $data['sekolah'] = "<p class='text-danger'>Tidak Ada Nama Sekolah (hub Guru Untuk Di Update) ?</p>";
        }

        $data['tampildata'] = $this->Mkelas->get_kelas_user();

        /*----- activation ---------*/
        $data['active_kelas'] = 'active';
        $data['active_pengaturan'] = '';
        /*----- activation ---------*/

        return view('t_siswa/Ssiswa', $data);
    }

    /* ---------- Tutup kelas fitur guru --------------- */

    public function aktivasikelas($id)
    {
        $data = $this->Mkelas->get_kelas_kode($id);

        $db = db_connect();
        $db->transStart();

        $wheretable1 = array(
            'id_user' => session()->get('id'),
            'kode_kelas' => session()->get('kode_kelas'),
        );

        $db->table('tbl_kelas_user')->update(array('kelas_aktif' => 0), $wheretable1);

        $wheretable2 = array(
            'id_user' => session()->get('id'),
            'kode_kelas' => $data->kode,
        );

        $db->table('tbl_kelas_user')->update(array('kelas_aktif' => 1),  $wheretable2);

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            # Something went wrong.
            $db->transRollback();
            session()->setFlashdata('error', 'Mohon Maaf Aktivasi Kelas Tidak Berhasil !');
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $db->transCommit();
            $getkelasnew = array(
                "kelas" => $data->nama,
                "kode_kelas" => $data->kode,
            );
            session()->set($getkelasnew);
            session()->setFlashdata('success', 'Selamat Aktifasi Kelas Anda Sudah Berhasil !');
        }
        $db->close();

        return redirect()->to(base_url('kelas'));
    }
}
