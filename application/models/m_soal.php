<?php
class m_soal extends CI_Model{
    public $tb_soal = 'tb_soal';
    public function get_soal($id_ujian,$id_soal){
        $this->db->select('*');
        $this->db->from($this->tb_soal);
        $this->db->where('id_ujian',$id_ujian);
        $this->db->where('id_soal',$id_soal);
        $this->db->order_by('id_soal','rand()');
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
        if($row->num_rows() > 1){
            return $row->row()->id_soal;
        }
    }
    public function get_max_soal($id_ujian){
        $this->db->select_max('no_soal','nilai_max');
        $this->db->where('id_ujian',$id_ujian);
        return $this->db->get($this->tb_soal)->row()->nilai_max;

    }
   
    public function get_min_soal($id_ujian){
        $this->db->select_min('no_soal','nilai_min');
        $this->db->where('id_ujian',$id_ujian);
        return $this->db->get($this->tb_soal)->row()->nilai_min;

    }
    public function get_back_soal($current,$id_ujian){
        $this->db->select('id_soal');
        $this->db->where('id_ujian',$id_ujian);
        $this->db->where('id_soal < ',$current+1);
        $row = $this->db->get($this->tb_soal);
        if($row->num_rows() > 1){
            return $row->row()->id_soal;
        }
    }
}