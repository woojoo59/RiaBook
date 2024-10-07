<?php
//테이블마다 만드는거 추천
class Users_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function signin($user,$pwd,$mail,$time,$address){
        $this->db->insert('users',array(
            'identifier'=>$user['identifier'],
            'nickname'=>$user['nickname'],
            'phonenumber'=>$user['phonenumber'],
            'password'=>$pwd,
            'username'=>$user['username'],
            'setting'=>'16@30@#000000@#ccffcc',
            'created'=>$time,
            'status'=>'1',
            'email'=>$mail,
            'address'=>$address
        ));
    }

    function nicklike($nickname){
        $sql = 'select * from users where nickname like ?';
        return $this->db->query($sql, '%'.$nickname.'%')->row();
    }
    function nickname($nickname){
        $sql = 'select * from users where nickname = ?';
        return $this->db->query($sql, $nickname)->row();
    }

    function identifierselect($identifier){
        $sql = 'select * from users where identifier = ?';
        return $this->db->query($sql, $identifier)->row();
    }
    function useridxselect($useridx){
        $sql = 'select * from users where useridx = ?';
        return $this->db->query($sql,$useridx)->row();
    }
    function nicknameselect($nickname){
        $sql = 'select * from users where useridx = ?';
        return $this->db->query($sql,$nickname)->row();
    }
    function whereselect($option,$value){
        $sql = 'select * from users where '.$option.'= ?';
        return $this->db->query($sql, $value)->row();
    }

    function duplicate($option, $name){                                                                                                   
        $sql = 'select * from users where '.$option.' = ?';
        return $this->db->query($sql, $name)->num_rows();
    }

    function password($password, $phone){
        $sql = 'update users set password = ? where phonenumber = ?';
        $this->db->query($sql, array($password,$phone));
    }

    function passwordidx($password,$useridx){
        $sql = 'update users set password = ? where useridx = ?';
        $this->db->query($sql, array($password,$useridx));
    }

    function setting($useridx,$setting){
        $sql = 'update users set setting = ? where useridx = ?';
        $this->db->query($sql, array($setting,$useridx));
    }

    function recommendadd($recommends,$useridx){
        $sql = 'update users set recommends = concat(recommends,?) where useridx = ?;';
        $this->db->query($sql, array($recommends,$useridx));
    }

    function recommend($recommends,$useridx){
        $sql = 'update users set recommends = ? where useridx = ?;';
        $this->db->query($sql, array($recommends,$useridx));
    }

    function preferadd($prefer,$useridx){
        $sql = 'update users set prefer = concat(prefer,?) where useridx = ?;';
        $this->db->query($sql, array($prefer,$useridx));
    }

    function prefer($prefer,$useridx){
        $sql = 'update users set prefer = ? where useridx = ?;';
        $this->db->query($sql, array($prefer,$useridx));
    }

    function idxtonick($useridx){
        $sql = 'select nickname from users where useridx = ?';
        return $this->db->query($sql,$useridx)->row();
    }
    
    function penalty($useridx,$status){
        $sql = 'update users set status = ? where useridx = ?';
        $this->db->query($sql,array($status,$useridx));
    }

    function numusers(){
        $sql = 'select * from users where useridx > 1';
        return $this->db->query($sql)->num_rows();
    }

    function activenum(){
        $sql = 'select * from users where useridx > 1 and status != 0';
        return $this->db->query($sql)->num_rows();
    }

    function stopnum(){
        $sql = 'select * from users where useridx > 1 and status = 0';
        return $this->db->query($sql)->num_rows();
    }

    function masterselect($andwhere,$sort){
        $sql = 'select * from users where useridx > 1'.$andwhere.' order by '.$sort;
        return $this->db->query($sql)->result();
    }

    function master1($like){
        $sql = 'select * from users where useridx > 1 and identifier like ? order by useridx desc';
        return $this->db->query($sql,$like)->result();
    }
    function master2($like){
        $sql = 'select * from users where useridx > 1 and nickname like ? order by useridx desc';
        return $this->db->query($sql,$like)->result();
    }
    function master3($like){
        $sql = 'select * from users where useridx > 1 and username like ? order by useridx desc';
        return $this->db->query($sql,$like)->result();
    }
    function master4($like){
        $sql = 'select * from users where useridx > 1 and phonenumber like ? order by useridx desc';
        return $this->db->query($sql,$like)->result();
    }
    function master5($status){
        $sql = 'select * from users where useridx > 1 and status = ? order by useridx desc';
        return $this->db->query($sql,$status)->result();
    }

    function masterup0($status,$useridx){
        $sql = 'update users set status = ? where useridx = ?';
        $this->db->query($sql,array($status,$useridx));
    }
    function masterup1($identifier,$useridx){
        $sql = 'update users set identifier = ? where useridx = ?';
        $this->db->query($sql,array($identifier,$useridx));
    }
    function masterup2($password,$useridx){
        $sql = 'update users set password = ? where useridx = ?';
        $this->db->query($sql,array($password,$useridx));
    }
    function masterup3($username,$useridx){
        $sql = 'update users set username = ? where useridx = ?';
        $this->db->query($sql,array($username,$useridx));
    }
    function masterpoint($mypoint,$useridx){
        $sql = 'update users set mypoint = ? where useridx = ?';
        $this->db->query($sql,array($mypoint,$useridx));
    }

    function pointup($useridx){
        $sql = 'update users set mypoint = mypoint+1 where useridx = ?';
        $this->db->query($sql,$useridx);
    }
    function pointdown($useridx,$point){
        $sql = 'update users set mypoint = ? where useridx = ?';
        $this->db->query($sql,array($point,$useridx));
    }
    function myupdate($nickname,$phonenumber,$email,$address,$useridx){
        $sql = 'update users set nickname = ?, phonenumber = ?, email = ?, address = ? where useridx = ?';
        $this->db->query($sql,array($nickname,$phonenumber,$email,$address,$useridx));
    }
    function todayrank($useridx){
        $sql = 'select nickname as nick from users where useridx = ?';
        return $this->db->query($sql,$useridx)->row();
    }
}