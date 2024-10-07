<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Other extends CI_Controller {


    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->model('img_model');
        $this->load->model('novel_model');
        $this->load->model('novellog_model');
        $this->load->model('comment_model');
        $this->load->model('complain_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }

    function complain(){
        $this->statuslogin();

        

        $this->header();
        $tapheaderskin = array('tap' =>1);
        $option = isset($_GET['option'])?$_GET['option']:0;
        if($_SESSION['useridx']==1){
            switch ($option) {
                case 1:
                    $complains = $this->complain_model->masterwhere(0);
                    break;
                case 2:
                    $complains = $this->complain_model->masterwhere(1);
                    break;
                
                default:
                    $complains = $this->complain_model->mastercomplain();
                    break;
            }
        } else {
            $complains = $this->complain_model->mycomplain($_SESSION['useridx']);
        }

        


        $this->load->view('complain/tapheader', $tapheaderskin);
        $this->load->view('complain/complain');


        $maxcnt = 0;
        $nowpage = isset($_GET['page'])?$_GET['page']:0;
        foreach ($complains as $cnts) {
            $maxcnt++;
        }
        if($maxcnt == 0){
            $this->load->view('complain/spacelist');
        }
        $footskin = array('maxcnt' => $maxcnt);
        $footskin['nowpage'] = $nowpage;

        $maxpage = ceil($maxcnt/10);
        $footskin['maxpage']=$maxpage;

        $startcnt = 0+(10*$nowpage);
        $endcnt = 9+(10*$nowpage);
        $footskin['startcnt']=$startcnt;
        $footskin['endcnt']=$endcnt;

        $maxblock = ceil($maxpage/5);
        $footskin['maxblock'] = $maxblock;

        $nowblock = floor($nowpage/5+1);
        $footskin['nowblock'] = $nowblock;

        $startpage = 1+5*($nowblock-1);
        $endpage = $startpage+4;
        if($endpage>$maxpage){
            $endpage=$maxpage;
        }
        $footskin['startpage'] = $startpage;
        $footskin['endpage'] = $endpage;
        $footskin['option'] = $option;


        $index = 0;
        foreach($complains as $complain){
            if($index>$endcnt){
                break;
            }


            switch ($complain->option) {
                case 1:
                    $complain->optiond = '완료';
                    break;
                default:
                    $complain->optiond = '대기';
                    if($complain->status == 1){
                        $complain->optiond = '삭제';
                    }
                    break;
            }


            if($index>=$startcnt){
              $this->load->view('complain/list', $complain);
            }
            $index++;
        }


        $this->load->view('complain/footer', $footskin);
        $this->load->view('footer');
        $this->load->view('complain/modal');
    }


    function addcomplain(){
        $this->header();
        $this->load->view('complain/addcomplain');
        $this->load->view('footer');
    }

    function addcomplaind(){
        $idx = $this->complain_model->addcomplain($_POST['title'], $_POST['content'], $_SESSION['useridx']);
        redirect(base_url().'other/complainview?view='.$idx);
    }

    function complainview(){
        $this->header();

        $idx = $_GET['view'];
        $complain = $this->complain_model->index($idx);
        if(!isset($complain->complainidx)){
            redirect(base_url().'other/complain?option=0');
        }

        $this->mycomplain($idx);
        $this->load->view('complain/view',$complain);
        $this->load->view('footer');
    }

    function editcomplain(){
        $this->header();

        $idx = $_GET['view'];
        $complain = $this->complain_model->index($idx);
        if(!isset($_SESSION['useridx']) or $complain->creator != $_SESSION['useridx']){
            if($_SESSION['useridx']!=1){
                redirect(base_url().'other/complain?option=0');
            }
        }
        if($_SESSION['useridx']==1){
            $this->load->view('complain/comment', $complain);
        } else{
            $this->load->view('complain/edit', $complain);
        }
        
        $this->load->view('footer');
    }

    function editcomplaind(){
        $this->mycomplain($_GET['view']);
        $this->complain_model->edit($_GET['view'],$_POST['title'],$_POST['content']);
        redirect(base_url().'other/complainview?view='.$_GET['view']);
    }

    function editcomplainm(){
        if($_SESSION['useridx']!=1){
            redirect(base_url().'other/complain?option=0');
        }
        $this->complain_model->comment($_GET['view'],$_POST['content']);
        redirect(base_url().'other/complainview?view='.$_GET['view']);
    }

    function removecomplain(){
        $this->mycomplain($_GET['view']);
        if($_SESSION['useridx'] == 1){
            $this->complain_model->masterremove($_GET['view']);
        } else {
            $this->complain_model->delete($_GET['view']);
        }
        redirect(base_url().'other/complain?option=0');
    }

    public function mycomplain($index){
        $this->statuslogin();
        $row = $this->complain_model->index($index);
        if($row->creator != $_SESSION['useridx']){
            if($_SESSION['useridx']!=1){
            $this->alertload('잘못된 접근입니다.',base_url().'other/complain?option=0');
            exit;
            }
        }
    }

    public function statuslogin(){
        if(!isset($_SESSION['useridx'])){
            $this->alertload('로그인이 필요합니다.',base_url().'home/login');
        }
    }



    public function alertload($alert,$href){
        echo "<script>";
        echo 'alert("'.$alert.'")';
        echo '</script>';
        echo "<script>";
        echo 'location.href="'.$href.'"';
        echo '</script>';
    }

    public function header(){
        if(!isset($_SESSION['useridx'])){
            redirect('/home/login');
        }
        $row = '';
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
        }
        $this->load->view('header',$row);
    }

    function wrongapproach($index){
        switch ($index) {
            case 1:
                $ptag = '해당브라우저에는 개발자모드가 실행되고 있습니다.<br>
실수에 의해 F12를 눌렀다면 다시 F12를 눌러 개발자모드를 꺼주시기 바랍니다.<br>
해당 조치는 작가님들을 위한 기본적인 저작권보호 정책이므로 고객여러분의 협조 부탁드립니다.<br>
감사합니다.';
                $ptag2 = "The browser is running developer mode. <br>
If you accidentally press F12, press F12 again to turn off developer mode. <br>
This is a basic copyright protection policy for authors, so we ask for your cooperation. <br>
I appreciate it.";
                break;
            
            default:
                $ptag = '잘못된 접근입니다. url을 통한 접근은 삼가하여 주시길 바랍니다.';
                $ptag2 = "It's the wrong approach. Please refrain from accessing via URL.";
                break;
        }
        $skin = array('say' => $ptag,'say2' => $ptag2 );
        $this->load->view('approach/wrong',$skin);
    }




    // function imsi(){
    //     for($i=1;$i<=13;$i++){
    //         $subject = $i;
    //         $content = $i;
    //         $creator = 2;
    //         $this->complain_model->addcomplain($subject, $content, $creator);
    //     }
    // }
}