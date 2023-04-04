<?php
class Ujian extends Front
{
    public function __construct()
    {
        parent::__construct();
        if ($this->cek_login() === false) {
            return redirect(site_url('login'));
        }
    }
    public function confirm($id)
    {
        $this->setTitle("Konfirmasi Ujian");
        $this->load->model('m_ujian');
        $det_ujian = [];
        $ujian = $this->m_ujian->get_ujian($this->auth()->nisn, $id);
        if (!is_null($ujian)) {
            $det_ujian = $ujian->row();
            $this->view('ujian/confirm', compact('det_ujian'));
        } else {
            return redirect('home');
        }
    }
    public function mulai($id_ujian = null, $id_mapel = null, $nomor_soal = null)
    {
        $this->load->model('m_ujian');
        $this->load->model('m_soal');
        $lama_ujian = $this->m_ujian->get_waktu_ujian($id_ujian);
        //cek dulu apak siswa sudah melakukan ujian atau belum
        $this->db->where('nisn', $this->auth()->nisn);
        $this->db->where('id_ujian', $id_ujian);
        $uj = $this->db->get('tb_siswa_ujian');
        $dat = $uj->row();
        //reset query
        if ($uj->num_rows() === 0) {
            $this->db->insert('tb_siswa_ujian', [
                'nisn' => $this->auth()->nisn,
                'id_ujian' => $id_ujian,
                'waktu_submit' => time(),
                'sisa_menit' => $lama_ujian,
                'waktu_akhir' => strtotime("+{$lama_ujian} minute"),
                'ip' => $_SERVER['REMOTE_ADDR'],
            ]);
        } else {
            $waktu = $dat->waktu_akhir - time();
            $menit = floor($waktu / 60);
            $this->db->reset_query();
            $this->db->where('id', $dat->id);
            $this->db->update('tb_siswa_ujian', ['sisa_menit' => $menit]);
            //waktu habis
            if ($dat->sisa_menit === 0 && $menit == 0) {
                echo "Waktu Habis!";
            } else {
                $soal_ujian = $this->m_soal->get_soal($id_ujian, $nomor_soal);
                $soal = [];
                if ($soal_ujian) {
                    $soal = $soal_ujian->row();
                } else {
                    return redirect(site_url("ujian/{$id_ujian}/{$id_mapel}/1.html"));
                }
                //mendaptkan next soal dan back soal
                $next = $this->m_soal->get_next_soal($nomor_soal, $id_ujian);
                $back = $this->m_soal->get_back_soal($nomor_soal, $id_ujian);
                //jawaban serkarang
                $jawaban_sekarang = null;
                if($row = $this->m_ujian->get_jawaban($this->auth()->nisn,$id_ujian,$id_mapel,$soal->id_soal)){
                    $jawaban_sekarang = $row->jawaban_sekarang;
                }
                $data = array(
                    'sisa_waktu' => $waktu,
                    'id_ujian' => $id_ujian,
                    'id_mapel' => $id_mapel,
                    'soal_no' => $nomor_soal,
                    'next' => $nomor_soal + 1,
                    'back' => $nomor_soal - 1,
                    'current' => $nomor_soal,
                    'max' => $this->m_soal->get_max_soal($id_ujian),
                    'min' => $this->m_soal->get_min_soal($id_ujian),
                    'waktu_akhir' => $dat->waktu_akhir,
                    'jawaban_sekarang' => $jawaban_sekarang,
                    'soal' => $soal,
                );
                $this->setTitle("Soal no " . $id_mapel);
                $this->view('ujian/mulai', compact('data'));
                return 0;
            }
        }
    }
}
