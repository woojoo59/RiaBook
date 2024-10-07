<?php
class Novel_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function novelidxcount($idx){
        $sql = 'select * from novel where idx = ? and status = 0';
        return $this->db->query($sql, $idx)->num_rows();
    }

    function sumhit($idx){
        $sql = 'select sum(hit) from novel where idx = ? and status = 0';
        return $this->db->query($sql, $idx)->row();
    }

    function idxtonovelidxdesc($idx){
        $sql = 'select novelidx from novel where idx = ? order by novelidx desc';
        return $this->db->query($sql, $idx)->result();
    }

    function novelidxselect($idx){
        $sql = 'select * from novel where status = 0 and novelidx = ?';
        return $this->db->query($sql,$idx)->row();
    }

    function novelidx($where,$idx){
        $sql = 'select * from novel where '.$where.' = ? and status = 0 order by novelidx';
        return $this->db->query($sql, $idx)->result();
    }

    function novelidxdesc($where,$idx){
        $sql = 'select * from novel where '.$where.' = ? and status = 0 order by novelidx desc';
        return $this->db->query($sql, $idx)->result();
    }

    function mynovelidx($idx){
        $sql = 'select * from novel where novelidx = ?';
        return $this->db->query($sql, $idx)->row();
    }

    function myidx($idx){
        $sql = 'select * from novel where idx = ?';
        return $this->db->query($sql, $idx)->result();
    }

    function deletenovel($idx){
        $sql = 'delete from novel WHERE idx = ?';
        $this->db->query($sql, $idx);
    }

    function delete($novelidx){
        $sql = 'delete from novel where novelidx = ?';
        $this->db->query($sql,$novelidx);
    }

    function wnovel($idx, $title, $content, $status, $time){
        $this->db->insert('novel',array(
            'idx'=>$idx,
            'title'=>$title,
            'content'=>$content,
            'status'=>$status,
            'updated'=>$time
        ));
        return $this->db->insert_id();
    }

    function hit($index){
        $sql = 'update novel set hit = hit+1 where novelidx = ?';
        $this->db->query($sql, $index);
    }

    function novelidxtoidx($novelidx){
        $sql = 'select idx from novel where novelidx = ?';
        return $this->db->query($sql, $novelidx)->row();
    }

    function edit($title, $content, $status, $novelidx){
        $sql = 'update novel set title = ?, content = ?, status = ? where novelidx = ?';
        $this->db->query($sql, array($title, $content, $status, $novelidx));
    }

    function maxnovelidx(){
        $sql = 'select novelidx from novel order by novelidx desc';
        return $this->db->query($sql)->row();
    }

    function sorthit(){
        $sql = 'select sum(hit),idx from novel group by idx order by sum(hit) desc';
        return $this->db->query($sql)->result();
    }

    function editstatus($status,$novelidx){
        $sql = 'update novel set status = ? where novelidx = ?';
        $this->db->query($sql,array($status,$novelidx));
    }

    function master($idx){
        $sql = 'select * from novel where idx = ? order by novelidx desc';
        return $this->db->query($sql,$idx)->result();
    }

    function dataselect(){
        $sql = 'select * from novel';
        return $this->db->query($sql)->result();
    }

    function novelidxs($novelidx){
        $sql = 'select novelidx from novel
where idx = (select idx from novel where novelidx = ?) and `status` = 0 order by novelidx';
        return $this->db->query($sql,$novelidx)->result();
    }

    function todayrank($idx){
        $sql = 'select sum(hit) as hit, count(novelidx) as episode from novel where idx = ?';
        return $this->db->query($sql,$idx)->row();
    }
}