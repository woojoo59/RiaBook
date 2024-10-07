<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('novellist_model');
        $this->load->model('img_model');
        $this->load->model('novel_model');
        $this->load->model('novellog_model');
        $this->load->model('notice_model');
        $this->load->model('mail_model');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }

    function index(){
        if(isset($_COOKIE['nickname']) && !isset($_SESSION['useridx'])){
            redirect('/users/login');
        }
        $row = '';
        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
        }

        $this->load->view('header',$row);

        $rankarray = $this->rankmin1();
        $ranks = $this->todayrank1();
        $skin = array('a' => $rankarray);
        $rankskin = array('a'=>$ranks);

        $notices = $this->notice_model->select('foridx',0);

        $mainskin = array('notices' => $notices );



        $this->load->view('main',$mainskin);
        $this->load->view('search/recommendnovels',$skin);
        $this->load->view('search/recommend',$rankskin);
        $this->load->view('footer');

    }
    function signin(){
        if(isset($_SESSION['useridx'])){
            redirect('/home');
        }
        $this->header(0);
        $this->load->view('user/signin');
        $this->load->view('footer');
    }
    function login(){
        if(isset($_COOKIE['nickname'])){
            $row = $this->users_model->nicknameselect($_COOKIE['nickname']);
            $_SESSION['useridx'] = $row->useridx;
            $this->input->set_cookie('nickname', $row->useridx, 259200);
            redirect('/home');
        }
        if(isset($_SESSION['useridx'])){
            redirect('/home');
        }
        $this->header(0);
        $this->load->view('user/login');
        $this->load->view('footer');
    }

    function password(){
        if(!isset($_POST['phone'])){
            redirect('/home');
        }


        $this->header(0);
        $this->load->view('user/password',$_POST);
        $this->load->view('footer');
    }

    function free(){

        $this->header(2);
        if(!isset($_GET['sort']) or !isset($_GET['category']))redirect(base_url().'other/wrongapproach/0');

        $sortd       = isset($_GET['sort'])?$_GET['sort']:0;
        $categoryd   = isset($_GET['category'])?$_GET['category']:7;

        switch ($sortd) {
            case 1:
                $sort = 'recommendscnt';
                $sortd = 1;
                break;
            case 2:
                $sort = 'prefercnt';
                $sortd = 2;
                break;
            case 3:
                $sort = 'b.hitd';
                $sortd = 3;
                break;
            default:
                $sort = 'created';
                $sortd = 0;
                break;
        }

        switch ($categoryd){
            case 0:
                $category = 'and category = 0 ';
                $categoryd = 0;
                break;
            case 1:
                $category = 'and category = 1 ';
                $categoryd = 1;
                break;
            case 2:
                $category = 'and category = 2 ';
                $categoryd = 2;
                break;
            case 3:
                $category = 'and category = 3 ';
                $categoryd = 3;
                break;
            case 4:
                $category = 'and category = 4 ';
                $categoryd = 4;
                break;
            case 5:
                $category = 'and category = 5 ';
                $categoryd = 5;
                break;
            case 6:
                $category = 'and category = 6 ';
                $categoryd = 6;
                break;
            default:
                $category = '';
                $categoryd = 7;
                break;
        }

        

        $fsearch = $category;
        
        if($sortd==3){
            $flagwhere = $category;
            $novels = $this->novellist_model->hitdesc($flagwhere);
        } else {
            $novels = $this->novellist_model->wherelist($fsearch,$sort);
        }

        
        $cnt = 0;
        foreach ($novels as $novel) {
            $cnt++;
        }
        $header = new stdClass();
        $header->count = $cnt;
        $header->sort = $sortd;
        $header->category = $categoryd;

        $this->load->view('free/freetableheader',$header);
        
        $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
        $date = array('s','i','h','d','m','y');                         
        $dates = array('초전','분전','시간전','일전','달전','년전');


        $page = isset($_GET['page'])?$_GET['page']:0;
        

        $now = 0;
        $startlist = 0+(10*$page);
        $endlist=10+(10*$page);


        foreach ($novels as $novel) {
            $start = new DateTime($novel->created);
            $end = new DateTime(date('Y-m-d H:i:s'));
            $interval = date_diff($start,$end);
            $datesi = 0;
            
            
            foreach($date as $data){
                if($interval->{$data} != 0){
                    $novel->created = $interval->{$data}.$dates[$datesi];
                }
                $datesi++;
            }
            if($now==$endlist){

                break;
            }

            $img = $this->img_model->selectimg($novel->idx,0);
            if(isset($img->imgname)){
                $imgname = $img->imgname;
            } else {
                $imgname = 'default.png';
            }
            $novel->img = $imgname;
        

            $tagarray = explode('#', $novel->tag);                         //태그 분류
            $tagindex = 0;
            foreach($tagarray as $tags){
                if($tags==''){
                    unset($tagarray[$tagindex]);
                    $tagindex++;
                }
            }
            $novel->tag = $tagarray;


            $novel->category=$category[$novel->category];


            $creator = $this->users_model->nicknameselect($novel->creator);
            $novel->creator = $creator->nickname;

            $hit = $this->novel_model->sumhit($novel->idx);
            $novel->hit=$hit->{'sum(hit)'};

            $novel->save = $this->novel_model->novelidxcount($novel->idx);

            if($now>=$startlist){
                $this->load->view('free/freetablelist',$novel);
            }
            
            $now++;
        }

        
        $footer = new stdClass();
        $maxcnt = 0;
        foreach ($novels as $novel){
            $maxcnt++;
        }
        $footer->nowpage = $page;
        $pagecnt = floor($maxcnt/10);
        $maxblock = ceil($pagecnt/5);
        $nowblock = 1+floor($page/5);
        $startpage = 0+(5*($nowblock-1));
        $endpage = $startpage+4;
        if($endpage>$pagecnt){
            $endpage = $pagecnt;
        }
        
        $footer->pagecnt = $pagecnt;        
        $footer->maxblock = $maxblock;
        $footer->nowblock = $nowblock;
        $footer->startpage = $startpage;
        $footer->endpage = $endpage;


        if(!is_numeric($page) || $page>floor($maxcnt/10)){
            redirect(base_url().'home/free');
        }

        $this->load->view('free/freetablefooter',$footer);
        $this->load->view('footer');
    }


    function rankmin1(){
        $this->load->model('recommend_model');

        $date = (date('Y-m-d'));
        $recomen = $this->recommend_model->recommendlist($date);
        $rank = $this->novellog_model->today1();
        $novels = array_merge($recomen,$rank);

        $unique = array();
        $result = array();
        $i=1;
        foreach($novels as $t){
            if (!in_array($t->idx, $unique)){
                $t->rank = $i;
                
                $img = $this->img_model->todayrank($t->idx);
                if(isset($t->creator)){
                    $creator = $this->users_model->todayrank($t->creator);
                } else {
                    $creator = $this->users_model->todayrank($t->useridx);
                }
                $novel = $this->novel_model->todayrank($t->idx);
                $t->img = 'default.png';
                if(isset($img->img)){
                    $t->img = $img->img;
                }
                $t->nick = $creator->nick;
                $t->hit = $novel->hit;
                $t->episode = $novel->episode;

            
                $unique[] = $t->idx;
                $result[] = $t;
                $i++;
            }
            if(isset($result[19]))break;
        }

        return $result;
    }

    function todayrank1(){
        $rank = $this->novellog_model->today1();

        $unique = array();
        $result = array();
        $i=1;
        foreach($rank as $t){
            if (!in_array($t->idx, $unique)){
                $t->rank = $i;
                $img = $this->img_model->todayrank($t->idx);
                $creator = $this->users_model->todayrank($t->creator);
                $novel = $this->novel_model->todayrank($t->idx);
                $t->img = 'default.png';
                if(isset($img->img)){
                    $t->img = $img->img;
                }
                $t->nick = $creator->nick;
                $t->hit = $novel->hit;
                $t->episode = $novel->episode;

                $unique[] = $t->idx;
                $result[] = $t;
                $i++;
            }
            if(isset($result[19]))break;
        }
        return $result; 
    }

    function rank(){
        $this->header(3);


        $tear = isset($_GET['page'])?$_GET['page']:1;
        $getdate = isset($_GET['date'])?$_GET['date']:0;
        $category = isset($_GET['category'])?$_GET['category']:7;
        switch($category){
            case 1:
                $category = 1;
                break;
            case 2:
                $category = 2;
                break;
            case 3:
                $category = 3;
                break;
            case 4:
                $category = 4;
                break;
            case 5:
                $category = 5;
                break;
            case 6:
                $category = 6;
                break;
            default:
                $category = 7;
                break;
        }


        $date = (date('Y-m-d'));
        $timestamp = strtotime($date);

        switch ($getdate) {
            case 1:
                $startdate = date('Y-m-d', strtotime('-1 week', $timestamp));
                $getdate = 1;
                break;
            case 2:
                $startdate = date('Y-m-d', strtotime('-1 month', $timestamp));
                $getdate = 2;
                break;
            default:
                $startdate=$date;
                $getdate = 0;
                break;
        }
        
         
        $sort = isset($_GET['sort'])?$_GET['sort']:0;

        switch ($sort) {
            case 1:
                $sort = 1;
                $one    = 'recommend';
                $two    = 'hit';
                $three  = 'prefer';
                break;
            case 2:
                $sort = 2;
                $one    = 'prefer';
                $two    = 'hit';
                $three  = 'recommend';
                break;
            default:
                $sort = 0;
                $one    = 'hit';
                $two    = 'recommend';
                $three  = 'prefer';
                break;
        }


        $headget = array('date' => $getdate,'sort'=> $sort );
        $headget['category'] = $category;

        $this->load->view('rank/rankmainhead',$headget);
        $line = 1;
        $lineskin = array('line'=>$line);
        $this->load->view('rank/ranklinehead',$lineskin);
        $line++;
        if($category==7){
            $rank = $this->novellog_model->rank($startdate,date('Y-m-d'),$one,$two,$three);
        } else{
            $rank = $this->novellog_model->categoryrank($startdate,date('Y-m-d'),$one,$two,$three,$category);
        }

        for($i=1;$i<=(100*$tear);$i++){
            if(!isset($rank[$i-1]->idx)){
                break;
            }
            $novel = $this->novellist_model->selectidx($rank[$i-1]->idx);
            $novel->rank = $i;
            $novel->dayhit = $rank[$i-1]->hit;
            $novel->dayprefer = $rank[$i-1]->prefer;
            $novel->dayrecommend = $rank[$i-1]->recommend;


            $img = $this->img_model->selectimg($novel->idx,0);
            if(isset($img->imgname)){
                $imgname = $img->imgname;
            } else {
                $imgname = 'default.png';
            }
            $novel->img = $imgname;
            $novel->save = $this->novel_model->novelidxcount($novel->idx);

            $creator = $this->users_model->nicknameselect($novel->creator);
            $novel->creator = $creator->nickname;

            $this->load->view('rank/rank',$novel);
            if($i%5==0 && $i != (100*$tear)){
                $line++;
                $lineskin = array('line'=>$line);
                $this->load->view('rank/ranklinefoot');
                $this->load->view('rank/ranklinehead',$lineskin);
            }
        }
        
        
        $this->load->view('rank/ranklinefoot');



        $skin = array('rank' => $rank, 'tear' => $tear, 'sort' => $sort );
        $this->load->view('rank/rankmainfoot',$skin);
        $this->load->view('footer');
    }

    function search(){
        $this->header(4);
        $rankarray = $this->rankmin1();
        $skin = array('a' => $rankarray);

        // DateTime::createFromFormat을 사용해 'Y-m-d' 형식인지 확인
        
        $col1 = isset($_GET['date'])?$_GET['date']:'2024-01-01';
        $col2 = isset($_GET['fdate'])?$_GET['fdate']:date('Y-m-d');


        $format = 'Y-m-d';
        $d = DateTime::createFromFormat($format, $col1);
        
        // 유효한 형식인지 확인하고, 유효한 날짜인지 체크
        if ($d && $d->format($format) === $col1) {
            $sdate = $col1;
        } else {
            $sdate = '2024-01-01';
        }
        $c = DateTime::createFromFormat($format, $col2);
        if($c && $c->format($format) === $col2){
            $fdate = $col2;
        } else {
            $fdate = date('Y-m-d');
        }
        $skin['sdate'] = $sdate;
        $skin['fdate'] = $fdate;


        
        $this->load->view('search/search',$skin);
        if(isset($_GET['input'])){

            $dosrt      = isset($_GET['sort'])?(int)$_GET['sort']:0;
            $dcategory  = isset($_GET['category'])?(int)$_GET['category']:7;
            $dsoption   = isset($_GET['soption'])?(int)$_GET['soption']:0;

            $sortd       = ($dosrt<=3 and $dosrt>=0) ?$dosrt:0;
            $categoryd   = ($dcategory<=7 and $dcategory>=0) ?$dcategory:7;
            $soptiond    = ($dsoption<=2 and $dsoption>=0) ?$dsoption:0;
            
            $input = $_GET['input'];

            $flag = 0;

            

            $sortflag = 0;
            switch ($sortd) {
                case 1:
                    $sort = 'recommendscnt';
                    break;
                case 2:
                    $sort = 'prefercnt';
                    break;
                case 3:
                    $sortflag = 1;
                default:
                    $sort = 'created';
                    break;
            }
    
            switch ($categoryd){
                case 0:
                    $category = 'and category = 0 ';
                    break;
                case 1:
                    $category = 'and category = 1 ';
                    break;
                case 2:
                    $category = 'and category = 2 ';
                    break;
                case 3:
                    $category = 'and category = 3 ';
                    break;
                case 4:
                    $category = 'and category = 4 ';
                    break;
                case 5:
                    $category = 'and category = 5 ';
                    break;
                case 6:
                    $category = 'and category = 6 ';
                    break;
                default:
                    $category = '';
                    break;
            }
            if($input != ''){
                switch ($soptiond) {
                case 0:
                    $search = 'and subject like "%'.$input.'%"';
                    break;
                case 1:
                    $flag = 1;
                    break;
                case 2:
                    $search = 'and tag like "%'.$input.'%"';
                    break;
                }
            }
            
            if($input == ''){
                $search = '';
            }
            if($flag == 0){

                $fsearch = $category.$search.' and DATE(created) BETWEEN "'.$sdate.'" AND "'.$fdate.'"';
                $novels = $this->novellist_model->wherelist($fsearch,$sort);
                if($sortflag == 1){
                    $flagwhere = $category.$search;
                    $novels = $this->novellist_model->hitdesc($flagwhere);
                }
            } else if ($flag == 1){
                $novels = $this->novellist_model->nicklike($input);
            }

            $date = array('s','i','h','d','m','y');                         
            $dates = array('초전','분전','시간전','일전','달전','년전');

            $page = isset($_GET['page'])?$_GET['page']:0;
        

            $now = 0;
            $startlist = 0+(10*$page);
            $endlist=10+(10*$page);

            $cnt = array('cnt' => 0 );
            foreach($novels as $cnts){
                $cnt['cnt']++;
            }

            $this->load->view('search/searchlisthead',$cnt);
            foreach ($novels as $novel) {
                $start = new DateTime($novel->created);
                $end = new DateTime(date('Y-m-d H:i:s'));
                $interval = date_diff($start,$end);
                $datesi = 0;
                
                if($now==$endlist)break;
                
                
                foreach($date as $data){
                    if($interval->{$data} != 0){
                        $novel->created = $interval->{$data}.$dates[$datesi];
                    }
                    $datesi++;
                }

                $img = $this->img_model->selectimg($novel->idx,0);
                if(isset($img->imgname)){
                    $imgname = $img->imgname;
                } else {
                    $imgname = 'default.png';
                }
                $novel->img = $imgname;
            
    
                $tagarray = explode('#', $novel->tag);                         //태그 분류
                $tagindex = 0;

                foreach($tagarray as $tags){
                    if($tags==''){
                        unset($tagarray[$tagindex]);
                        $tagindex++;
                    }
                }

                $novel->tag = $tagarray;

                $creator = $this->users_model->nicknameselect($novel->creator);
                $novel->creator = $creator->nickname;
    
                $hit = $this->novel_model->sumhit($novel->idx);
                $novel->hit=$hit->{'sum(hit)'};
    
                $novel->save = $this->novel_model->novelidxcount($novel->idx);

                

                if($now>=$startlist){
                    $this->load->view('search/searchlist',$novel);
                }
                $now++;
            }
            $footer = new stdClass();
            $maxcnt = 0;
            foreach ($novels as $novel){
                $maxcnt++;
            }
            $footer->now = $now; 
            $footer->nowpage = $page; //현재 페이지
            $footer->maxcnt = $maxcnt; //총 갯수

            $footer->maxpage = floor($maxcnt/10);
            if($footer->maxpage!=0 && $maxcnt%10==0){
                $footer->maxpage = $footer->maxpage-1;
            }
            $footer->maxblock = floor($footer->maxpage/5);
            $footer->nowblock = floor($page/5);
            $footer->startpage = 0+(5*$footer->nowblock);
            $footer->endpage = $footer->startpage+4;
            if($footer->endpage>$footer->maxpage){
                $footer->endpage = $footer->maxpage;
            }
            $footer->sortd     = $sortd    ;
            $footer->categoryd = $categoryd;
            $footer->soptiond  = $soptiond ;
            $footer->date = $sdate; 
            $footer->fdate = $fdate;              
            $this->load->view('search/searchlistfoot',$footer);
        }
        $this->load->view('search/recommendnovels', $skin);
        
        $this->load->view('search/searchfoot');
        $this->load->view('footer');
    }

    function notice(){
        $this->header(1);
        $headerskin = array('tap' => 0 );
        if(isset($_SESSION['useridx'])){
            $this->load->view('complain/tapheader',$headerskin);
        }
        $this->load->model('notice_model');
        $notices = $this->notice_model->select('foridx',0);
        


        $maxcnt = 0;
        $nowpage = isset($_GET['page'])?$_GET['page']:0;
        foreach ($notices as $cnts) {
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


        
        $this->load->view('notice/notice');

        $index = 0;
        foreach($notices as $notice){
            if($index>$endcnt){
                break;
            }

            $notice->img = 0;
            if(strpos($notice->content, '<img src=')){
                $notice->img = 1;
            }


            if($index>=$startcnt){
              $this->load->view('notice/noticelistpage', $notice);  
            }
            $index++;
        }
        
        $this->load->view('notice/noticefooter',$footskin);
        $this->load->view('footer');
    }

    public function header($i){
        if(isset($_COOKIE['nickname']) && !isset($_SESSION['useridx'])){
            redirect('/users/login');
        }
        $row = '';

        if(isset($_SESSION['useridx'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
            $row->data = $i;
        } else {
            $row = array('data'=>$i);
        }
        $this->load->view('header',$row);
    }

    function rankminview(){
        $this->load->view('rankmin');
    }
    function rankminview2(){
        $this->load->view('rankmin2');
    }

    public function loading(){
        $this->load->view('loading');
    }

    function test(){

        $this->load->view('test');
    }


}
