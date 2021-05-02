<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Mauth;
use App\Models\Musers;

class Home extends BaseController
{
    public function index()
    {
        $this->Musers = new Musers();
        $datauser = $this->Musers->get_identitas();

        if (session()->get('level') == 1) {
            if ($datauser->status_regis == 0) {
                return redirect()->to(base_url('users/photo'));
            } else {
                $datauser = $this->Musers->get_view_kelas();
                $data['kode_kelas'] = $datauser->kode_kelas;
                $data['kelas'] = $datauser->nama;
                session()->set($data);

                return view('home');
            }
        } else {
            if ($datauser->status_regis == 0) {
                return redirect()->to(base_url('users/photo'));
            } else {
                $datauserkelasaktif = $this->Musers->get_user_kelas_aktif();
                $data['kode_kelas'] = $datauserkelasaktif->kode_kelas;
                $data['kelas'] = $datauserkelasaktif->nama;
                session()->set($data);

                return view('home');
            }
        }
    }
}
