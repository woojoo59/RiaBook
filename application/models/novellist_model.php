<?php
//테이블마다 만드는거 추천
class Novellist_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function newnovel($useridx,$subject,$introduce,$category,$tag,$status,$date){
        $this->db->insert('novellist',array(
            'creator'=>$useridx,
            'subject'=>$subject,
            'introduce'=>$introduce,
            'category'=>$category,
            'tag'=>$tag,
            'status'=>$status,
            'created'=>$date
        ));
        return $this->db->insert_id();
    }


    function freelist(){
        $sql = 'select * from novellist where status = 0 order by created desc';
        return $this->db->query($sql)->result();
    }

    function wherelist($where,$option){
        $sql = 'select * from novellist where status = 0 '.$where.' order by '.$option.' desc';
        return $this->db->query($sql)->result();
    }

    function profilenovel($idx){
        $sql = 'select a.*,count(b.novelidx) as save,sum(b.hit) as hit,c.imgname as img from novellist as a 
        left join novel as b on a.idx = b.idx
        left join img as c on a.idx = c.foridx where a.idx = ? group by a.idx';
        return $this->db->query($sql,$idx)->row();
    }


    function selectnovel($where,$value){
        $sql = 'select * from novellist where '.$where.' = ? order by created desc';
        return $this->db->query($sql, $value)->result();
    }

    function updated($time,$idx){
        $sql = 'update novellist set created = ? where idx = ?';
        $this->db->query($sql, array($time,$idx));
    }

    function maxidx(){
        $sql = 'select idx from novellist order by idx desc';
        return $this->db->query($sql)->row();
    }

    function selectidx($idx){
        $sql = 'select * from novellist where idx = ?';
        return $this->db->query($sql,$idx)->row();
    }

    function idxupdate($idx, $subject, $category, $status, $tag, $introduce){
        $sql = 'update novellist set subject = ?, category = ?, status = ?, tag = ?, introduce = ? where idx = ?';
        $this->db->query($sql, array($subject,$category,$status,$tag,$introduce,$idx));
    }

    function recommendadd($idx){
        $sql = 'update novellist set recommendscnt = recommendscnt+1 where idx = ?;';
        $this->db->query($sql, $idx);
    }

    function recommend($idx){
        $sql = 'update novellist set recommendscnt = recommendscnt-1 where idx = ?;';
        $this->db->query($sql, $idx);
    } 
    
    function preferadd($idx){
        $sql = 'update novellist set prefercnt = prefercnt+1 where idx = ?;';
        $this->db->query($sql, $idx);
    }

    function prefer($idx){
        $sql = 'update novellist set prefercnt = prefercnt-1 where idx = ?;';
        $this->db->query($sql, $idx);
    }

    function deletenovel($idx){
        $sql = 'delete from novellist WHERE idx = ?';
        $this->db->query($sql, $idx);
    }

    function hitdesc($where){
        $sql = 'select a.*,sum(b.hit) from novellist as a left join novel as b on a.idx = b.idx where a.`status`=0 '.$where.' group by a.idx order by sum(b.hit) desc';
        return $this->db->query($sql)->result();
    }

    function novelnum(){
        $sql = 'select * from novellist where status = 0';
        return $this->db->query($sql)->num_rows();
    }

    function categorynum($category){
        $sql = 'select * from novellist where status = 0 and category = ?';
        return $this->db->query($sql,$category)->num_rows();
    }

    function editstatus($idx,$status){
        $sql = 'update novellist set status = ? where idx = ?';
        $this->db->query($sql,array($status,$idx));
    }

    function masterselect($useridx){
        $sql = 'select * from novellist where creator = ? order by created desc';
        return $this->db->query($sql,$useridx)->result();
    }

    function master(){
        $sql = 'select a.*, count(b.novelidx) as cnt, sum(b.hit) as hit, c.imgname from novellist as a left join novel as b on a.idx = b.idx left join img as c on a.idx=c.foridx GROUP BY a.idx order by a.created desc';
        return $this->db->query($sql)->result();
    }

    function master1($subject){
        $sql = 'select a.*, count(b.novelidx) as cnt, sum(b.hit) as hit, c.imgname from novellist as a left join novel as b on a.idx = b.idx left join img as c on a.idx=c.foridx where `subject` like ? GROUP BY a.idx order by a.created desc';
        return $this->db->query($sql,'%'.$subject.'%')->result();
    }

    function master2($nick){
        $sql = 'select a.*, count(b.novelidx) as cnt, sum(b.hit) as hit, c.imgname from novellist as a left join novel as b on a.idx = b.idx left join img as c on a.idx=c.foridx left join users as d on a.creator = d.useridx where nickname like ? GROUP BY a.idx order by a.created desc';
        return $this->db->query($sql,'%'.$nick.'%')->result();
    }

    function master3($category){
        $sql = 'select a.*, count(b.novelidx) as cnt, sum(b.hit) as hit, c.imgname from novellist as a left join novel as b on a.idx = b.idx left join img as c on a.idx=c.foridx where category = ? GROUP BY a.idx order by a.created desc';
        return $this->db->query($sql,$category)->result();
    }

    function master3_1(){
        $sql = 'select a.*, count(b.novelidx) as cnt, sum(b.hit) as hit, c.imgname from novellist as a left join novel as b on a.idx = b.idx left join img as c on a.idx=c.foridx GROUP BY a.idx order by a.created desc';
        return $this->db->query($sql)->result();
    }

    function master4($tag){
        $sql = 'select a.*, count(b.novelidx) as cnt, sum(b.hit) as hit, c.imgname from novellist as a left join novel as b on a.idx = b.idx left join img as c on a.idx=c.foridx where `tag` like ? GROUP BY a.idx order by a.created desc';
        return $this->db->query($sql,'%#'.$tag.'%')->result();
    }

    function nicklike($nick){
        $sql = 'select a.*,b.nickname as nick from novellist as a left join users as b on a.creator = b.useridx where b.nickname like ? group by a.idx order by a.created desc';
        return $this->db->query($sql,'%'.$nick.'%')->result();
    }

    function recomendmanage($idx){
        $sql = 'select a.*, b.imgname, count(c.novelidx) as cnt, sum(c.hit) as hit, d.nickname as creatorn
from novellist as a
left join img as b on a.idx = b.foridx
left join novel as c on a.idx = c.idx
left join users as d on a.creator = d.useridx
where a.idx = ?';
        return $this->db->query($sql, $idx)->row();
    }

}