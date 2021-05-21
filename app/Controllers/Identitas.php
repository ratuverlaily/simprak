<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Musers;

class Identitas extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Musers = new Musers();
    }

    public function index()
    {
    }

    public function viewPassword()
    {
        $hasil['users'] = $this->Musers->get_identitas();

        return view('t_siswa/identitas_siswa/registrasi_ubah_password', $hasil);
    }

    public function updatePassword()
    {
        $validated = $this->validate([
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
            $password = $request->getPost('password');
            $this->Musers->ubahpassword($password);

            session()->setFlashdata('success', 'Password berhasil di update !');
            return redirect()->to(base_url('identitas/password'));
        } else {
            session()->setFlashdata('error', 'Password yang anda input tidak sama, Ulangi Kembali !');
            return redirect()->to(base_url('identitas/password'));
        }
    }

    /* --------------- REGISTRASI SISWA ----------------------*/

    public function viewphoto()
    {
        $getreg = $this->Musers->get_status_reg();
        if ($getreg) {
            $status['photo'] = $getreg->photo;
            $status['identitas'] = $getreg->identitas;
            $status['kelas'] = $getreg->kelas;
            $status['akses'] = $getreg->akses;
            $status['sekolah'] = $getreg->sekolah;
        } else {
            $status['photo'] = 0;
            $status['identitas'] = 0;
            $status['kelas'] = 0;
            $status['akses'] = 0;
            $status['sekolah'] = 0;
        }

        if (session()->get('level') == 1) {
            echo view('t_siswa/identitas_siswa/registrasi_photo', $status);
        } else {
            echo view('t_guru/identitas_guru/registrasi_photo', $status);
        }
    }

    public function uploadphoto()
    {
        $data = array();
        //membaca token baru
        $data['token'] = csrf_hash();

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

                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    // Get random file name
                    $newName = $file->getRandomName();

                    $getreg = $this->Musers->get_status_reg();

                    // Store file in public/uploads/ folder
                    $getstatusImg = $this->Musers->get_status_image();

                    $file->move('uploads', $newName);

                    if ($getreg) {
                        if (!empty($getstatusImg->user_image) && $getstatusImg->user_image != $newName) {
                            unlink('uploads/' . session()->get('user_image'));
                        }
                    }

                    //insert and udate data
                    $db = db_connect();
                    $db->transStart();

                    $arrUser['user_image'] = $newName;
                    $id = array('id' => session()->get('id'));
                    $db->table('tbl_user')->update($arrUser, $id);

                    $db->transComplete();

                    if ($db->transStatus() == FALSE) {
                        # Something went wrong.
                        $db->transRollback();
                        session()->setFlashdata('error', 'Mohon Maaf Data Photo Diri Anda Tidak Berhasil Di Simpan !');
                        echo json_encode(array("status" => 1));
                    } else {
                        # Everything is Perfect. 
                        # Committing data to the database.
                        $db->transCommit();
                        session()->set(array('user_image' => $newName));
                        session()->setFlashdata('success', 'Selamat Data Photo Diri Anda Berhasil Di Simpan !');
                        echo json_encode(array("status" => 1));
                    }
                    $db->close();
                } else {
                    session()->setFlashdata('error', 'Mohon Maaf Photo Anda Tidak Berhasil Di Simpan !');
                    echo json_encode(array("status" => 1));
                }
            }
        }
    }

    public function viewidentitas()
    {
        $getreg = $this->Musers->get_status_reg();
        $hasil['photo'] = $getreg->photo;
        $hasil['identitas'] = $getreg->identitas;
        $hasil['kelas'] = $getreg->kelas;
        $hasil['akses'] = $getreg->akses;
        $hasil['sekolah'] = $getreg->sekolah;

        $getidentitas = $this->Musers->get_identitas();

        $hasil['fullname'] = $getidentitas->fullname;
        $hasil['jenis_kelamin'] = $getidentitas->jenis_kelamin;
        $hasil['no_telpon'] = $getidentitas->no_telpon;
        $hasil['alamat'] = $getidentitas->alamat;
        $hasil['email'] = $getidentitas->email;
        $hasil['facebook'] = $getidentitas->facebook;
        $hasil['instagram'] = $getidentitas->instagram;
        $hasil['linkedIn'] = $getidentitas->linkedIn;
        $hasil['twetter'] = $getidentitas->tweter;

        if (session()->get('level') == 1) {
            echo view('t_siswa/identitas_siswa/registrasi_identitas', $hasil);
        } else {
            echo view('t_guru/identitas_guru/registrasi_identitas', $hasil);
        }
    }

    public function editview()
    {
        $getidentitas = $this->Musers->get_identitas();
        echo json_encode($getidentitas);
    }

    public function identitasupdate()
    {
        helper(['form', 'url']);
        $request = service('request');

        $getidentitas = $this->Musers->get_identitas();

        $validated = $this->validate([
            'fullname' => [
                'rules' => 'required',
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
            ],
            'no_telpon' => [
                'rules' => 'required',
            ],
            'alamat' => [
                'rules' => 'required',
            ],
        ]);

        if ($validated) {
            $request = service('request');

            $db = db_connect();
            $db->transStart();

            $dataUserdetail['fullname'] = $request->getPost('fullname');
            $dataUserdetail['jenis_kelamin'] = $request->getPost('jenis_kelamin');
            $dataUserdetail['no_telpon'] = $request->getPost('no_telpon');
            $dataUserdetail['alamat'] = $request->getPost('alamat');
            $dataUserdetail['facebook'] = $request->getPost('facebook');
            $dataUserdetail['instagram'] = $request->getPost('instagram');
            $dataUserdetail['tweter'] = $request->getPost('tweter');
            $dataUserdetail['linkedIn'] = $request->getPost('linkedIn');
            $dataUserdetail['updated_at'] = date("Y-m-d h:i:sa");

            $db->table('tbl_user')->update($dataUserdetail, array('id' => session()->get('id')));

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                # Something went wrong.
                $db->transRollback();
                $status = 2;
            } else {
                # Everything is Perfect. 
                # Committing data to the database.
                $db->transCommit();
                $status = 1;
            }

            $db->close();

            if ($status == 2) {
                session()->setFlashdata('error', 'Mohon Maaf Data Identitas Diri Tidak Berhasil Di Simpan !');
                echo json_encode(array("status" => 1));
            } else {
                session()->setFlashdata('success', 'Selamat Data Identitas Diri Anda Sudah Kami Simpan !');
                echo json_encode(array("status" => 1));
            }
        } else {
            session()->setFlashdata('error', 'Mohon maaf data harus lengkap berdasarkan keterangan yang berwarna merah !');
            echo json_encode(array("status" => 1));
        }
    }

    public function viewkelas()
    {
        $getreg = $this->Musers->get_status_reg();

        $hasil['photo'] = $getreg->photo;
        $hasil['identitas'] = $getreg->identitas;
        $hasil['kelas'] = $getreg->kelas;
        $hasil['akses'] = $getreg->akses;
        $hasil['sekolah'] = $getreg->sekolah;


        if (session()->get('level') == 1) {
            $data = $this->Musers->get_view_kelas();
            if ($data) {
                $getguru = $this->Musers->get_view_kode($data->kode_kelas);
                $hasil['id_kelas'] = $data->id_kelas;
                $hasil['kode'] = $data->kode;
                $hasil['nama'] = $data->nama;
                $hasil['jurusan'] = $data->jurusan;
                $hasil['jumlah'] = $data->jumlah;
                $hasil['nama_guru'] = $getguru->fullname;
                $hasil['status'] = "Non Aktif";
            } else {
                $hasil['id_kelas'] = "-";
                $hasil['kode'] = "-";
                $hasil['nama'] = "-";
                $hasil['jurusan'] = "-";
                $hasil['jumlah'] = "-";
                $hasil['nama_guru'] = "-";
                $hasil['status'] = "Non Aktif";
            }

            return view('t_siswa/identitas_siswa/registrasi_kelas', $hasil);
        } else {
            $hasil['kelass'] = $this->Musers->get_user_kelas();
            return view('t_guru/identitas_guru/registrasi_kelas_guru', $hasil);
        }
    }

    public function addkelas()
    {
        helper(['form', 'url']);
        $request = service('request');
        $kode = $request->getPost('kode_kelas');
        $getuserkelas = $this->Musers->get_view_kelas();
        $getviewsekolah = $this->Musers->get_view_kode($kode);

        if ($getviewsekolah) {
            $db = db_connect();
            $db->transStart();

            if ($getuserkelas) {
                $arrkelas = array(
                    'kode_kelas' => $getviewsekolah->kode_kelas,
                    'id_sekolah' => $getviewsekolah->id_sekolah,
                );
                $db->table('tbl_kelas_user')->update($arrkelas, array('id_user' => session()->get('id')));
            } else {
                $arrkelas = array(
                    'id_user' => session()->get('id'),
                    'kode_kelas' => $getviewsekolah->kode_kelas,
                    'id_sekolah' => $getviewsekolah->id_sekolah,
                );
                $db->table('tbl_kelas_user')->insert($arrkelas);
            }

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                # Something went wrong.
                $db->transRollback();
                session()->setFlashdata('error', 'Mohon Maaf Data Photo Diri Anda Tidak Berhasil Di Simpan !');
                echo json_encode(array("status" => 1));
            } else {
                # Everything is Perfect. 
                # Committing data to the database.
                $db->transCommit();
                session()->setFlashdata('success', 'Selamat Data Photo Diri Anda Berhasil Di Simpan !');
                echo json_encode(array("status" => 1));
            }
            $db->close();
        } else {
            session()->setFlashdata('error', 'Mohon Maaf Kode Kelas Anda Tidak Terdaftar !');
        }
    }

    public function viewsekolah()
    {
        $getreg = $this->Musers->get_status_reg();
        $hasil['photo'] = $getreg->photo;
        $hasil['identitas'] = $getreg->identitas;
        $hasil['kelas'] = $getreg->kelas;
        $hasil['akses'] = $getreg->akses;
        $hasil['sekolah'] = $getreg->sekolah;

        $data = $this->Musers->get_sekolah();

        if (session()->get('level') == 1) {
            if ($data) {
                $hasil['nama'] = $data->nama;
                $hasil['alamat'] = $data->alamat;
                $hasil['no_tlp'] = $data->no_tlp;
                $hasil['no_fax'] = $data->no_fax;
                $hasil['kode_pos'] = $data->kode_pos;
                $hasil['status'] = 1;
            } else {
                $hasil['nama'] = "-";
                $hasil['alamat'] = "-";
                $hasil['no_tlp'] = "-";
                $hasil['no_fax'] = "-";
                $hasil['kode_pos'] = "-";
                $hasil['status'] = 2;
            }

            return view('t_siswa/identitas_siswa/registrasi_sekolah', $hasil);
        } else {
            if ($data) {
                $hasil['nama'] = $data->nama;
                $hasil['alamat'] = $data->alamat;
                $hasil['no_tlp'] = $data->no_tlp;
                $hasil['no_fax'] = $data->no_fax;
                $hasil['kode_pos'] = $data->kode_pos;
                $hasil['status'] = 1;
            } else {
                $hasil['nama'] = "-";
                $hasil['alamat'] = "-";
                $hasil['no_tlp'] = "-";
                $hasil['no_fax'] = "-";
                $hasil['kode_pos'] = "-";
                $hasil['status'] = 2;
            }
            return view('t_guru/identitas_guru/registrasi_sekolah_guru', $hasil);
        }
    }

    /* --------------- REGISTRASI GURU ----------------------*/

    public function addkelasguru()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $request = service('request');
        helper(['form', 'url']);

        $db = db_connect();
        $db->transStart();

        $datauserkelas = array(
            'id_user' => session()->get('id'),
            'kode_kelas' => $randomString,
            'id_sekolah' => '',
        );

        $db->table('tbl_kelas_user')->insert($datauserkelas);

        $datakelas = array(
            'id_kelas' => $request->getPost('id_kelas'),
            'kode' => $randomString,
            'nama' => $request->getPost('nama'),
            'jurusan' => $request->getPost('jurusan'),
            'jumlah' => $request->getPost('jumlah'),
        );
        $db->table('kelas')->insert($datakelas);

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            # Something went wrong.
            $db->transRollback();
            session()->setFlashdata('error', 'Mohon Maaf Data Photo Diri Anda Tidak Berhasil Di Simpan !');
            echo json_encode(array("status" => 1));
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $db->transCommit();
            session()->setFlashdata('success', 'Selamat Data Photo Diri Anda Berhasil Di Simpan !');
            echo json_encode(array("status" => 1));
        }
        $db->close();
    }

    public function editViewkelasguru($id)
    {
        $data = $this->Musers->get_data_kelas($id);
        echo json_encode($data);
    }

    public function editkelasguru()
    {
        $request = service('request');
        $id_kelas = $request->getPost('id_kelas');
        $datakelas = array(
            'nama' => $request->getPost('nama'),
            'jurusan' => $request->getPost('jurusan'),
            'jumlah' => $request->getPost('jumlah'),
        );

        $data = $this->Musers->updatekelasguru($datakelas, array('id_kelas' => $id_kelas));

        session()->setFlashdata('success', 'Selamat Data Photo Diri Anda Berhasil Di Simpan !');
        echo json_encode(array("status" => 1));
    }


    public function editViewSekolahguru()
    {
        $data = $this->Musers->getsekolahguru();
        echo json_encode($data);
    }

    public function simpanSekolahguru()
    {
        $request = service('request');
        helper(['form', 'url']);

        $db = db_connect();
        $db->transStart();

        $id_sekolah = uniqid();

        $datausersekolah = array(
            'id_sekolah' => $id_sekolah,
            'nama' => $request->getPost('nama'),
            'alamat' => $request->getPost('alamat'),
            'kode_pos' => $request->getPost('kode_pos'),
            'no_tlp' => $request->getPost('no_tlp'),
            'no_fax' => $request->getPost('no_fax'),
        );

        $db->table('sekolah')->insert($datausersekolah);

        $ubahDtUser = array(
            'id_sekolah' => $id_sekolah,
        );

        $db->table('tbl_user')->update($ubahDtUser, array('id' => session()->get('id')));

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            # Something went wrong.
            $db->transRollback();
            session()->setFlashdata('error', 'Mohon Maaf Data Photo Diri Anda Tidak Berhasil Di Simpan !');
            echo json_encode(array("status" => 1));
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $db->transCommit();
            session()->setFlashdata('success', 'Selamat Data Photo Diri Anda Berhasil Di Simpan !');
            echo json_encode(array("status" => 1));
        }
        $db->close();
    }

    public function updateViewSekolahguru()
    {
        $request = service('request');
        $id_sekolah = $request->getPost('id_sekolah');
        $datausersekolah = array(
            'nama' => $request->getPost('nama'),
            'alamat' => $request->getPost('alamat'),
            'kode_pos' => $request->getPost('kode_pos'),
            'no_tlp' => $request->getPost('no_tlp'),
            'no_fax' => $request->getPost('no_fax'),
        );

        $data = $this->Musers->updateDataSekolahGuru($datausersekolah, array('id_sekolah' => $id_sekolah));
        if ($data) {
            session()->setFlashdata('success', 'Selamat Data Photo Diri Anda Berhasil Di Simpan !');
            echo json_encode(array("status" => 1));
        } else {
            session()->setFlashdata('error', 'Mohon Maaf Data Photo Diri Anda Tidak Berhasil Di Simpan !');
            echo json_encode(array("status" => 1));
        }
    }
}
