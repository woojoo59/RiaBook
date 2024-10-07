<?php
//테이블마다 만드는거 추천
class Usertbl_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function gets(){
        return $this->db->query('select * from usertbl')->result();
    }

    function add($option)
    {
        $this->db->set('email', $option['email']);
        $this->db->set('password', $option['password']);
        $this->db->set('created', 'now()', false);
        $this->db->insert('usertbl');
        $result = $this->db->insert_id();
        return $result;
    }
    
    function GetByEmail($option)
    {
        return $this->db->get_where('usertbl', array('email'=>$option['email']))->row();
    }
}