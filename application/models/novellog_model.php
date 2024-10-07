<?php
//테이블마다 만드는거 추천
class novellog_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function new($idx,$category){
        $this->db->insert('novellog',array(
            'logdate'=>date('Y-m-d'),
            'idx'=>$idx,
            'dayhit'=>0,
            'dayrecommend'=>0,
            'dayprefer'=>0,
            'category'=>$category
        ));
        return $this->db->insert_id();
    }

    function imsi($idx,$category){
        $sql = 'update novellog set category = ? where idx = ?';
        $this->db->query($sql, array($category,$idx));
    }

    function selectlog($idx,$startdate,$enddate){
        $sql = 'select * from novellog where idx = ? and logdate >= ? and logdate <= ?';
        return $this->db->query($sql, array($idx,$startdate,$enddate))->result();
    }

    function dateselect($startdate,$enddate,$one,$two,$three){
        $sql = 'select * from novellog where logdate >= ? and logdate <= ? order by '.$one.' DESC, '.$two.' DESC, '.$three.' DESC';
        return $this->db->query($sql, array($startdate,$enddate))->result();
    }

    function today(){
        $sql = 'select b.*, c.imgname as img, d.nickname as nick, sum(e.hit) as hit, count(e.novelidx) as episode from novellog as a
                left join novellist as b on a.idx = b.idx
                left join img as c on a.idx = c.foridx
                left join users as d on b.creator = d.useridx
                left join novel as e on a.idx = e.idx
                where b.status = 0
                GROUP BY logidx
                order by logdate desc,dayhit desc, dayrecommend desc, dayprefer desc,b.created desc';
        return $this->db->query($sql)->result();
    }

    function today1(){
        $sql = 'select * from novellog as a left join novellist as b on a.idx = b.idx group by logidx order by logdate desc, dayhit desc, dayrecommend desc, dayprefer desc, b.created desc';
        return $this->db->query($sql)->result();
    }

    function categoryrank($startdate,$enddate,$one,$two,$three,$category){
        $sql = 'select b.idx,sum(dayhit) as hit,sum(dayrecommend) as recommend, sum(dayprefer) as prefer from novellog as a 
        left join novellist as b on a.idx = b.idx 
        where logdate >=? and logdate <=? and b.status = 0 and b.category = ? 
        group by a.idx having '.$one.' !=0 order by '.$one.' DESC, '.$two.' DESC, '.$three.' DESC, b.created desc';
        return $this->db->query($sql, array($startdate,$enddate,$category))->result();
    }

    function rank($startdate,$enddate,$one,$two,$three){
        $sql = 'select b.idx,sum(dayhit) as hit,sum(dayrecommend) as recommend, sum(dayprefer) as prefer from novellog as a left join novellist as b on a.idx = b.idx where logdate >=? and logdate <=? and b.status = 0 group by a.idx order by '.$one.' DESC, '.$two.' DESC, '.$three.' DESC, b.created desc';
        return $this->db->query($sql, array($startdate,$enddate))->result();
    }



    function addhit($idx){
        $sql = 'update novellog set dayhit= dayhit+1 where idx = ? and logdate ="'.date('Y-m-d').'"';
        $this->db->query($sql, $idx);
    }

    function addrecommend($idx){
        $sql = 'update novellog set dayrecommend= dayrecommend+1 where idx = ? and logdate ="'.date('Y-m-d').'"';
        $this->db->query($sql, $idx);
    }
    function minusrecommend($idx){
        $sql = 'update novellog set dayrecommend= dayrecommend-1 where idx = ? and logdate ="'.date('Y-m-d').'"';
        $this->db->query($sql, $idx);
    }

    function addprefer($idx){
        $sql = 'update novellog set dayprefer= dayprefer+1 where idx = ? and logdate ="'.date('Y-m-d').'"';
        $this->db->query($sql, $idx);
    }
    function minusprefer($idx){
        $sql = 'update novellog set dayprefer= dayprefer-1 where idx = ? and logdate ="'.date('Y-m-d').'"';
        $this->db->query($sql, $idx);
    }
    function checkminus($idx){
        $sql = 'select * from novellog where idx = ? and logdate = "'.date('Y-m-d').'"';
        $this->db->query($sql,$idx)->row();
    }

    function deletenovel($idx){
        $sql = 'delete from novellog where idx = ?';
        $this->db->query($sql,$idx);
    }
}