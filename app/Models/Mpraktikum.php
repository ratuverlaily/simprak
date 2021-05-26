<?php

namespace App\Models;

use CodeIgniter\Model;

class Mpraktikum extends Model
{
    var $table = 'praktikum';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('praktikum');
    }

    public function getpraktikum()
    {
        $id = session()->get('id');
        $query = $this->db->query('SELECT * FROM praktikum a LEFT JOIN `praktikum_getvalue` b ON a.id_praktikum=b.id_praktikum where b.id_user=' . $id);
        return $query->getResult();
    }

    public function getpraktikumkelas()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT * FROM praktikum a INNER JOIN `praktikum_dikelas` b ON a.id_praktikum=b.id_praktikum INNER JOIN tbl_user c ON a.id_user=c.id where b.kode_kelas='" . $kode_kelas . "' ORDER BY a.id_praktikum DESC");
        return $query->getResult();
    }

    public function getdetailpraktikum($id_praktikum)
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT * FROM praktikum a LEFT JOIN `praktikum_dikelas` b ON a.id_praktikum=b.id_praktikum LEFT JOIN praktikum_games c ON a.id_games = c.id_games where b.kode_kelas='" . $kode_kelas . "' and b.id_praktikum =" . $id_praktikum);
        return $query->getRow();
    }

    public function getPraktikumGuru()
    {
        $id_user = session()->get('id');
        $kode_kelas = session()->get('kode_kelas');

        $query = $this->db->query("SELECT * FROM `praktikum` a INNER JOIN praktikum_dikelas b ON a.id_praktikum = b.id_praktikum  WHERE b.kode_kelas ='" . $kode_kelas . "' AND a.id_user=" . $id_user . " ORDER BY b.tgl_publis DESC");
        return $query->getResult();
    }

    public function getPraktikumGuruDetail($id_praktikum)
    {
        $id_user = session()->get('id');
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT b.update_date as waktu_pengerjaan, a.fullname as fullname, b.pre_waktu_games as waktu_pretest, b.pre_fault_counter as pre_fault_counter, b.pre_status as pre_status, b.post_waktu_pengerjaan as post_waktu_pengerjaan, b.post_fault_counter as post_fault_counter, b.post_status as post_status, b.expe_waktu_pengerjaan as expe_waktu_pengerjaan, b.expe_status as expe_status FROM `tbl_user` a INNER JOIN praktikum_getvalue b ON a.id=b.id_user INNER JOIN praktikum c ON b.id_praktikum = c.id_praktikum INNER JOIN tbl_kelas_user d ON a.id=d.id_user WHERE c.id_user='" . $id_user . "' AND d.kode_kelas='" . $kode_kelas . "' AND c.id_praktikum='" . $id_praktikum . "'");
        return $query->getResult();
    }

    public function datadetailPraktikum($id_praktikum)
    {
        $id_user = session()->get('id');
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT * FROM `praktikum` a INNER JOIN praktikum_dikelas b ON a.id_praktikum = b.id_praktikum WHERE a.id_user = " . $id_user . " AND b.id_praktikum = " . $id_praktikum . " AND kode_kelas ='" . $kode_kelas . "'");
        return $query->getRow();
    }

    public function JumlahPesertaPraktikum($id_praktikum)
    {
        $id_user = session()->get('id');
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT COUNT(c.id_praktikum) as jml FROM `tbl_user` a INNER JOIN praktikum_getvalue b ON a.id=b.id_user INNER JOIN praktikum c ON b.id_praktikum = c.id_praktikum INNER JOIN tbl_kelas_user d ON a.id=d.id_user WHERE c.id_user='" . $id_user . "' AND d.kode_kelas='" . $kode_kelas . "' AND c.id_praktikum='" . $id_praktikum . "'");
        return $query->getRow();
    }

    public function getSiswaSeluruhnya()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT COUNT(id_user) as jml FROM `tbl_kelas_user`  WHERE kode_kelas ='" . $kode_kelas . "'");
        return $query->getRow();
    }

    public function getKelasByUser()
    {
        $query = $this->db->query("SELECT * FROM `kelas` a INNER JOIN tbl_kelas_user b ON a.kode=b.kode_kelas WHERE b.id_user =" . session()->get('id'));
        return $query->getResult();
    }

    public function getLinkGames()
    {
        $query = $this->db->query("select a.judul as judul, b.judul as modul,b.link as link, a.id_games as id_games from praktikum_games a INNER JOIN modul b ON a.id_modul = b.id_modul");
        return $query->getResult();
    }

    public function getLastIdPraktikum()
    {
        $query = $this->db->query("SELECT max(id_praktikum) as id_praktikum FROM praktikum");
        return $query->getRow();
    }

    /*---------- encripty dan decripty ----------------------*/
    public function encrypt($string)
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
        $secret_iv = '5fgf5HJ5g27'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo

        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);

        return $output;
    }

    public function decrypt($string)
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
        $secret_iv = '5fgf5HJ5g27'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

        return $output;
    }

    public function getKodePraktikum($id_praktikum)
    {
        $query = $this->db->query("SELECT * FROM praktikum WHERE id_praktikum=" . $id_praktikum);
        return $query->getRow();
    }

    public function status_games($id_praktikum)
    {
        $id_user = session()->get('id');
        $query = $this->db->query("SELECT * FROM praktikum_status_games WHERE id_praktikum=" . $id_praktikum . " AND id_user=" . $id_user);
        return $query->getRow();
    }

    public function insert_status_games($data)
    {
        $this->db->table('praktikum_status_games')->insert($data);
    }

    // dasboard

    public function getgrafikvalue()
    {
        $kode_kelas = session()->get('kode_kelas');
        $query = $this->db->query("SELECT b.id_praktikum, a.judul as judul, sum(b.pre_status) as pre_status, sum(b.post_status) as post_status, sum(b.expe_status) as 	expe_status FROM praktikum a INNER JOIN praktikum_dikelas c ON a.id_praktikum = c.id_praktikum INNER JOIN praktikum_getvalue b ON a.id_praktikum = b.id_praktikum  WHERE c.kode_kelas = '" . $kode_kelas . "' group by a.id_praktikum");
        return $query->getResult();
    }

    public function getKodePraktikumdikelas($id_games, $arrayKelas)
    {
        $query = $this->db->query("SELECT * FROM praktikum_dikelas a INNER JOIN praktikum b ON a.id_praktikum = b.id_praktikum INNER JOIN kelas c ON a.kode_kelas = c.kode WHERE kode_kelas IN (" . $arrayKelas . ") AND b.id_games = " . $id_games);
        return $query->getResult();
    }

    /* delete Praktikum */
    public function getjmlKelasPraktikum($id_praktikum)
    {
        $query = $this->db->query("SELECT * FROM  praktikum_dikelas  WHERE id_praktikum = " . $id_praktikum);
        return $query->getResult();
    }

    public function getpraktikummodul($id_praktikum)
    {
        $query = $this->db->query("SELECT * FROM praktikum a INNER JOIN praktikum_games b ON a.id_games = b.id_games INNER JOIN modul c ON b.id_modul = c.id_modul  WHERE a.id_praktikum = " . $id_praktikum);
        return $query->getRow();
    }

    public function getdataPraktikum($id)
    {
        $query = $this->db->query("SELECT * FROM praktikum a INNER JOIN praktikum_dikelas b ON a.id_praktikum = b.id_praktikum WHERE a.id_praktikum = " . $id);
        return $query->getRow();
    }
}
