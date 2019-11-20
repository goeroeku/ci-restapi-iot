<?php

class Iot_model extends CI_Model
{
	private $table = "data";

    public function get($alat=null,$all=null)
    {
        if ($alat==null) {
            return $this->db->get($this->table)->result_array();
        }
        else {
            if ($all==null) {
                return $this->db->order_by('id','DESC')->get_where($this->table,['alat'=>$alat])->result_array();
            }
            else {
                return $this->db->order_by('id','DESC')->get_where($this->table,['alat'=>$alat],1,0)->result_array();
            }
        }
	}

    public function add($data) {
        $this->db->insert($this->table,$data);
        return $this->db->affected_rows();
    }
}
