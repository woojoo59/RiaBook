<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Report extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->model('img_model');
        $this->load->model('novel_model');
        $this->load->model('novellog_model');
        $this->load->model('comment_model');
        $this->load->model('report_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
    }

    function add(){
        $row = $this->users_model->useridxselect($_SESSION['useridx']);

        $this->load->view('header', $row);
        $this->load->view('report/add');
        $this->load->view('footer');
    }

    function repot(){

        $useridx = $_SESSION['useridx'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $class = $_POST['class'];
        $foridx = $_POST['foridx'];
        $date = date('Y-m-d H:i:s');

        $this->report_model->add($useridx,$title,$content,$class,$foridx,$date);
        switch ($class) {
            case 1:
                redirect(base_url().'notice/viewer?index='.$foridx);
                break;
            case 2:
                redirect(base_url().'mail/view?index='.$foridx);
                break;
            case 3:
                $row = $this->comment_model->idxselect($foridx);
                redirect(base_url().'notice/view?view='.$row->foridx);
                break;
            case 4:
                $row = $this->comment_model->idxselect($foridx);
                redirect(base_url().'comment/comments?index='.$row->foridx.'&forcategory='.$_POST['forcategory']);
                break;
            case 5:
                redirect(base_url().'novel/novel?novelidx='.$foridx);
                break;
            default:
                redirect(base_url().'novel/viewer?index='.$foridx);
                break;
        }
    }

    function delete($index){
        $flag = $this->report_model->idxselect($index);

        if($flag == null){

            redirect(base_url().'other/wrongapproach');
            exit;
        }
        $this->report_model->delete($index);
        redirect(base_url().'master');
    }
}