<?php

namespace App\Models;

use CodeIgniter\Model;

class Musers extends Model
{
    var $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('users');
    }

    public function get_status_reg()
    {
        $id = session()->get('id');

        $query = $this->db->query('select * from status_reg where id_user =' . $id);
        return $query->getRow();
    }

    public function get_identitas()
    {
        $id = session()->get('id');
        $query = $this->db->query('select * from tbl_user where id =' . $id);
        return $query->getRow();
    }

    public function get_view_kelas()
    {
        $id = session()->get('id');
        $query = $this->db->query('select * from tbl_kelas_user a INNER JOIN kelas b ON a.kode_kelas = b.kode where a.id_user =' . $id);
        return $query->getRow();
    }

    public function get_view_kode($kode)
    {
        $query = $this->db->query("select a.id_sekolah as id_sekolah, c.kode_kelas as kode_kelas, a.fullname as fullname from tbl_user a INNER JOIN sekolah b ON a.id_sekolah = b.id_sekolah INNER JOIN tbl_kelas_user c ON a.id=c.id_user where a.level = 2 AND c.kode_kelas ='" . $kode . "'");
        return $query->getRow();
    }

    public function get_sekolah()
    {
        $id = session()->get('id');
        $query = $this->db->query('select * from tbl_user a INNER JOIN sekolah b ON a.id_sekolah = b.id_sekolah where a.id =' . $id);
        return $query->getRow();
    }

    public function get_user_kelas()
    {
        $id = session()->get('id');
        $query = $this->db->query('select * from tbl_kelas_user a INNER JOIN kelas b ON a.kode_kelas = b.kode where a.id_user =' . $id);
        return $query->getResult();
    }

    public function kelas_add_guru($data)
    {
        $this->db->table('kelas')->insert($data);
    }

    public function get_data_kelas($id)
    {
        $query = $this->db->query('select * from kelas WHERE id_kelas =' . $id);
        return $query->getRow();
    }

    public function updatekelasguru($data, $where)
    {
        $this->db->table('kelas')->update($data, $where);
    }

    public function getsekolahguru()
    {
        $id = session()->get('id');
        $query = $this->db->query('SELECT * FROM `tbl_user` a INNER JOIN sekolah b ON a.id_sekolah = b.id_sekolah WHERE a.id=' . $id);
        return $query->getRow();
    }

    public function updateDataSekolahGuru($data, $where)
    {
        $this->db->table('sekolah')->update($data, $where);
    }

    public function get_user_kelas_aktif()
    {
        $id = session()->get('id');
        $query = $this->db->query('select * from tbl_kelas_user a INNER JOIN kelas b ON a.kode_kelas = b.kode where kelas_aktif=1 AND a.id_user =' . $id);
        return $query->getRow();
    }
}
