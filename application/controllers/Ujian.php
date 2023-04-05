<?php

/**
 * @author dadan <dadanhidyt@gmail.com>
 */
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
    //bagian simpan jawaban dan nanti masuk ke nilai
    public function simpan()
    {
        if (!$this->input->is_ajax_request()) {
            $dat = $this->input->post();
            $dat['nisn'] = $this->auth()->nisn;
            $select = $this->db->get_where('tb_dump_jawaban', [
                'id_soal' => $dat['id_soal'],
                'id_mapel' => $dat['id_mapel'],
                'nisn' => $this->auth()->nisn,
                'type' => $dat['type'],
            ]);
            if ($select->num_rows() >= 1) {
                $this->db->reset_query();
                $this->db->where('id_soal', $dat['id_soal']);
                if ($this->db->update('tb_dump_jawaban', $dat)) {
                    echo 'Y';
                } else {
                    echo "N";
                }
            } else {
                if ($this->db->insert('tb_dump_jawaban', $dat)) {
                    echo 'Y';
                } else {
                    echo "N";
                }
            }
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
        $data_siswa_ujian = $this->db->get('tb_siswa_ujian');
        $dat = $data_siswa_ujian->row();
        //membuat data ujian
        if ($data_siswa_ujian->num_rows() === 0) {
            $this->db->insert('tb_siswa_ujian', [
                'nisn' => $this->auth()->nisn,
                'id_ujian' => $id_ujian,
                'waktu_submit' => time(),
                'sisa_menit' => $lama_ujian,
                'waktu_akhir' => strtotime("+{$lama_ujian} minute"),
                'ip' => $_SERVER['REMOTE_ADDR'],
            ]);
            return redirect(site_url("ujian/{$id_ujian}/{$id_mapel}/1.html"));
        } else {
            //me
            $waktu = $dat->waktu_akhir - time();
            $menit = floor($waktu / 60);
            $this->db->reset_query();
            $this->db->where('id', $dat->id);
            $this->db->update('tb_siswa_ujian', ['sisa_menit' => $menit]);
            //waktu habis
            if ($dat->selesai == 1) {
                $this->session->set_flashdata('msg', "Ujian telah berakhir dan sudah selesai!");
                return redirect(site_url('home'));
            } else {
                //mendapatkan soal berdasarkan id ujian dan nomor soal
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
                if ($row = $this->m_ujian->get_jawaban($this->auth()->nisn, $id_ujian, $id_mapel, $soal->id_soal)) {
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
                    'id_data_siswa_ujian' => $dat->id,
                    'jawaban_sekarang' => $jawaban_sekarang,
                    'soal' => $soal,
                );
                $this->setTitle("Soal no " . $id_mapel);
                $this->view('ujian/mulai', compact('data'));
                return 0;
            }
        }
    }
    public function selesai()
    {
        $sisa_waktu = $this->input->post('sisa_waktu');
        //meload model siswa_ujian
        $this->load->model('m_siswa_ujian');
        //meload model ujian
        $this->load->model('m_ujian');
        //meload model_soal
        $this->load->model('m_soal');
        //id siswa ujian 
        $id = $this->input->post('id_data_siswa_ujian');
        //ambil data siswa ujian beradasarkan id nya dan nisn siswa
        $data = $this->m_siswa_ujian->get_siswa_ujian($this->auth()->nisn, $id);
        //jika data yang di ambil ada > 1
        if ($data->num_rows() == 1) {
            //fetch data nya
            $data_siswa_ujian = $data->row();
            //mengambil data ujian pada tabel ujian berdasarkan id ujian dan nisn
            $data_ujian = $this->m_ujian->get_ujian($this->auth()->nisn, $data_siswa_ujian->id_ujian)->row();
            //mendapatkan soal berdasaran id ujian
            $data_soal = $this->m_soal->get_soal($data_siswa_ujian->id_ujian);
            //mendefinisikan variabel
            $jmlh_pg = $data_ujian->jmlh_pg;
            $detail_benar = [];
            $detail_salah = [];
            $detail_kosong = [];
            $jmlh_benar = 0;
            $jmlh_kosong = 0;
            $jmlh_salah = 0;
            //menghitung berapa yang di isi, berapa yang tidak  dan berapa yang kosong
            foreach ($data_soal->result_object() as $row) {
                //mendaptkan data berdasrkan id soal pada tabel dump jawaban
                $query_dump_jawaban = $this->db->get_where('tb_dump_jawaban', [
                    'id_ujian' => $data_siswa_ujian->id_ujian,
                    'nisn' => $this->auth()->nisn,
                    'id_soal' => $row->id_soal,
                ]);
                //jika data nya 0 maka soal di anggap belum di jawab
                if ($query_dump_jawaban->num_rows() === 0) {
                    $detail_kosong[] = $row->no_soal;
                    $jmlh_kosong++;
                } else {
                    $result = $query_dump_jawaban->row();
                    //jika jawaban sama dengan kunci jawaban
                    if ($result->jawaban_sekarang === $row->kunci) {
                        $detail_benar[] = $row->no_soal;
                        $jmlh_benar++;
                    } else {
                        $detail_salah[] = $row->no_soal;
                        $jmlh_salah++;
                    }
                }
            }

            $this->db->trans_start();
            $this->db->insert('tb_hasil_ujian', [
                'waktu' => time(),
                'kosong' => $jmlh_kosong,
                'benar' => $jmlh_benar,
                'salah' => $jmlh_salah,
                'poin' => ($jmlh_benar / $data_soal->num_rows()) * 100,
                'id_ujian' => $data_siswa_ujian->id_ujian,
                'nisn' => $this->auth()->nisn,
                'detail_benar' => implode('|', $detail_benar),
                'detail_salah' => implode('|', $detail_salah),
                'detail_kosong' => implode('|', $detail_kosong),
            ]);


            $this->db->where('nisn', $this->auth()->nisn);
            $this->db->where('id', $id);
            $update = $this->db->update('tb_siswa_ujian', [
                'sisa_waktu' => $sisa_waktu,
                'selesai' => 1,
            ]);
            if ($update) {
                echo json_encode([
                    'status' => true,
                    'msg' => "Ujian berhasil di simpan!",
                ]);
                $this->db->trans_commit();
            } else {
                echo json_encode([
                    'status' => false,
                    'msg' => "Ujian gagal di simpan!",
                ]);
                $this->db->trans_rollback();
            }
        }
    }
    public function waktu_server()
    {
        echo date("M d, Y H:i:s");
    }
    public function summary($id)
    {
        echo $id;
    }
}
