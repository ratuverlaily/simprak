<?php

namespace App\Models;

use CodeIgniter\Model;

class Mkelas extends Model
{
    var $table = 'kelas';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('kelas');
    }

    public function get_kelas_user()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("select * from tbl_user a INNER JOIN tbl_kelas_user b ON a.id=b.id_user where a.level=1 AND b.kode_kelas ='" . $kode_kelas . "'");
        return $query->getResult();
    }

    public function get_sekolah()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("select * from tbl_user a INNER JOIN sekolah b ON a.id_sekolah = b.id_sekolah where a.id ='" . session()->get('id') . "'");
        return $query->getRow();
    }

    public function get_kelas_kode($id)
    {
        $query = $this->db->query("select * from kelas WHERE id_kelas ='" . $id . "'");
        return $query->getRow();
    }
}
