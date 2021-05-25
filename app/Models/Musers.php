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

        $query = $this->db->query('SELECT * FROM status_reg WHERE id_user =' . $id);
        return $query->getRow();
    }

    public function get_status_image()
    {
        $id = session()->get('id');

        $query = $this->db->query('SELECT * FROM tbl_user WHERE id =' . $id);
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

    public function ubahpassword($password)
    {
        $id = session()->get('id');
        $this->db->table('tbl_user')->update(array('password' => $password), array('id' => $id));
    }

    /*==================== POSTING =============================*/
    public function addposting($data)
    {
        $this->db->table("posting_status")->insert($data);
    }

    public function tampilposting()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT a.status as status, count(b.id_user) as jml_komentar, a.judul as judul, c.username as username, a.update_date as update_date, a.id_posting as id_posting FROM `posting_status` a LEFT JOIN komentar b ON a.id_posting = b.id_posting LEFT JOIN tbl_user c ON a.id_user=c.id where  a.kode_kelas ='" . $kode_kelas . "' group by a.id_posting");
        return $query->getResult();
    }

    public function komentarpost($data)
    {
        $this->db->table("komentar")->insert($data);
    }

    public function getposting($id_posting)
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT * FROM `posting_status` a INNER JOIN tbl_user b ON a.id_user=b.id WHERE id_posting = " . $id_posting . " AND kode_kelas='" . $kode_kelas . "'");
        return $query->getRow();
    }

    public function getkomentar($id_posting)
    {
        $query = $this->db->query("SELECT * FROM `komentar` a INNER JOIN tbl_user b ON a.id_user=b.id WHERE id_posting = " . $id_posting);
        return $query->getResult();
    }

    public function getjmlkomentar($id)
    {
        $query = $this->db->query("SELECT count(id_komentar) as jumlah FROM `komentar` WHERE id_posting = " . $id);
        return $query->getRow();
    }

    public function getfileposting($id_posting)
    {
        $query = $this->db->query("SELECT * FROM `posting_status` WHERE id_posting = " . $id_posting);
        return $query->getRow();
    }

    public function getkomentarbyid($id)
    {
        $query = $this->db->query("SELECT * FROM `komentar` WHERE id_posting = " . $id);
        return $query->getResult();
    }

    public function deletekomentar($id)
    {
        $this->db->table('posting_status')->delete(array('id_posting' => $id));
    }

    public function deleteKomentarOrang($id)
    {
        $this->db->table('komentar')->delete(array('id_komentar' => $id));
    }

    public function getkelaUserbyIdGuru()
    {
        $id = session()->get('id');
        $query = $this->db->query("SELECT * FROM `tbl_kelas_user` WHERE id_user = " . $id);
        return $query->getResult();
    }

    public function getJumlahSiswaDikelas($wherein)
    {
        $id = session()->get('id');
        $query = $this->db->query("SELECT count(b.id_user) as jumlah_siswa, c.nama FROM `tbl_user` a LEFT JOIN tbl_kelas_user b ON a.id=b.id_user LEFT JOIN kelas c ON b.kode_kelas=c.kode WHERE level=1 AND b." . $wherein . " group by b.kode_kelas");
        return $query->getResult();
    }

    function rand_color()
    {
        $chars = 'ABCDEF0123456789';
        $color = '#';
        for ($i = 0; $i < 6; $i++) {
            $color .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $color;
    }

    public function getKomentarPosting($id_posting)
    {
        $query = $this->db->query("SELECT * FROM `komentar` WHERE id_posting=" . $id_posting);
        return $query->getResult();
    }

    public function hapusdataposting($id_posting)
    {
        $this->db->table('posting_status')->delete(array('id_posting' => $id_posting));
    }

    public function get_myfile_user($id)
    {
        //$id_user = session()->get('id');
        $query = $this->db->query("SELECT * FROM posting_status where id_posting =" . $id . " AND status = 'info' ");
        return $query->getRow();
    }

    public function deleteKelasGuru($where)
    {
        $this->db->table("kelas")->delete($where);
    }
}
