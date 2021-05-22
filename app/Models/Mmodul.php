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

    public function getfilemodul($id)
    {
        $query = $this->db->query("SELECT * FROM modul  WHERE id_modul =" . $id);
        return $query->getRow();
    }

    public function get_modul_user()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT c.id_modul as id_modul, c.judul as judul, c.keterangan as keterangan, c.status as status, c.link as link, c.format as format, c.tanggal as tanggal FROM `praktikum` a INNER JOIN praktikum_games b ON a.id_games = b.id_games INNER JOIN modul c ON b.id_modul = c.id_modul INNER JOIN praktikum_dikelas d ON a.id_praktikum = d.id_praktikum where d.kode_kelas ='" . $kode_kelas . "'");
        return $query->getResult();
    }

    public function get_file_user()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT * FROM posting_status where kode_kelas ='" . $kode_kelas . "' AND file IS NOT NULL AND status = 'INFO' ");
        return $query->getResult();
    }

    public function get_myfile_user($id)
    {
        //$id_user = session()->get('id');
        $query = $this->db->query("SELECT * FROM posting_status where id_posting =" . $id . " AND status = 'myfile' ");
        return $query->getRow();
    }

    public function get_myfile_guru()
    {
        $id_user = session()->get('id');
        $query = $this->db->query("SELECT * FROM posting_status where id_user =" . $id_user . " AND status = 'myfile' ");
        return $query->getResult();
    }

    public function getfilePostingmodul($id)
    {
        $query = $this->db->query("SELECT * FROM posting_status where id_posting =" . $id);
        return $query->getRow();
    }

    public function hapusfilemodul($id_posting)
    {
        $this->db->table('posting_status')->delete(array('id_posting' => $id_posting));
    }
}
