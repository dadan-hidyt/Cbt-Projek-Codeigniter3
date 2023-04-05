<?php

class m_siswa_ujian extends CI_Model
{
    public function get_siswa_ujian($nisn, $id = null)
    {
        $this->db->where('nisn', $nisn);
        if ($id) {
            $this->db->where('id', $id);
        }
        return $this->db->get('tb_siswa_ujian');
    }
    public function get_siswa_ujian_full($nisn, $id = null)
    {
        $this->db->select('tb_siswa_ujian.*');
        $this->db->select('tb_siswa.*');
        $this->db->select('tb_ujian.*');
        $this->db->select('tb_mapel.*');
        $this->db->select('tb_hasil_ujian.*');
        $this->db->where('tb_siswa.nisn', $nisn);
        if ($id) {
            $this->db->where('tb_siswa_ujian.id', $id);
        }
        $this->db->join('tb_ujian', 'tb_ujian.id_ujian = tb_siswa_ujian.id_ujian');
        $this->db->join('tb_siswa', 'tb_siswa.nisn = tb_siswa.nisn');
        $this->db->join('tb_hasil_ujian', ' tb_hasil_ujian.id_ujian = tb_siswa_ujian.id_ujian');
        $this->db->join('tb_hasil_ujian hasil_ujian_a', ' hasil_ujian_a.nisn = tb_siswa.nisn');
        $this->db->join('tb_mapel', ' tb_mapel.id_mapel = tb_ujian.id_mapel');
        $this->db->group_by('tb_siswa_ujian.nisn');
        $fetch = $this->db->get('tb_siswa_ujian');
        if ($fetch->num_rows() > 0) {
            return $fetch;
        }
    }
}
