<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Notice extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->model('img_model');
        $this->load->model('novel_model');
        $this->load->model('novellog_model');
        $this->load->model('comment_model');
        $this->load->model('notice_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }

    function addnotice(){
        $index = $this->notice_model->add(0,$_POST['title'],$_POST['content']);
        redirect(base_url().'notice/view?view='.$index);
    }

    function add(){
        $this->masterstatus();
        $this->header();
        $this->load->view('notice/addnotice');
        $this->load->view('footer');
    }

    function editpage(){
        $this->masterstatus();
        $this->header();
        $notice = $this->notice_model->rowidx($_GET['view']);
        $this->load->view('notice/editnotice',$notice);
        $this->load->view('footer');
    }
    function edit(){
        $this->masterstatus();
        $this->notice_model->editnotice($_POST['title'],$_POST['content'],$_GET['view']);
        redirect(base_url().'notice/view?view='.$_GET['view']);
    }
    function remove(){
        $this->masterstatus();
        $view = $_GET['view'];

        $this->comment_model->idxdelete($view,1);
        $this->notice_model->delete($view);
        redirect(base_url().'home/notice');
    }


    function view(){

        $view = $_GET['view'];
        $this->header();
        $notice = $this->notice_model->select('noticeidx',$view);
        if(!isset($notice[0]) or $notice[0]->foridx != 0){
            redirect(base_url().'other/wrongapproach');
        }
        $this->load->view('notice/noticeviewpage', $notice[0]);

        $this->load->model('comment_model');
        $novelidx = $view;


        $result = $this->comment_model->selectcomment($view,1);


        $maxcnt = 0;
        $nowpage = isset($_GET['page'])?$_GET['page']:0;
        foreach ($result as $cnts) {
            $maxcnt++;
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
        $footskin['view'] = $view;

        $index = 0;
        $this->load->view('notice/noticecomment/comment',$footskin);
        foreach ($result as $row) {
            if($index>$endcnt){
                break;
            }
            if($index>=$startcnt){
                $re = 0;
                $row->re = $re;
                $row->view = $view;
                if(isset($_SESSION['useridx']) and ($row->creator == $_SESSION['useridx'] or $_SESSION['useridx']==1)){
                    $nick = $this->users_model->idxtonick($row->creator);
                    $row->creator = $nick->nickname;
                    $this->load->view('notice/noticecomment/mycommentlist', $row);
                } else if($row->creator != 0){
                    $nick = $this->users_model->idxtonick($row->creator);
                    $row->creator = $nick->nickname;
                    $this->load->view('notice/noticecomment/commentlist', $row);
                } else {
                    $this->load->view('comment/removecomment');
                }
    
                $this->recomment($re,$row->cidx);
            }
            $index++;
        }
        $footskin['view'] = $view;
        $this->load->view('notice/noticecomment/commentfoot',$footskin);


        $this->load->view('notice/noticeviewpagefoot');
        $this->load->view('footer');
        if(!isset($_SESSION['useridx'])){
            $this->load->view('user/requierlogin');
        }
    }

    public function header(){
        if(isset($_COOKIE['nickname']) && !isset($_SESSION['useridx'])){
            redirect('/users/login');
        }
        $row = '';
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
        }
        $this->load->view('header',$row);
    }

    public function masterstatus(){
        if(!isset($_SESSION['useridx']) or $_SESSION['useridx']!=1){
            redirect(base_url());
        }
    }



    public function recomment($re,$comg){
        $re++;
        $recomments = $this->comment_model->selectrecomment($comg);
        foreach ($recomments as $recomment) {
            $recomment->re = $re;

            if(isset($_SESSION['useridx']) and ($recomment->creator == $_SESSION['useridx'] or $_SESSION['useridx']==1)){
                $nick = $this->users_model->idxtonick($recomment->creator);
                $recomment->creator = $nick->nickname;
                $this->load->view('notice/noticecomment/mycommentlist', $recomment);
            } else if($recomment->creator != 0){
                $nick = $this->users_model->idxtonick($recomment->creator);
                $recomment->creator = $nick->nickname;
                $this->load->view('notice/noticecomment/commentlist', $recomment);
            } else {
                $this->load->view('comment/removecomment');
            }

            $this->recomment($re,$recomment->cidx);
        }
        
    }

    function viewer(){
        $notice = $this->notice_model->select('noticeidx',$_GET['index']);
        if(!isset($notice[0])){
            redirect(base_url().'other/wrongapproach');
        }
        if($notice[0]->foridx == 0){
            redirect(base_url().'other/wrongapproach');
        }
        $test = $this->novellist_model->selectidx($notice[0]->foridx);
        if($test->status != 0){
            if(!isset($_SESSION['useridx'])){
                redirect(base_url().'other/wrongapproach');
            } else{
                if($_SESSION['useridx']== $test->creator or $_SESSION['useridx'] == 1){

                } else {
                    redirect(base_url().'other/wrongapproach');
                }
            }
            
        }
        $this->load->view('notice/viewer/viewheader', $notice[0]);
        $this->load->view('notice/viewer/noticeviewer',$notice[0]);
        $this->load->view('notice/viewer/viewfooter', $notice[0]);
        $row = '';
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
            $row->setting = explode('@', $row->setting);
            $this->load->view('mypage/setting',$row); 
        } else {
            $this->load->view('user/requierlogin');
        }
        
    }


    function viewerlist(){
        $notice = $this->notice_model->select('noticeidx',$_GET['index']);
        $notice[0]->test = 0;
        $this->load->view('notice/viewer/viewheader', $notice[0]);


        $this->load->view('novel/list/listheader');
        $option = 0;


        $notices = $this->notice_model->select('foridx', $notice[0]->foridx);

        $toEnd = count($notices);
        $maxnoidx = isset($_GET['add'])? $_GET['add'] : $toEnd-3;
        $noidxarray = array('maxnoidx'=>$maxnoidx);

        foreach($notices as $notice){
            $this->load->view('notice/noticelist',$notice);
            
        }

        $novels = $this->novel_model->novelidxdesc('idx',$notices[0]->foridx);

        $paging = new stdClass();                                   //페이징

        $paging->page = isset($_GET['page'])?$_GET['page']:1;
        $last = 0;
        $index=0;
        foreach ($novels as $novel){
            $last++;
        }

        $paging->allcnt = $last;
        $paging->allpage = ceil($paging->allcnt/30);
        $paging->startcnt = 1+(($paging->page-1)*30);
        $paging->endcnt = 30+(($paging->page-1)*30);
        $paging->nowblock = floor($paging->startcnt/150);
        $paging->startblock = 1+(5*$paging->nowblock);
        $paging->endblock = 5+((5*$paging->nowblock));
        $paging->option = $option;
        if($paging->endblock>$paging->allpage){
            $paging->endblock=$paging->allpage;
        }
        $paging->nowpage = isset($_GET['page'])?$_GET['page']:1;

            


        $date = array('s','i','h','d','m','y');
        $dates = array('초전','분전','시간전','일전','달전','년전');
        foreach ($novels as $novel) {                            //소설 리스트 출력
            $novel->index = $last;

            $start = new DateTime($novel->updated);
            $end = new DateTime(date('Y-m-d H:i:s'));
            $interval = date_diff($start,$end);



            $datesi = 0;
            foreach($date as $data){
                if($interval->{$data} != 0){
                    $novel->updated = $interval->{$data}.$dates[$datesi];
                }
                $datesi++;
            }    
            


            if($paging->startcnt-1<=$index && $paging->endcnt>$index){
                $this->load->view('novel/list/profilenovel',$novel);
            }
            
            $index++;
            $last--;
        }


        $this->load->view('novel/list/listfooter');
        $this->load->view('notice/viewer/page',$paging);


        $row = '';
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
            $row->setting = explode('@', $row->setting);
            $this->load->view('mypage/setting',$row); 
        } else {
            $this->load->view('user/requierlogin');
        }
        $this->load->view('notice/viewer/viewfooter', $notice);
    }
}