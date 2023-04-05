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
}
