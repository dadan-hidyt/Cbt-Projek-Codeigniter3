<?php
class m_soal extends CI_Model{
    public $tb_soal = 'tb_soal';
    public function get_soal($id_ujian,$id_soal){
        $this->db->select('*');
        $this->db->from($this->tb_soal);
        $this->db->where('id_ujian',$id_ujian);
        $this->db->where('id_soal',$id_soal);
        $row = $this->db->get();
        if($row->num_rows() > 0) {
            return $row;
        }
    }
    public function get_next_soal($current,$id_ujian){
        $this->db->select('id_soal');
        $this->db->where('id_ujian',$id_ujian);
        $this->db->where('id_soal > ',$current);
        $row = $this->db->get($this->tb_soal);
        if($row->num_rows() === 1){
            return $row->row()->id_soal;
        }
    }
    public function get_back_soal($current,$id_ujian){
        $this->db->select('id_soal');
        $this->db->where('id_ujian',$id_ujian);
        $this->db->where('id_soal < ',$current);
        $row = $this->db->get($this->tb_soal);
        if($row->num_rows() === 1){
            return $row->row()->id_soal;
        }
    }
}