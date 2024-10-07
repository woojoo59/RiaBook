<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mail extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->model('img_model');
        $this->load->model('novel_model');
        $this->load->model('novellog_model');
        $this->load->model('comment_model');
        $this->load->model('mail_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
    }

    function view(){
        $me = $_SESSION['useridx'];
        $idx = $_GET['index'];
        $this->_header();

        $mail = $this->mail_model->idxselect($idx);
        if($me != 1){
            if($mail->touseridx != $me){
                if($mail->fromuseridx != $me){
                    redirect(base_url().'mypage/mail');
                }
            }
        }
        if($mail->touseridx == $me){
            $this->mail_model->open($idx);
        }
        

        $to = $this->users_model->idxtonick($mail->touseridx);
        $from = $this->users_model->idxtonick($mail->fromuseridx);
        $mail->touseridx = $to->nickname;
        $mail->fromuseridx = $from->nickname;


        $this->load->view('mail/mailview', $mail);

        $this->load->view('footer');
    }

    function write($mailidx){
        $this->_header();
        $mail = $this->mail_model->idxselect($mailidx);
        
        
        if($mail==null){
            $user = array('user'=>'');
        } else{
            $username = $this->users_model->idxtonick($mail->fromuseridx);
            $user = array('user'=>$username->nickname);
        }
        if(isset($_GET['user'])){
            $username = $this->users_model->idxtonick($_GET['user']);
            if($username==null){
                redirect(base_url().'other/wrongapproach');
            }
            $user = array('user'=>$username->nickname);
        }

        
        
        $this->load->view('mail/write',$user);
        $this->load->view('footer');
    }

    function mailwrite(){


        $subject = $_POST['subject'];
        $content = $_POST['content'];
        $subdate = date('Y-m-d H:i:s');
        $fromuseridx = $_SESSION['useridx'];
        $touseridx = $_POST['touseridx'];

        $this->mail_model->add($touseridx,$fromuseridx,$subject,$content,$subdate);
        redirect(base_url().'mypage/mail');
    }

    function remove(){
        $mailidx = $_GET['idx'];
        $me = $_SESSION['useridx'];

        $default = $this->permission($mailidx);

        print_r($default);

        if($default->touseridx == $me){
            $this->mail_model->toremove($mailidx);
        }
        if($default->fromuseridx == $me){
            $this->mail_model->fromremove($mailidx);
        }


        $mail = $this->mail_model->idxselect($mailidx);

        if($mail->tostatus == 1 and $mail->fromstatus == 1){
            $this->mail_model->delete($mailidx);
        }

        $option = isset($_GET['option'])?$_GET['option']:0;
        switch ($option) {
            case 1:
                redirect(base_url().'mypage/mail?option=1');
                break;
            case 2:
                redirect(base_url().'mypage/mail?option=2');
                break;
            case 3:
                redirect(base_url().'mypage/mail?option=3');
                break;
            default:
                redirect(base_url().'mypage/mail?option=0');
                break;
        }

        
    }

    public function permission($mailidx){
        $me = $_SESSION['useridx'];
        $mail = $this->mail_model->idxselect($mailidx);
        $to = $mail->touseridx;
        $from = $mail->fromuseridx;
        if($me == 1) return $mail;
        if($to == $me) return $mail;
        if($from == $me) return $mail;
        redirect(base_url().'mypage/mail?option=0');
    }

    public function _header(){
        $me = $_SESSION['useridx'];
        $my = $this->users_model->idxtonick($me);
        $this->load->view('header', $my);
    }

    // function imsi(){
    //     for($i=2;$i<=73;$i++){
    //         $this->mail_model->add(2,1,'더미 데이터'.$i,'더미 데이터 내용'.$i,date('Y-m-d H:i:s'));
    //         if($i==73){
    //             echo '끝';
    //         }
    //     }
        
    // }
}