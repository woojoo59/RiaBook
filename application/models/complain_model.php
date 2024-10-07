<?php
//테이블마다 만드는거 추천
class complain_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function addcomplain($subject, $content, $creator){
        $this->db->insert('complain',array(
            'subject'=>$subject,
            'content'=>$content,
            'creator'=>$creator,
            'option'=>0,
            'comment'=>null
        ));
        return $this->db->insert_id();
    }

    function mycomplain($useridx){
        $sql = 'select * from complain where creator = ? order by complainidx desc';
        return $this->db->query($sql,$useridx)->result();
    }

    function mastercomplain(){
        $sql = 'select * from complain where status = 0 order by complainidx desc';
        return $this->db->query($sql)->result();
    }

    function masterwhere($option){
        $sql = 'select * from complain where `option` = ? and status = 0 order by complainidx desc';
        return $this->db->query($sql,$option)->result();
    }

    function index($complainidx){
        $sql = 'select a.*,b.nickname as nick from complain as a
                left join users as b
                on a.creator = b.useridx
                where complainidx = ?';
        return $this->db->query($sql,$complainidx)->row();
    }

    function edit($complainidx,$subject,$content){
        $sql = 'update complain set subject = ?, content = ?, `option` = 0, comment = null where complainidx = ?';
        $this->db->query($sql,array($subject,$content,$complainidx));
    }

    function comment($complainidx,$comment){
        $sql = 'update complain set `option` = 1, comment = ? where complainidx = ?';
        $this->db->query($sql,array($comment,$complainidx));
    }

    function delete($complainidx){
        $sql = 'delete from complain where complainidx = ?';
        $this->db->query($sql,$complainidx);
    }

    function masterremove($complainidx){
        $sql = 'update complain set status = 1 where complainidx = ?';
        $this->db->query($sql,$complainidx);
    }
}