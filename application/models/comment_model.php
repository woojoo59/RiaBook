<?php
//테이블마다 만드는거 추천
class comment_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function selectcomment($foridx,$category){
        $sql = 'select * from comment where foridx = ? and category = ? and comg = 0';
        return $this->db->query($sql,array($foridx,$category))->result();
    }

    function comment($foridx,$category,$comg,$creator,$content){
        $this->db->insert('comment',array(
            'foridx'=>$foridx,
            'creator'=>$creator,
            'content'=>$content,
            'comg'=>$comg,
            'created'=>date("Y-m-d H:i:s"),
            'category'=>$category
        ));
    }

    function editcomment($content,$cidx){
        $sql = 'update comment set content = ? where cidx = ?';
        $this->db->query($sql, array($content,$cidx));
    }

    function idxdelete($foridx,$category){
        $sql = 'delete from comment where foridx = ? and category = ?';
        $this->db->query($sql,array($foridx,$category));
    }

    function deletecomment($cidx){
        $sql = 'delete from comment where cidx = ?';
        $this->db->query($sql,array($cidx));
    }

    function removecomment($cidx){
        $sql = 'update comment set creator = 0 where cidx = ?';
        $this->db->query($sql,$cidx);
    }

    function selectrecomment($comg){
        $sql = 'select * from comment where comg = ?';
        return $this->db->query($sql,$comg)->result();
    }

    function idxselect($cidx){
        $sql = 'select * from comment where cidx = ?';
        return $this->db->query($sql,$cidx)->row();
    }

    function recommentcnt($cidx){
        $sql = 'select * from comment where comg = ?';
        return $this->db->query($sql,$cidx)->num_rows();
    }

}