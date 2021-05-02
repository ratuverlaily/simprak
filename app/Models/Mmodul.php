<?php

namespace App\Models;

use CodeIgniter\Model;

class Mmodul extends Model
{
    var $table = 'modul';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('modul');
    }

    public function get_modul_user()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT c.judul as judul, c.keterangan as keterangan, c.status as status, c.link as link, c.format as format, c.tanggal as tanggal FROM `praktikum` a INNER JOIN praktikum_games b ON a.id_games = b.id_games INNER JOIN modul c ON b.id_modul = c.id_modul INNER JOIN praktikum_dikelas d ON a.id_praktikum = d.id_praktikum where d.kode_kelas ='" . $kode_kelas . "'");
        return $query->getResult();
    }
}
