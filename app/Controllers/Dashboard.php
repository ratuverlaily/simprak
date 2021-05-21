<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Mpraktikum;
use App\Models\Musers;

class dashboard extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Musers = new Musers();
        $this->Mpraktikum = new Mpraktikum();
    }

    public function index()
    {
        $getuserskelas = $this->Musers->getkelaUserbyIdGuru();
        $jml = count($getuserskelas);
        $wherein = "kode_kelas IN (";
        $i = 1;
        foreach ($getuserskelas as $kodekelas) {
            if ($i == $jml) {
                $wherein .= "'" . $kodekelas->kode_kelas . "'";
            } else {
                $wherein .= "'" . $kodekelas->kode_kelas . "',";
            }

            $i++;
        }
        $wherein .= ")";

        // =====================praktikum grafik======================= //

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

        $jmlSeluruhSiswa = $this->Mpraktikum->getSiswaSeluruhnya();

        foreach ($data['tampildata'] as $prak) {
            $jmlPraktikum = $this->Mpraktikum->JumlahPesertaPraktikum($prak['id_praktikum']);
            $jmlikutPraktikum = $jmlPraktikum->jml;
            $jmlSiswa = ($jmlSeluruhSiswa->jml) - 1;

            if ($jmlikutPraktikum) {
                $tmp = ($jmlikutPraktikum / $jmlSiswa) * 100;
            } else {
                $tmp = 0;
            }
            $presentase = round($tmp, 0, PHP_ROUND_HALF_UP);

            $data['nilai'][$prak['id_praktikum']] = $jmlPraktikum->jml;
            $data['sisa'][$prak['id_praktikum']] = $jmlSiswa - $jmlikutPraktikum;
            $data['jumlah'][$prak['id_praktikum']] = $jmlSiswa;
            $data['warna'][$prak['id_praktikum']] = $this->Musers->rand_color();
            $data['presen'][$prak['id_praktikum']] = $presentase;
        }

        $data['kelass'] = $this->Musers->getJumlahSiswaDikelas($wherein);
        $data['jml_kelas'] = $jml;
        $data['jml_siswa'] = ($jmlSeluruhSiswa->jml) - 1;
        $data['warna_post'] = $this->Musers->rand_color();
        $data['warna_pre'] = $this->Musers->rand_color();
        $data['warna_expe'] = $this->Musers->rand_color();

        $data['getdatapraktikum'] =  $this->Mpraktikum->getgrafikvalue();

        return view('t_guru/Gdasboard', $data);
    }
}
