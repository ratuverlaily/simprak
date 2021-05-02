<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Musers;
use App\Models\Mmodul;

class modul extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Mmodul = new Mmodul();
    }

    public function index()
    {
    }

    public function getmodulpraktikumsiswa()
    {
        $data['moduls'] = $this->Mmodul->get_modul_user();
        return view('t_siswa/Smodul', $data);
    }

    public function getmodulpraktikumguru()
    {
        $data['moduls'] = $this->Mmodul->get_modul_user();
        return view('t_guru/Gmodul', $data);
    }
}
