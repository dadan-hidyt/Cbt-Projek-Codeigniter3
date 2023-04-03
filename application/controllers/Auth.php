<?php

class Auth extends CI_Controller
{
    use ControllerTrait;
    //cek login
    public function logout(){
        
    }
    public function cek_login()
    {
        $this->load->model('m_siswa');
        if (!$this->input->is_ajax_request()) {
            //mendapatkan data user dari model siswa
            $fetch = $this->m_siswa->get_by_nisn($this->input->post('np', true));
            $data = $fetch->row();
            //cek apakah nisn ada pada nomor
            if ($fetch->num_rows() === 1) {
                if ($data->password === $this->input->post('pw')) {
                    //membuat session untuk login siswa
                    if ($this->m_siswa->buat_session($data->nisn)) {
                        echo $this->responseJson([
                            'status' => true,
                            'message' => "Selamat datang " . $data->nama . " Anda akan di arahkan ke halaman home",
                        ]);
                    } else {
                        echo $this->responseJson([
                            'status' => false,
                            'message' => "Gagal saat membuat token login!",
                        ]);
                    }
                } else {
                    echo $this->responseJson([
                        'status' => false,
                        'message' => "Password yang anda ketikan tidak benar",
                    ]);
                }
            } else {
                echo $this->responseJson([
                    'status' => false,
                    'message' => "NO Peserta tidak di temukan! Silahkan cek lagi atau hubugi operator",
                ]);
            }
        } else {
            return redirect(base_url('login'));
        }
    }
}
