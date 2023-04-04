<?php
class m_ujian extends CI_Model{
    public $tabel = 'tb_ujian';


    public function get_ujian($nisn = null, $id_ujian = null)
    {
        $this->db->select('tb_siswa.id_kelas, tb_ujian.*,tb_mapel.*');
        $this->db->join('tb_siswa','tb_siswa.id_kelas = tb_det_ujian.id_kelas',"INNER");
        $this->db->join('tb_ujian','tb_ujian.id_ujian = tb_det_ujian.id_ujian',"INNER");
        $this->db->join('tb_mapel','tb_mapel.id_mapel = tb_ujian.id_mapel',"INNER");
        if($nisn){
            $this->db->where('tb_siswa.nisn', $nisn);
        }
        if($id_ujian){
            $this->db->where('tb_ujian.id_ujian',$id_ujian);
        }
        $dat = $this->db->get('tb_det_ujian');
        if($dat->num_rows() >= 1){
            return $dat;
        }
    }
    public function get_waktu_ujian($id_ujian){
        $this->db->select('total_waktu');
        $this->db->where('id_ujian',$id_ujian);
        $row = $this->db->get($this->tabel);
        if($row->num_rows() === 1){
            return intval($row->row()->total_waktu);
        }
    }
}