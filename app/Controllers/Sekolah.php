<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Musers;
use App\Models\Msekolah;

class Sekolah extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Msekolah = new Msekolah();
    }

    public function index()
    {
        $this->Musers = new Musers();
        $data = $this->Musers->get_sekolah();
        if ($data) {
            $hasil['nama'] = $data->nama;
            $hasil['alamat'] = $data->alamat;
            $hasil['no_tlp'] = $data->no_tlp;
            $hasil['no_fax'] = $data->no_fax;
            $hasil['kode_pos'] = $data->kode_pos;
        } else {
            $hasil['nama'] = "-";
            $hasil['alamat'] = "-";
            $hasil['no_tlp'] = "-";
            $hasil['no_fax'] = "-";
            $hasil['kode_pos'] = "-";
        }

        return view('t_siswa/Ssekolah', $hasil);
    }
}
