<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Musers;
use App\Models\Mmodul;

class modul extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Mmodul = new Mmodul();
        $this->Musers = new Musers();
    }

    public function index()
    {
    }

    public function hapusfilepdf($id_posting)
    {
        $getmyfile = $this->Mmodul->get_myfile_user($id_posting);
        if ($getmyfile) {
            unlink('driveme/' . $getmyfile->file);
        }
        $this->Mmodul->hapusfilemodul($id_posting);
        session()->setFlashdata('success', 'File Anda Berhasil Di Hapus !');

        return redirect()->to(base_url('modul/myfile/siswa'));
    }

    public function viewModulpdf($id)
    {
        $getfile['getfile'] = $this->Mmodul->getfilemodul($id);
        return view('t_guru/Gpdfmodul', $getfile);
    }


    public function viewfilepdf($id)
    {
        $getfile['getfile'] = $this->Mmodul->getfilePostingmodul($id);

        return view('t_guru/GpdfFile', $getfile);
    }


    public function viewmyfilepdf($id)
    {
        $getfile['getfile'] = $this->Mmodul->get_myfile_user($id);

        return view('t_guru/GpdfMyFile', $getfile);
    }

    public function getmodulpraktikumsiswa()
    {
        $data['moduls'] = $this->Mmodul->get_modul_user();
        return view('t_siswa/Smodul', $data);
    }

    public function getmodulpraktikumguru()
    {
        $data['moduls'] = $this->Mmodul->get_modul_user();
        return view('t_guru/Gmodul', $data);
    }

    public function getfilemodulguru()
    {
        $data['files'] = $this->Mmodul->get_file_user();
        return view('t_guru/Gfile', $data);
    }

    public function getmyfileguru()
    {
        $data['files'] = $this->Mmodul->get_myfile_guru();
        return view('t_guru/Gmyfile', $data);
    }

    public function viewFormMyFile()
    {
        return view('t_guru/Gmyfile_form');
    }

    public function saveFileGuru()
    {
        helper(['form', 'url']);

        $data = array();

        $validated = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,application/pdf,application/zip,application/msword,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[file,4096]',
            ],

        ]);
        $request = service('request');


        if ($validated) {
            if ($file = $request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $judul = $request->getPost('judul');
                    $file = $request->getFile('file');

                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    // Get random file name
                    $newName = $file->getRandomName();

                    $file->move('driveme', $newName);

                    $data = array(
                        "id_user" => session()->get('id'),
                        "kode_kelas" => session()->get('kode_kelas'),
                        "judul" => $judul,
                        "file" => $newName,
                        "status" => 'myfile',
                        "create_date" => date("Y-m-d h:i:s"),
                        "update_date" => date("Y-m-d h:i:s"),
                    );

                    $this->Musers->addposting($data);
                    session()->setFlashdata('success', 'Posting berhasil di post !');
                    return redirect()->to(base_url('modul/myfile/guru'));
                } else {
                    session()->setFlashdata('error', 'Mohon Maaf File Anda Tidak Berhasil Di Simpan !');
                    return redirect()->to(base_url('modul/myfile/guru'));
                }
            }
        } else {
            session()->setFlashdata('error', 'Mohon Maaf File Tidak Sesuai !');
            return redirect()->to(base_url('modul/myfile/guru'));
        }
    }
}
