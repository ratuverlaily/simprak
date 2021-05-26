<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Mauth;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Mauth = new Mauth();
    }

    public function index()
    {
        $data = array(
            'title' => 'Registrasi',
        );
        return view('auth/login', $data);
    }

    public function logout()
    {
        if (session()->get('level') == 1) {
            $kodesesion = ['log', 'id', 'username', 'email', 'level', 'user_image', 'status_regis', 'kelas', 'kode_kelas'];
            session()->remove($kodesesion);
            session()->setFlashdata('success', 'Logout Suskses !');
            return redirect()->to(base_url('auth/login'));
        } else {
            $kodesesion = ['log', 'id', 'username', 'email', 'level', 'user_image', 'status_regis', 'kelas', 'kode_kelas'];
            session()->remove($kodesesion);
            session()->setFlashdata('success', 'Logout Suskses !');
            return redirect()->to(base_url('auth/login'));
        }
    }
    public function ceklogin()
    {
        $validated = $this->validate([
            'email'    => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Input Email Anda !'
                ]
            ],
            'password'    => [
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Input Password Min 10 Karakter Terdiri Dari Angka Dan huruf !'
                ]
            ],
        ]);

        if ($validated) {
            $request = service('request');
            $password = $request->getPost('password');
            $email = $request->getPost('email');
            $cek = $this->Mauth->login($email, $password);
            if ($cek) {
                //jika data nya cocok buat session 
                $kodesesion = [
                    'log' => true,
                    'id'  => $cek['id'],
                    'username'  => $cek['username'],
                    'email'     => $cek['email'],
                    'level' => $cek['level'],
                    'user_image' => $cek['user_image'],
                    'status_regis' => $cek['status_regis'],
                ];
                session()->set($kodesesion);
                return redirect()->to(base_url('home'));
            } else {
                //jika datanya tidak cocok 
                session()->setFlashdata('pesan', 'Login Gagal, Username Dan Password Tidak Cocok !');
                return redirect()->to(base_url('auth/login'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/login'));
        }
    }

    public function register()
    {
        $data = array(
            'title' => 'Registrasi',
        );

        return view('auth/register', $data);
    }

    public function save_register()
    {
        $validated = $this->validate([
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tolong input username !.'
                ]
            ],
            'email'    => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'valid_email' => 'Tolong cek email. Email Tidak Valid !.'
                ]
            ],
            'lavel_akses'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tolong Input Lavel Akses !.'
                ]
            ],
            'password'    => [
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Input Password Min 10 Karakter Terdiri Dari Angka Dan huruf !.'
                ]
            ],
            'repassword'    => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'Passwor tidak sama !.'
                ]
            ],
        ]);

        if ($validated) {
            $request = service('request');
            $data['username'] = $request->getPost('username');
            $data['email'] = $request->getPost('email');
            $data['level'] = $request->getPost('lavel_akses');
            $data['password'] = $request->getPost('password');
            $data['created_at'] = date('d M Y H:i:s');
            $data['updated_at'] = date('d M Y H:i:s');

            $getdata = $this->Mauth->save_register($data);

            session()->setFlashdata('success', 'Register Berhasil Di Simpan !');
            return redirect()->to(base_url('auth/login'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }
    }
}
