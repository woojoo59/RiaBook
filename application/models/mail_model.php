<?php
//테이블마다 만드는거 추천
class mail_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function add($touseridx,$fromuseridx,$subject,$content,$subdate){
        $this->db->insert('mail',array(
            'touseridx'=>$touseridx,
            'fromuseridx'=>$fromuseridx,
            'subject'=>$subject,
            'content'=>$content,
            'subdate'=>$subdate
        ));
    }

    function idxselect($mailidx){
        $sql = 'select * from mail where mailidx = ?';
        return $this->db->query($sql,$mailidx)->row();
    }

    function defaultfrom($useridx){
        $sql = 'select * from mail where touseridx = ? and tostatus = 0 order by mailidx desc';
        return $this->db->query($sql,$useridx)->result();
    }

    function from($useridx,$status){
        $sql = 'select * from mail where touseridx = ? and status = ? and tostatus = 0 order by mailidx desc';
        return $this->db->query($sql,array($useridx,$status))->result();
    }


    function to($useridx){
        $sql = 'select * from mail where fromuseridx = ? and fromstatus = 0 order by mailidx desc';
        return $this->db->query($sql,$useridx)->result();
    }

    function open($mailidx){
        $sql = 'update mail set status = 1 where mailidx = ?';
        $this->db->query($sql,$mailidx);
    }

    function toremove($mailidx){
        $sql = 'update mail set tostatus = 1 where mailidx = ?';
        $this->db->query($sql,$mailidx);
    }

    function fromremove($mailidx){
        $sql = 'update mail set fromstatus = 1 where mailidx = ?';
        $this->db->query($sql,$mailidx);
    }

    function delete($mailidx){
        $sql = 'delete from mail where mailidx = ?';
        $this->db->query($sql,$mailidx);
    }

}