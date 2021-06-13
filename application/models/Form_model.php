<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_model extends CI_Model
{
    public function insert_row($data)
    {
    $this->load->database();
    return $this->db->insert('staff',$data);
    }


    public function log_get($mail)
    {
        $this->load->database();
        $query = $this->db->get_where('staff', array('mail' => $mail));
        return $query->row_array();
    }

    public function table_row(){
        $this->load->database();
        $query = $this->db->query('SELECT*FROM staff');
        $res =  $query->result('array');
        return $res;
    }

    public function csv(){
        $this->load->database();
        $this->db->trans_start();
        $query = $this->db->query('SELECT*FROM staff');
        $res =  $query->result('array');
        return $res;
        $this->db->trans_complete();
    }

    public function update_row($id,$data){

        $this->load->database();

        return $this->db->where('id', $id)
                ->update('staff', $data);
    }

    public function delete_row($id){
        $this->load->database();
        return $this->db->where('id', $id)
            ->delete('staff');
    }

}
