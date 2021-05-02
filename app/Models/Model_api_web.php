<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_api_web extends Model
{
    var $table = 'praktikum_status_games';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('praktikum_status_games');
    }


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

    public function cektoken($token)
    {
        $query = $this->db->query("SELECT * FROM token_api_games WHERE token='" . $token . "'");
        return $query->getRow();
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

    public function get_users()
    {
        $query = $this->db->query('select * from tbl_user');
        return $query->getResult();
    }

    public function praktikumid($kode_praktikum)
    {
        $query = $this->db->query("SELECT * FROM praktikum WHERE kode_praktikum='" . $kode_praktikum . "'");
        return $query->getRow();
    }

    public function get_statusgames_praktikum($id_user, $id_praktikum)
    {
        $query = $this->db->query("SELECT * FROM `praktikum_status_games` WHERE id_user=" . $id_user . " AND id_praktikum=" . $id_praktikum);
        return $query->getRow();
    }

    public function cek_data_value($id_user, $id_praktikum)
    {
        $query = $this->db->query("SELECT * FROM `praktikum_getvalue` WHERE id_user=" . $id_user . " AND id_praktikum=" . $id_praktikum);
        return $query->getRow();
    }

    public function insert_post_test($data)
    {
        $this->db->table('praktikum_getvalue')->insert($data);
    }

    public function update_post_test($data, $where)
    {
        $this->db->table('praktikum_getvalue')->update($data, $where);
    }

    public function insert_pre_test($data)
    {
        $this->db->table('praktikum_getvalue')->insert($data);
    }

    public function update_pre_test($data, $where)
    {
        $this->db->table('praktikum_getvalue')->update($data, $where);
    }

    public function insert_experiment_test($data)
    {
        $this->db->table('praktikum_getvalue')->insert($data);
    }

    public function update_experiment_test($data, $where)
    {
        $this->db->table('praktikum_getvalue')->update($data, $where);
    }

    public function insert_test_games($data)
    {
        $this->db->table('praktikum_getvalue')->insert($data);
    }

    public function update_test_games($data, $where)
    {
        $this->db->table('praktikum_getvalue')->update($data, $where);
    }

    public function update_status_games($data, $where)
    {
        $this->db->table('praktikum_status_games')->update($data, $where);
    }

    public function cek_status_games($id_user, $id_praktikum, $kode_kelas)
    {
        $query = $this->db->query("SELECT * FROM `praktikum_status_games` WHERE id_user =" . $id_user . " AND id_praktikum =" . $id_praktikum . " AND kode_kelas ='" . $kode_kelas . "'");
        return $query->getRow();
    }
}
