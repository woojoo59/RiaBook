<?php
//테이블마다 만드는거 추천
class recommend_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function add($idx, $useridx, $date){
        $this->db->insert('recommend',array(
            'idx'=>$idx,
            'useridx'=>$useridx,
            'date'=>$date
        ));
    }
    
    function dateselectcnt($date,$idx){
        $sql = "select count(*) as cnt,(select count(*) from recommend where date = ? and idx = ?) as col from recommend where date = ?";
        return $this->db->query($sql,array($date,$idx,$date))->row();
    }

    function idxselect($idx,$date){
        $sql = 'select * from recommend where idx = ? and date > ? order by date desc';
        return $this->db->query($sql,array($idx,$date))->row();
    }

    function today($date){
        $sql = 'select a.*,c.imgname as img,d.nickname as nick, sum(e.hit) as hit, count(e.novelidx) as episode from novellist as a 
                left join recommend as b on a.idx = b.idx
                left join img as c on a.idx = c.foridx
                left join users as d on a.creator = d.useridx
                left join novel as e on a.idx = e.idx
                where b.`date`=? and a.status = 0
                GROUP BY b.ridx order by b.ridx';
        return $this->db->query($sql,$date)->result();
    }

    function deleteafter($idx,$date){
        $sql = 'delete from recommend where idx = ? and `date` >= ?';
        $this->db->query($sql,array($idx,$date));
    }
    function deleteday($idx,$date){
        $sql = 'delete from recommend where idx = ? and `date` = ?';
        $this->db->query($sql,array($idx,$date));
    }

    function deletenovel($idx){
        $sql = 'delete from recommend where idx = ?';
        $this->db->query($sql,$idx);
    }

    function recommendlist($date){
        $sql = 'select * from recommend as a left join novellist as b on a.idx = b.idx where `date`=? order by ridx';
        return $this->db->query($sql,$date)->result();
    }
}