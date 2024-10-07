<?php
//테이블마다 만드는거 추천
class report_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function add($useridx,$title,$content,$class,$foridx,$date){
        $this->db->insert('report',array(
            'useridx'=>$useridx,
            'title'=>$title,
            'content'=>$content,
            'class'=>$class,
            'foridx'=>$foridx,
            'repotdate'=>$date
        ));
    }

    function select(){
        $sql = 'select * from report order by reportidx desc';
        return $this->db->query($sql)->result();
    }

    function idxselect($reportidx){
        $sql = 'select * from report where reportidx = ?';
        return $this->db->query($sql,$reportidx)->row();
    }

    function delete($reportidx){
        $sql = 'delete from report where reportidx = ?';
        $this->db->query($sql,$reportidx);
    }

    function fordelete($foridx,$class){
        $sql = 'delete from report where foridx = ? and class = ?';
        $this->db->query($sql,array($foridx,$class));
    }

}