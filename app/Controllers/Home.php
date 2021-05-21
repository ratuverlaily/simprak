<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Mposting;
use App\Models\Musers;

class Home extends BaseController
{
    public function index()
    {
        $this->Musers = new Musers();
        $this->Mposting = new Mposting();
        $datauser = $this->Musers->get_identitas();

        if (session()->get('level') == 1) {
            if ($datauser->status_regis == 0) {
                return redirect()->to(base_url('users/photo'));
            } else {
                $datauser = $this->Musers->get_view_kelas();
                $data['kode_kelas'] = $datauser->kode_kelas;
                $data['kelas'] = $datauser->nama;
                session()->set($data);

                $stus = ['info', 'praktikum'];
                $getpost = [
                    'posting' => $this->Mposting->join('tbl_user', 'tbl_user.id = posting_status.id_user')->where('kode_kelas', session()->get('kode_kelas'))->whereIn('status', $stus)->orderBy('posting_status.id_posting', 'DESC')->paginate(5, 'posting'),
                    'pager' =>  $this->Mposting->join('tbl_user', 'tbl_user.id = posting_status.id_user')->pager,
                ];

                return view('home', $getpost);
            }
        } else {
            if ($datauser->status_regis == 0) {
                return redirect()->to(base_url('users/photo'));
            } else {
                $datauserkelasaktif = $this->Musers->get_user_kelas_aktif();
                $data['kode_kelas'] = $datauserkelasaktif->kode_kelas;
                $data['kelas'] = $datauserkelasaktif->nama;
                session()->set($data);

                $stus = ['info', 'praktikum'];
                $getpost = [
                    'posting' => $this->Mposting->join('tbl_user', 'tbl_user.id = posting_status.id_user')->where('kode_kelas', session()->get('kode_kelas'))->whereIn('status', $stus)->orderBy('posting_status.id_posting', 'DESC')->paginate(5, 'posting'),
                    'pager' =>  $this->Mposting->join('tbl_user', 'tbl_user.id = posting_status.id_user')->pager,
                ];

                return view('home', $getpost);
            }
        }
    }
}
