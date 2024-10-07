<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class data extends CI_Controller {

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
        $this->load->model('notice_model');
        $this->load->model('report_model');
        $this->load->model('recommend_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }

    function index(){

    }

    function rank(){
        $novels = $this->novellist_model->freelist();
        foreach($novels as $novel){
            $n = $this->novellog_model->new($novel->idx,$novel->category);
            $this->novellog_model->addhit($novel->idx);
        }
        redirect(base_url().'home/rank');
    }

    function rankshow(){
        $rank = $this->novellog_model->rank(date('Y-m-d'),date('Y-m-d'),'hit','recommend','prefer');
        foreach($rank as $r){
            print_r($r);
            echo '<hr>';
        }
    }
    function rank1show(){
        $rank1 = $this->novellog_model->today();
        foreach($rank1 as $r){
            print_r($r);
            echo '<hr>';
        }
    }
}