<?php
//테이블마다 만드는거 추천
class continue_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function add($useridx,$idx,$novelidx){
        $this->db->insert('continue',array(
            'useridx'=>$useridx,
            'idx'=>$idx,
            'novelidx'=>$novelidx
        ));
    }

    function delete($useridx,$idx){
        $sql = 'delete from `continue` where useridx = ? and idx = ?';
        $this->db->query($sql,array($useridx,$idx));
    }

    function duselect($useridx,$idx){
        $sql = 'select * from `continue` where useridx = ? and idx = ?';
        return $this->db->query($sql,array($useridx, $idx))->row();
    }


    function myselect($useridx){
        $sql = 'select * from `continue` as a left join novellist as b on a.idx = b.idx
where b.status = 0 and a.useridx = ? order by `continue` desc';
        return $this->db->query($sql,$useridx)->result();
    }

    function deletenovel($idx){
        $sql = 'delete from `continue` where idx = ?';
        $this->db->query($sql,$idx);
    }

    function denovel($change,$default){
        $sql = 'update `continue` set novelidx = ? where novelidx = ?';
        $this->db->query($sql,array($change,$default));
    }

    function denoveled($novelidx){
        $sql = 'delete from `continue` where novelidx = ?';
        $this->db->query($sql,$novelidx);
    }
}