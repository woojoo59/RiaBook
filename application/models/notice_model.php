<?php
//테이블마다 만드는거 추천
class notice_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }


    function add($foridx,$title,$content){
        $this->db->insert('notice',array(
            'foridx'=>$foridx,
            'title'=>$title,
            'content'=>$content
        ));
        return $this->db->insert_id();
    }

    function select($where,$index){
        $sql = 'select * from notice where '.$where.' = ? order by noticeidx desc';
        return $this->db->query($sql, $index)->result();
    }

    function rowidx($noticeidx){
        $sql = 'select * from notice where noticeidx = ?';
        return $this->db->query($sql,$noticeidx)->row();
    }

    function editnotice($title,$content,$noticeidx){
        $sql = 'update notice set title = ?, content = ? where noticeidx = ?';
        $this->db->query($sql,array($title, $content, $noticeidx));
    }

    function delete($noticeidx){
        $sql = 'delete from notice where noticeidx = ?';
        $this->db->query($sql,$noticeidx);
    }

    function novelnotice($foridx){
        $sql = 'select * from notice where foridx = ? order by noticeidx desc';
        return $this->db->query($sql,$foridx)->result();
    }
}