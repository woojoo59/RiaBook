<?php
//테이블마다 만드는거 추천
class img_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function add($foridx, $imgname, $idxcategory){
        $this->db->insert('img',array(
            'foridx'=>$foridx,
            'imgname'=>$imgname,
            'idxcategory'=>$idxcategory
        ));
    }

    function selectimg($foridx,$idxcategory){
        $sql = 'select imgname from img where foridx = ? and idxcategory = ?';
        return $this->db->query($sql, array($foridx,$idxcategory))->row();
    }

    function edit($imgname,$foridx,$idxcategory){
        $sql = 'update img set imgname = ? where foridx = ? and idxcategory = ? ';
        $this->db->query($sql, array($imgname,$foridx,$idxcategory));
    }

    function imgnameselect($imgname){
        $sql = 'select * from img where imgname = ?';
        return $this->db->query($sql,$imgname)->row();
    }

    function todayrank($idx){
        $sql = 'select imgname as img from img where foridx = ?';
        return $this->db->query($sql,$idx)->row();
    }
}