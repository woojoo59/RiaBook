<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Comment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->model('img_model');
        $this->load->model('novel_model');
        $this->load->model('novellog_model');
        $this->load->model('comment_model');

        $this->load->helper('url');
        $this->load->helper('cookie');
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
    }

    function comments(){
        $this->load->model('notice_model');
        $novelidx = isset($_GET['index'])?$_GET['index']:0;
        $forcategory = isset($_GET['forcategory'])?$_GET['forcategory']:0;


        switch ($forcategory) {
            case 1:
                $row = $this->notice_model->rowidx($novelidx);
                if($row->foridx==0){
                    redirect(base_url().'notice/view?view='.$novelidx);
                }
                $forcategory = 1;

                $header = $row;
                $header = array('novelidx' => $novelidx, );
                $header['idx'] = $row->foridx;
                $header['prev']=0;
                $header['next']=0;
                $header['view'] = '공지';
                $header['title'] = $row->title;
                break;
            
            default:
                $row = $this->novel_model->novelidxselect($novelidx);
                $forcategory = 0;

                $viewer = $this->novel_model->novelidx('novelidx',$novelidx);
                $viewers = $this->novel_model->novelidx('idx',$viewer[0]->idx);
                $idx = 1;
                
                $viewer[0]->prev = 0;
                foreach($viewers as $thisview){
        
                    if($thisview->novelidx == $novelidx){
                        break;
                    }
                    $viewer[0]->prev = $thisview->novelidx;
                    $idx++;
                }
        
        
                $viewer[0]->view = $idx;
                if(isset($viewers[$idx])){
                    $viewer[0]->next = $viewers[$idx]->novelidx;
                } else {
                    $viewer[0]->next = 0;
                }
                $header = $viewer[0];
                break;
                }





        $result = $this->comment_model->selectcomment($novelidx,$forcategory);

        switch ($forcategory) {
            case 1:
                $header['foridx'] = $header['idx'];
                $header['test'] = 1;
                $this->load->view('notice/viewer/viewheader', $header);
                break;
            
            default:
                $header->goback = 2;
                $this->load->view('novel/viewer/viewerheader',$header);
                break;
        }


        
        

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

        $index = 0;
        $this->load->view('comment/comment',$footskin);
        foreach ($result as $row) {
            if($index>$endcnt){
                break;
            }
            if($index>=$startcnt){
                $re = 0;
                $row->re = $re;
    
                if($row->creator == $_SESSION['useridx'] or $_SESSION['useridx']==1){
                    $nick = $this->users_model->idxtonick($row->creator);
                    $row->creator = $nick->nickname;
                    $this->load->view('comment/mycommentlist', $row);
                } else if($row->creator != 0) {
                    $nick = $this->users_model->idxtonick($row->creator);
                    $row->creator = $nick->nickname;
                    $this->load->view('comment/commentlist', $row);
                } else {
                    $this->load->view('comment/removecomment');
                }
    
                $this->recomment($re,$row->cidx);
            }
            $index++;
        }
        if(isset($viewer[0])){
            $header->index = $_GET['index'];
        }
        

        $this->load->view('comment/commentfoot',$footskin);
        $row = new stdClass();
        $defaultset = '16@30@#000000@#ccffcc';
        $row->setting = explode('@', $defaultset);
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
            $row->setting = explode('@', $row->setting);
        }
        $this->load->view('mypage/setting',$row);

        switch ($forcategory) {
            case 1:
                $this->load->view('notice/viewer/viewfooter', $header);
                break;
            
            default:
                $this->load->view('novel/viewer/viewerfoot', $header);
                break;
        }

    }

    public function recomment($re,$comg){
        $re++;
        $recomments = $this->comment_model->selectrecomment($comg);
        foreach ($recomments as $recomment) {
            $recomment->re = $re;

            if($recomment->creator == $_SESSION['useridx']){
                $this->load->view('comment/mycommentlist', $recomment);
            } else {
                $this->load->view('comment/commentlist', $recomment);
            }

            $this->recomment($re,$recomment->cidx);
        }
        
    }

    function commentwrite(){

        $this->comment_model->comment($_GET['index'],$_GET['forcategory'],$_POST['comg'],$_SESSION['useridx'],$_POST['content']);
        if($_GET['forcategory']==0){
            redirect(base_url().'comment/comments?index='.$_GET['index'].'&forcategory='.$_GET['forcategory']);
        } else if($_GET['forcategory']==1) {
            if(isset($_POST['view'])){
                redirect(base_url().'notice/view?view='.$_GET['index']);
            } else {
                redirect(base_url().'comment/comments?index='.$_GET['index'].'&forcategory=1','refresh');
            }
            
        } else {
            redirect(base_url(),'refresh');
        }
    }

    function edit(){
        $this->statusmy($_POST['comg']);
        $this->comment_model->editcomment($_POST['content'],$_POST['comg']);
        if($_GET['forcategory']==0){
            redirect(base_url().'comment/comments?index='.$_GET['index'].'&forcategory='.$_GET['forcategory']);
        } else if($_GET['forcategory']==1) {
            redirect(base_url().'notice/view?view='.$_GET['index']);
        } else {
            redirect(base_url(),'refresh');
        }
    }

    function delete(){
        $this->statusmy($_GET['cidx']);
        $cnt = $this->comment_model->recommentcnt($_GET['cidx']);
        $here = $this->comment_model->idxselect($_GET['cidx']);
        
        
        if($cnt>0){
            $this->comment_model->removecomment($_GET['cidx']);
        } else{
            
            $this->deleted($here->cidx);
        }
        if($here->foridx != 0){
            redirect(base_url().'comment/comments?index='.$_GET['index'].'&forcategory='.$_GET['forcategory']);
        } else {
            redirect(base_url().'notice/view?view='.$_GET['index']);
        }

    }

    public function deleted($cidx){
        if($cidx==0){
            return false;
        }
        $here = $this->comment_model->idxselect($cidx);
        $this->comment_model->deletecomment($cidx);
        $prev = $this->comment_model->idxselect($here->comg);
        $cnt = $this->comment_model->recommentcnt($prev->cidx);
        if($cnt==0){
            if($prev->creator == 0){
                $this->deleted($prev->comg);
                $this->comment_model->deletecomment($prev->cidx);
            }
        } else{
            return false;
        }
    }

    public function statusmy($cidx){
        $row = $this->comment_model->idxselect($cidx);
        if($row->creator != $_SESSION['useridx'] and $_SESSION['useridx']!=1){
            echo '<script>';
            echo 'alert("본인이 아닙니다.");';
            echo 'history.go(-1);';
            echo '</script>';
        }
    }

    function imsi(){
        for($i=50;$i<=103;$i++){
            $this->comment_model->comment(1,0,0,$_SESSION['useridx'],$i);
        }  
    }
}