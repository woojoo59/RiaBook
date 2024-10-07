<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mypage extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('novellist_model');
        $this->load->model('img_model');
        $this->load->model('novel_model');
        $this->load->model('users_model');
        $this->load->model('mail_model');
        $this->load->model('notice_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
    }


    private function header(){
        $row = $this->users_model->useridxselect($_SESSION['useridx']);

        $option = $_SERVER[ "PHP_SELF" ];
        $options = explode('/', $option);
        $options[3] = isset($options[3])?$options[3]:'mynovel';

        $option = array('option'=>$options[3]);
        $option['point'] = $row->mypoint;

        $this->load->view('header',$row);
        $this->load->view('mypage/mypageheader',$option);
        
        $row->setting = explode('@', $row->setting);

        $this->load->view('mypage/setting',$row);
    }

    private function profileimg($foridx){
        $img = $this->img_model->selectimg($foridx,0);
            if(isset($img->imgname)){
                $imgname = $img->imgname;
            } else {
                $imgname = 'default.png';
            }
        return $imgname;
    }

    private function creator($useridx){
        return $this->users_model->useridxselect($useridx);
    }

    function recommendmynovel($idx){
        $novel = $this->novellist_model->selectidx($idx);
        if(!isset($_SESSION['useridx']))redirect(base_url().'other/wrongapproach');
        $user = $this->users_model->useridxselect($_SESSION['useridx']);
        if($novel->creator != $user->useridx)redirect(base_url().'other/wrongapproach');

        $user->idx = $idx;
        $this->load->view('header', $user);
        $this->load->view('mypage/recommendnovel',$user);
        $this->load->view('footer');
        $this->load->view('mypage/modal');
        
    }

    function prefer(){
        clearstatcache();
        $this->header();
        $this->load->model('continue_model');

        $useridx = $_SESSION['useridx'];
        $this->_checkprefer();
        $prefer = $this->users_model->useridxselect($useridx);
        $preference = $prefer->prefer;

        $preferences = explode('#', $preference);

        $mynovellist = array();
        $i=0;
        foreach($preferences as $ps){
            if($ps!=''){
                $row = $this->novellist_model->selectidx($ps);
                $mynovellist[$i]=$row;
                $i++;
            }
        }
        
        $mynovellist=Array_reverse ($mynovellist);

        $mynovellist = array_filter($mynovellist, function($item){
            if(isset($item->status)){
                return $item->status != 1;
            }
        });

        $this->load->view('mypage/mynovellistheader');

        $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
        $status = array('공개', '비공개');


        $index = 0;
        foreach ($mynovellist as $rs){
            $index++;
        }
        $paging = $this->paging($index);
        if($index==0){
            $this->load->view('mypage/spacelist');
        }

        $index = 1;
        

        foreach ($mynovellist as $rs) {
            
            $rs->img=$this->profileimg($rs->idx);

            $save = $this->novel_model->novelidxcount($rs->idx);

            $date =  $rs->created;


            
            $hit = $this->novel_model->sumhit($rs->idx);
            $rs->hit=$hit->{'sum(hit)'};

            
            $rs->category=$category[$rs->category];
            $rs->status=$status[$rs->status];
            $rs->save=$save;


            $novel = $this->novel_model->myidx($rs->idx);
            $rs->novels = $novel;
            if($novel==''){
                $rs->novels[0];
            }


            $date = array('s','i','h','d','m','y');                         //업데이트 시간
            $dates = array('초전','분전','시간전','일전','달전','년전');
            $start = new DateTime($rs->created);
            $end = new DateTime(date('Y-m-d H:i:s'));
            $interval = date_diff($start,$end);
            $datesi = 0;

            foreach($date as $data){
                if($interval->{$data} != 0){
                    $rs->created = $interval->{$data}.$dates[$datesi];
                }
                $datesi++;
            }
            
            $tagarray = explode('#', $rs->tag);                         //태그 분류
            $tagindex = 0;
            foreach($tagarray as $tags){
                if($tags==''){
                    unset($tagarray[$tagindex]);
                    $tagindex++;
                }
            }
            $rs->tag = $tagarray;

            $creator = $this->creator($rs->creator);                    //닉네임
            $rs->creator = $creator->nickname;


            $novels = $this->novel_model->novelidxdesc('idx',$rs->idx);
            $novelindex = $this->novel_model->novelidxcount($rs->idx);
            $rs->novelindex = $novelindex;

            
            foreach($novels as $novel){        
                $rs->index[$novelindex]=$novel->novelidx;
                $novelindex--;
            }
            $rs->lastviewer = 0;
            if(isset($rs->novels[0])){
                $rs->lastviewer = $rs->novels[0]->novelidx;
            }
            
            $rs->listoption = 1;
            $continew = $this->continue_model->duselect($useridx,$rs->idx);
            if(isset($continew->novelidx)){
                $rs->lastviewer = $continew->novelidx;
            }
            if($paging->startcnt<=$index){

                $this->load->view('mypage/mycontinue',$rs);
            }
            if($index==$paging->endcnt){
                break;
            }
          
            $index++;
        }



        $paging->where = '/prefer?page=';

        $this->load->view('mypage/mynovellistfoot');
        $this->load->view('mypage/preferpaging',$paging);
        $this->load->view('mypage/mynovelfoot');
        $this->load->view('footer');
    }

    public function paging($index){
        $paging = new stdClass();                                   //페이징

        $paging->page = isset($_GET['page'])?$_GET['page']:1;
        
        $paging->allcnt = $index;
        $paging->allpage = ceil($paging->allcnt/10);
        $paging->startcnt = 1+(($paging->page-1)*10);
        $paging->endcnt = 10+(($paging->page-1)*10);
        $paging->nowblock = floor($paging->startcnt/50);
        $paging->startblock = 1+(5*$paging->nowblock);
        $paging->endblock = 5+((5*$paging->nowblock));
        if($paging->endblock>$paging->allpage){
            $paging->endblock=$paging->allpage;
        }
        return $paging;
    }

    function index(){

        
        $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
        $status = array('공개', '비공개');

        
        $this->header();

        $mynovellist = $this->novellist_model->selectnovel('creator',$_SESSION['useridx']);
        

        $this->load->view('mypage/mynovellistheader');

        $index= 0;
        foreach ($mynovellist as $rs){
            $index++;
        }
        $paging = $this->paging($index);
        if($index==0){
            $this->load->view('mypage/spacelist');
        }

        $index = 1;

        
        foreach ($mynovellist as $rs) {

            $rs->img=$this->profileimg($rs->idx);

            $save = $this->novel_model->novelidxcount($rs->idx);

            $date =  $rs->created;
            $date = explode(' ', $date);

            
            $hit = $this->novel_model->sumhit($rs->idx);
            $rs->hit=$hit->{'sum(hit)'};

            
            $rs->category=$category[$rs->category];
            $rs->status=$status[$rs->status];
            $rs->save=$save;
            $rs->created = $date[0];

            $novel = $this->novel_model->myidx($rs->idx);
            $novel = array_reverse($novel);
            $rs->novels = $novel;
            if($novel==''){
                $rs->novels[0];
            }

            foreach ($rs->novels as $novel) {
                
                if($novel->status==0){
                    $novel->status='공개';
                } else {
                    $novel->status = '비공개';
                }
            }
            
            $notice = $this->notice_model->novelnotice($rs->idx);

            foreach($notice as $n){
                if(mb_strlen($n->title, 'UTF-8')>8){
                    $n->title = mb_substr($n->title, 0, 7, 'UTF-8').'···';
                }
            }
            $rs->notices = $notice;
            if($paging->startcnt<=$index){
                $this->load->view('mypage/mynovellist',$rs);
            }
            if($index==$paging->endcnt){
                break;
            }

            $index++;

            
        }
        $paging->where = '?page=';
        $this->load->view('mypage/mynovellistfoot');
        $this->load->view('mypage/movenovel');
        $this->load->view('mypage/preferpaging',$paging);
        $this->load->view('mypage/mynovelfoot');
        


        $this->load->view('footer');

    }

    function continue(){
        clearstatcache();
        $this->load->model('continue_model');
        $this->header();
        
 
        $this->load->view('mypage/mynovellistheader');

        $Max = $this->novellist_model->maxidx();

        $continue = $this->continue_model->myselect($_SESSION['useridx']);

        $cnt = 0;
        foreach($continue as $aaba){
            $cnt++;
        }
        if($cnt ==0){
            $this->load->view('mypage/spacelist');
        }

        $paging = $this->paging($cnt);

        $index = 1;

        foreach($continue as $con){
            $jds = $this->novel_model->novelidxtoidx($con->novelidx);


            $row = $this->novellist_model->selectnovel('idx',$jds->idx);           //프로필 이미지
                $row[0]->img = $this->profileimg($jds->idx);

                $creator = $this->creator($row[0]->creator);                    //닉네임
                $row[0]->creator = $creator->nickname;

                $tagarray = explode('#', $row[0]->tag);                         //태그 분류
                $tagindex = 0;
                foreach($tagarray as $tags){
                    if($tags==''){
                        unset($tagarray[$tagindex]);
                        $tagindex++;
                    }
                }
                $row[0]->tag = $tagarray;

                $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
                $row[0]->category = $category[$row[0]->category];

                $date = array('s','i','h','d','m','y');                         //업데이트 시간
                $dates = array('초전','분전','시간전','일전','달전','년전');
                $start = new DateTime($row[0]->created);
                $end = new DateTime(date('Y-m-d H:i:s'));
                $interval = date_diff($start,$end);
                $datesi = 0;
                foreach($date as $data){
                    if($interval->{$data} != 0){
                        $row[0]->created = $interval->{$data}.$dates[$datesi];
                    }
                    $datesi++;
                }

                $novels = $this->novel_model->novelidxdesc('idx',$row[0]->idx);
                $novelindex = $this->novel_model->novelidxcount($row[0]->idx);
                $row[0]->novelindex = $novelindex;
                foreach($novels as $novel){        
                    $row[0]->index[$novelindex]=$novel->novelidx;
                    $novelindex--;
                }

                $row[0]->lastviewer = $con->novelidx;
                $row[0]->listoption = 0;

                if($paging->startcnt<=$index){
                    $this->load->view('mypage/mycontinue',$row[0]);
                }
                if($index==$paging->endcnt){
                    break;
                }
            
                $index++;
                           
        }

        $paging->where = '/continue?page=';
        $this->load->view('mypage/mynovellistfoot');
        
        $this->load->view('mypage/preferpaging',$paging);
        $this->load->view('mypage/mynovelfoot');
        $this->load->view('footer');

    }

    function mynovel(){
        $row = $this->users_model->useridxselect($_SESSION['useridx']);
        $this->load->view('header',$row);

        $index = $_GET['index'];
        $novel = $this->novellist_model->selectnovel('idx',$index);
        $img = $this->img_model->selectimg($index,0);
        
        $this->mystatus($index,'novellist');

        if (isset($img->imgname)) {
            $novel[0]->img = $img->imgname;
        }
        
        $novels = $this->novel_model->idxtonovelidxdesc($index);
        $array = array();
        $i=0;
        foreach ($novels as $no) {

            $array[$i] = $no->novelidx;
            $i++;
        }
        $novel[0]->novels = $array;
        $novel[0]->maxnovels = $i;


        $this->load->view('mypage/novel',$novel[0]);
        $this->load->view('footer');
    }

    function novel(){


        $row = $this->users_model->useridxselect($_SESSION['useridx']);
        $this->load->view('header',$row);
        $novel = $this->novel_model->mynovelidx($_GET['index']);

        $this->mystatus($_GET['index'],'novelidx');

        $novels = $this->novel_model->myidx($novel->idx);
        $index = 1;
        foreach($novels as $no){
            if($no->novelidx == $_GET['index']){
                break;
            }
            $index++;
        }
        $novel->index = $index;

        $this->load->view('novel/noveledit',$novel);
        $this->load->view('footer');
    }

    function novelnotice(){
        $row = $this->users_model->useridxselect($_SESSION['useridx']);
        $this->load->view('header',$row);

        $idx = $_GET['index'];
        $notice = $this->notice_model->rowidx($idx);
        $notice->option = 0;

        $this->load->view('novel/noveledit',$notice);
        $this->load->view('footer');
    }

    public function editnotice(){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $noticeidx = $_POST['novelidx'];
        $this->notice_model->editnotice($title,$content,$noticeidx);
        redirect(base_url().'mypage');
    }

    public function delnotice($idx){
        $this->load->model('comment_model');
        $this->comment_model->idxdelete($idx,1);
        $this->notice_model->delete($idx);
        redirect(base_url().'mypage');
    }

    function mail(){
        $this->statuslogin();
        $this->header();

        $option = isset($_GET['option'])?$_GET['option']:0;
        $useridx = $_SESSION['useridx'];
        switch ($option) {
            case 1:
                $mails = $this->mail_model->from($useridx,0);
                $option = 1;
                break;
            case 2:
                $mails = $this->mail_model->from($useridx,1);
                $option = 2;
                break;
            case 3:
                $mails = $this->mail_model->to($useridx);
                $option = 3;
                break;
            
            default:
                $mails = $this->mail_model->defaultfrom($useridx);
                $option = 0;
                break;
        }


        $maxcnt = 0;
        $nowpage = isset($_GET['page'])?$_GET['page']:0;
        foreach ($mails as $cnts) {
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

        $headerskin = array('maxcnt' => $maxcnt);
        $headerskin['option'] = $option;

        $this->load->view('mail/mail',$headerskin);

        $i = 0;
        foreach($mails as $mail){

            if($i>$endcnt){
                break;
            }
            $to = $this->users_model->idxtonick($mail->touseridx);                              // 닉네임
            $from = $this->users_model->idxtonick($mail->fromuseridx);
            $mail->touseridx = $to->nickname;      
            $mail->fromuseridx = $from->nickname;

            $date = array('s','i','h','d','m','y');                                             //업데이트 시간
            $dates = array('초전','분전','시간전','일전','달전','년전');
            $start = new DateTime($mail->subdate);
            $end = new DateTime(date('Y-m-d H:i:s'));
            $interval = date_diff($start,$end);
            $datesi = 0;
            foreach($date as $data){
                if($interval->{$data} != 0){
                    $mail->subdate = $interval->{$data}.$dates[$datesi];
                }
                $datesi++;
            }
            1;
            $mail->option = $option;

            if($i>=$startcnt){
                $this->load->view('mail/maillist', $mail);
            }
            $i++;
        }
        $footskin['option'] = $option;

        $this->load->view('mail/mailfoot',$footskin);
        $this->load->view('mypage/mynovelfoot');
        $this->load->view('footer');
    }

    public function mystatus($foridx,$table){
        $this->statuslogin();

        $me = $_SESSION['useridx'];
        if($table=='novelidx'){
            $row = $this->novel_model->mynovelidx($foridx);
            $foridx = $row->idx;

        }

        $row = $this->novellist_model->selectidx($foridx);
        $creator = $row->creator;


        if($me != $creator){
            redirect(base_url().'other/wrongapproach');
        }

    }

    public function statuslogin(){
        if(!isset($_SESSION['useridx'])){
            redirect(base_url().'home/login');
        }
    }

    public function removelist($option){
        $this->statuslogin();
        $idx = $_POST['idx'];
        $this->load->model('novellog_model');

        switch ($option) {
            case 1:
                $useridx = $_SESSION['useridx'];
                $user = $this->users_model->useridxselect($useridx);
                $prefers = explode('#', $user->prefer);
                $filter = array_diff($prefers,array($idx,''));
                $string = '';
                foreach ($filter as $f) {
                    $string .= '#'.$f;
                }

                $this->users_model->prefer($string,$useridx);
                $this->novellist_model->prefer($idx);
                $this->novellog_model->minusprefer($idx);
                break;
            
            default:
                $this->load->model('continue_model');
                $this->continue_model->deletenovel($idx);
                break;
        }
    }

    public function _checkprefer(){
        $this->statuslogin();
        $useridx = $_SESSION['useridx'];
        $user = $this->users_model->useridxselect($useridx);
        $prefers = explode('#', $user->prefer);
        $string = '';
        foreach($prefers as $prefer){
            $col = $this->novellist_model->selectidx($prefer);
            if(isset($col->idx)){
                $string .= '#'.$prefer;
            }
        }
        $this->users_model->prefer($string,$useridx);
    }
}