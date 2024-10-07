<?php
//테이블마다 만드는거 추천
class Topic_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    public function gets(){
        return $this->db->query('select * from topic')->result();
    }

    public function get($topic_id){
        $this->db->select('id');
        $this->db->select('title');
        $this->db->select('description');
        $this->db->select('UNIX_TIMESTAMP(created) AS created');
        return $this->db->get_where('topic', array('id'=>$topic_id))->row();
    }

    function add($title, $description){
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('topic',array(
            'title'=>$title,
            'description'=>$description,
            // 'created'=>date('Y-m-d H:i:s')
        ));
        
        return $this->db->insert_id();
    }
}