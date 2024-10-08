<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Master extends CI_Controller {

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
        if(!isset($_SESSION['useridx']) or $_SESSION['useridx']!=1){
            redirect(base_url().'other/wrongapproach');
        }
        $url = $_SERVER['REQUEST_URI'];
        if($url != '/master' and $url != '/master/check' and '/master/cook' != $url){
            $this->_mastercheck();
        }
    }

    function index(){
        if(!isset($_SESSION['master'])){
            $row = $this->users_model->useridxselect($_SESSION['useridx']);
            $this->load->view('master/view',$row);
        } else {
            $this->_mastercheck();
            $this->load->view('master/header');



            $class = array('에피소드','공지','쪽지','댓글','댓글','소설');

            $repots = $this->report_model->select();
            foreach($repots as $r){
                switch ($r->class) {
                    case 1:
                        $for1 = $this->notice_model->rowidx($r->foridx);
                        if(!isset($for1->foridx)){
                            $this->report_model->delete($r->reportidx);
                        } else{
                            $for = $this->novellist_model->selectidx($for1->foridx);
                                if(!isset($for->idx)){
                                $this->report_model->delete($r->reportidx);
                            }
                        }
                        break;
                    case 2:
                        $for = $this->mail_model->idxselect($r->foridx);
                        if(!isset($for->mailidx)){
                            $this->report_model->delete($r->reportidx);
                        }
                        break;
                    case 3:
                        $for = $this->comment_model->idxselect($r->foridx);
                        if(!isset($for->cidx)){
                            $this->report_model->delete($r->reportidx);
                        }
                        break;
                    case 4:
                        $for = $this->comment_model->idxselect($r->foridx);
                        if(!isset($for->cidx)){
                            $this->report_model->delete($r->reportidx);
                        }
                        break;
                    case 5:
                        $for = $this->novellist_model->selectidx($r->foridx);
                        if(!isset($for->idx)){
                            $this->report_model->delete($r->reportidx);
                        }
                        break;
                    
                    default:
                        $for1 = $this->novel_model->mynovelidx($r->foridx);
                        if(!isset($for1->idx)){
                            $this->report_model->delete($r->reportidx);
                        }else{
                            $for = $this->novellist_model->selectidx($for1->idx);
                            if(!isset($for->idx)){
                                $this->report_model->delete($r->reportidx);
                            }
                        }
                        break;
                }
            }
            $repots = $this->report_model->select();
            $maxcnt = 0;
            foreach($repots as $repot){
                $maxcnt++;
            }

            $page = isset($_GET['page'])?$_GET['page']:0;
            $pageskin = array('cnt' => $maxcnt );
            $maxpagecnt = ceil($maxcnt/10);
            $startcnt = 0 + (10*$page);
            $lastcnt = 9 + (10*$page);
            $nowblock = 1+floor($page/5);
            $maxblockcnt = ceil($maxpagecnt/5);
            $startpage = 0+(5*($nowblock-1));
            $endpage = $startpage+4;
            if($endpage>$maxpagecnt){
                $endpage = $maxpagecnt-1;
            }
            $pageskin = array('nowpage'=> $page, 'nowblock'=>$nowblock, 'maxblock'=>$maxblockcnt, 'startpage'=>$startpage, 'endpage'=>$endpage);

            $index = 0;
            foreach($repots as $repot){
                if($index>$lastcnt)break;
                if($index>=$startcnt){

                    $repot->classname = $class[$repot->class];
                    switch ($repot->class) {
                        case 1:
                            $repot->class = 4;
                            $for1 = $this->notice_model->rowidx($repot->foridx);
                            $for = $this->novellist_model->selectidx($for1->foridx);
                            $repot->baduser = $for->creator;
                            break;
                        case 2:
                            $repot->class = 3;
                            $for = $this->mail_model->idxselect($repot->foridx);
                            $repot->baduser = $for->fromuseridx;
                            break;
                        case 3:
                            $repot->class = 1;
                            $for = $this->comment_model->idxselect($repot->foridx);
                            $repot->baduser = $for->creator;
                            break;
                        case 4:
                            $repot->class = 1;
                            $for = $this->comment_model->idxselect($repot->foridx);
                            $repot->baduser = $for->creator;
                            break;
                        case 5:
                            $repot->class = 0;
                            $for = $this->novellist_model->selectidx($repot->foridx);
                            $repot->baduser = $for->creator;
                            break;
                        
                        default:
                            $repot->class = 2;
                            $for1 = $this->novel_model->mynovelidx($repot->foridx);
                            $for = $this->novellist_model->selectidx($for1->idx);
                            $repot->baduser = $for->creator;
                            break;
                    }
                    $nick = $this->users_model->idxtonick($repot->useridx);
                    $repot->nick = $nick->nickname;
                    $this->load->view('master/list',$repot);
                }
                $index++;
            }

            $usernum    = $this->users_model->numusers();                                           //총 유저수
            $active     = $this->users_model->activenum();                                          //활동 유저수
            $stop       = $this->users_model->stopnum();                                            //정지된 유저수
            
            $novelnum   = $this->novellist_model->novelnum();                                       //총 소설 수
            $categorynum = array();
            for($i=0;$i<7;$i++){
                $categorynum[$i] = $this->novellist_model->categorynum($i);
            }

            $pageskin['user'] = $usernum;
            $pageskin['auser'] = $active;
            $pageskin['suser'] = $stop;
            $pageskin['novel'] = $novelnum;
            $pageskin['category'] = $categorynum;
            $this->load->view('master/footer',$pageskin);
        }

    }

    function recommend(){
        $this->load->view('master/recommend/header');
        $this->load->view('master/recommend/modal');
    }

    public function recommendlist($date){
        

        $recomen = $this->recommend_model->today($date);
        if(isset($recomen[0])){
            $this->load->view('master/recommend/tableheader');
            $i=1;
            foreach($recomen as $a){
                $a->rank = $i;

                $this->load->view('master/recommend/tablelist', $a);
                $i++;
            }
            $this->load->view('master/recommend/tablefooter');
        } else{echo '추천작 리스트가 없어 랭킹이 표시됩니다.';}
    }
    public function selectnovel($idx){
        $novel = $this->novellist_model->recomendmanage($idx);
        $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
        $novel->categoryn = $category[$novel->category];
        if($novel->imgname == '')$novel->imgname = 'default.png';
        $this->load->view('master/recommend/list2', $novel);
    }
    public function deleterecommend($idx){
        switch ($_GET['option']) {
            case 1:
                $this->recommend_model->deleteafter($idx,$_GET['date']);
                break;
            
            default:
               $this->recommend_model->deleteday($idx,$_GET['date']);
                break;
        }        
        redirect(base_url().'master/recommend?date='.$_GET['date']);
    }

    function imsi(){
        $imsi = 1;
        for($i=50;$i<110;$i++){
            $date = '2024-09-30';
            if($i>=70)$date='2024-10-01';
            if($i>=90)$date='2024-10-02';
            $novel = $this->novellist_model->selectidx($i);
            $this->recommend_model->add($i, $novel->creator, $date);
            if(!isset($novel->idx)){
                echo 'here';
            }
            echo $imsi.'번째 반복 완료';
            echo '<hr>';
            $imsi++;
        }
    }


    function user($page){
        $this->_mastercheck();
        $andwhere = '';
        $sort = 'useridx desc';
        $users = $this->users_model->masterselect($andwhere,$sort);
        $category = 'a';
        $input = '';
        if(isset($_GET['category']) and isset($_GET['input'])){
            switch ($_GET['category']) {
                case 0:
                    $like = $_GET['input'];
                    $users = $this->users_model->master1('%'.$like.'%');
                    $category = 0;
                    $input = $_GET['input'];
                    break;
                case 1:
                    $like = $_GET['input'];
                    $users = $this->users_model->master2('%'.$like.'%');
                    $category = 1;
                    $input = $_GET['input'];
                    break;
                case 2:
                    $like = $_GET['input'];
                    $users = $this->users_model->master3('%'.$like.'%');
                    $category = 2;
                    $input = $_GET['input'];
                    break;
                case 3:
                    $like = $_GET['input'];
                    $users = $this->users_model->master4('%'.$like.'%');
                    $category = 3;
                    $input = $_GET['input'];
                    break;
                case 4:
                    $status = array('정지', '활동', '경고 1회', '경고 2회');
                    $like = $_GET['input'];
                    $input = $_GET['input'];
                    $category = 4;
                    if($like == ''){
                        break;
                    }
                    $filtered = array_filter($status, function($item) use ($like) {
                        return strpos($item, $like) !== false;  // '경고'가 포함된 항목만 반환
                    });

                    $keys = array_keys($filtered);

                    if(!isset($keys[0])){
                        $users = array();
                        break;
                    }  
                    $users = $this->users_model->master5($keys[0]);
                    if(isset($keys[1])){
                        $users1 = $this->users_model->master5($keys[1]);
                        $users = array_merge($users,$users1);
                    }
                    break;
                default:
                    // code...
                    break;
            }
        }


        $maxcnt = 0;
        foreach($users as $u){
            $maxcnt++;
        }
        $headerskin = array('cnt' =>$maxcnt );
        $statusarray = array('정지', '활동', '경고 1회', '경고 2회');
        

        $maxpagecnt = ceil($maxcnt/10);
        $startcnt = 0 + (10*$page);
        $lastcnt = 9 + (10*$page);
        $nowblock = 1+floor($page/5);
        $maxblockcnt = ceil($maxpagecnt/5);
        $startpage = 0+(5*($nowblock-1));
        $endpage = $startpage+4;
        if($endpage>$maxpagecnt){
            $endpage = $maxpagecnt-1;
        }
        $pageskin = array('nowpage'=> $page, 'nowblock'=>$nowblock, 'maxblock'=>$maxblockcnt, 'startpage'=>$startpage, 'endpage'=>$endpage, 'maxpage'=>$maxpagecnt-1);
        $pageskin['category'] = $category;
        $pageskin['input'] = $input;

        $index = 0;
        $headerskin['category'] = $category;
        $headerskin['input'] = $input;

        $this->load->view('master/user/header',$headerskin);
        foreach($users as $user){
            if($index>$lastcnt) break;
            if($index>=$startcnt){
                $user->setting = explode('@', $user->setting);
                $user->address = explode('/',$user->address);
                if(!isset($user->address[1])){$user->address[1] = '';}
                if(!isset($user->address[2])){$user->address[2] = '';}
                $user->statusn = $statusarray[$user->status];
                $this->load->view('master/user/list1',$user);
            }
            $index++;
        }

        if($pageskin['nowpage'] > $pageskin['endpage'] and $maxcnt > 0){
            redirect(base_url().'other/wrongapproach');
        }
        if($maxcnt == 0){
            $this->load->view('master/user/spacelist');
        }

        $this->load->view('master/user/footer',$pageskin);

    }

    function usersnovellist(){
        $novels = $this->novellist_model->masterselect($_POST['useridx']);
        $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
        foreach($novels as $novel){
            $epicnt = $this->novel_model->novelidxcount($novel->idx);
            $hit = $this->novel_model->sumhit($novel->idx);
            $novel->epicnt = $epicnt;
            $novel->hit = $hit->{'sum(hit)'};
            $novel->categoryn = $category[$novel->category];
            $this->load->view('master/user/list2',$novel);
        }
        
    }

    function novels($page){
        $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
        $novels = $this->novellist_model->master();
        $option = '';
        $input = '';
        if(isset($_GET['category']) and isset($_GET['input']) and $_GET['input'] != ''){
            $option = $_GET['category'];
            $input = $_GET['input'];
            switch ($option) {
                case 0:
                    $novels = $this->novellist_model->master1($input);
                    $option = 0;
                    break;
                case 1:
                    $novels = $this->novellist_model->master2($input);
                    $option = 1;
                    break;
                case 2:
                    $num = array_search($input, $category);
                    $option = 2;
                    if($num == null){
                        $novels = $this->novellist_model->master3_1();
                    } else {
                        $novels = $this->novellist_model->master3($num);
                    }
                    break;
                case 3:
                    $novels = $this->novellist_model->master4($input);
                    $option = 3;
                    break;
                
                default:
                    // code...
                    break;
            }

        }
        $open = '';
        if(isset($_POST['input'])){
            $postidx = $_POST['input'];
            $_SESSION['postidx'] = $postidx;
            redirect(base_url().'master/novels');
        }
        if(isset($_SESSION['postidx'])){
            $open = $_SESSION['postidx'];
            unset($_SESSION['postidx']);
        }
        if($open != ''){
            $cnt = 0;
            foreach ($novels as $novel){
                if($novel->idx == $open)break;
                $cnt++;
            }
            $page = floor($cnt/10);
        }

        $maxcnt = 0;
        foreach($novels as $u){
            $maxcnt++;
        }
        $maxpagecnt = ceil($maxcnt/10);
        $startcnt = 0 + (10*$page);
        $lastcnt = 9 + (10*$page);
        $nowblock = 1+floor($page/5);
        $maxblockcnt = ceil($maxpagecnt/5);
        $startpage = 0+(5*($nowblock-1));
        $endpage = $startpage+4;
        if($endpage>=$maxpagecnt){
            $endpage = $maxpagecnt-1;
        }
        $pageskin = array('nowpage'=> $page, 'nowblock'=>$nowblock, 'maxblock'=>$maxblockcnt, 'startpage'=>$startpage, 'endpage'=>$endpage, 'maxpage'=>$maxpagecnt-1);
        $pageskin['category'] = $option;
        $pageskin['input'] = $input;
        $pageskin['open'] = $open;
        $index = 0;

        $headerskin = array('cnt' => $maxcnt, 'option' => $option, 'input' => $input);
        $this->load->view('master/novels/header',$headerskin);
        foreach($novels as $novel){
            if($index>$lastcnt)break;
            if($index >= $startcnt){
                if($novel->imgname == null){
                    $novel->imgname = 'default.png';
                }
                $nick = $this->users_model->idxtonick($novel->creator);
                $novel->creatorn = $nick->nickname;
                $novel->categoryn = $category[$novel->category];
                if($novel->status == 0){
                    $novel->statusn = '공개';
                } else {
                    $novel->statusn = '비공개';
                }
                // if($index == 0)print_r($novel);
                $this->load->view('master/novels/list1',$novel);
            }
            $index++;
        }
        if($pageskin['nowpage'] > $pageskin['endpage'] and $maxcnt > 0){
            redirect(base_url().'other/wrongapproach');
        }
        if($maxcnt == 0){
            $this->load->view('master/novels/spacelist');
        }
        $this->load->view('master/novels/footer',$pageskin);
    }

    function novelslist($page){
        $idx = $_POST['idx'];
        $notices = $this->notice_model->select('foridx',$idx);
        $novels = $this->novel_model->master($idx);

        $open = '';
        $maxcnt = 0;
        $last = 0;
        foreach($novels as $u){
            $maxcnt++;
            if($u->status == 0){
                $last++;
            }
        }

        $maxpagecnt = ceil($maxcnt/10);
        $startcnt = 0 + (10*$page);
        $lastcnt = 9 + (10*$page);
        $nowblock = 1+floor($page/5);
        $maxblockcnt = ceil($maxpagecnt/5);
        $startpage = 0+(5*($nowblock-1));
        $endpage = $startpage+4;
        if($endpage>$maxpagecnt){
            $endpage = $maxpagecnt-1;
        }
        $pageskin = array('nowpage'=> $page, 'nowblock'=>$nowblock, 'maxblock'=>$maxblockcnt, 'startpage'=>$startpage, 'endpage'=>$endpage, 'idx'=>$idx);

        $index = 0;
        foreach($novels as $novel){
            if($index>$lastcnt)break;
            if($index>=$startcnt){{
                $novel->episode = $last;
                if($novel->status == 0){
                    $novel->statusn = '공개';
                } else {
                    $novel->statusn = '비공개';
                }
                $novel->page = $page;
                $this->load->view('master/novels/list2',$novel);
            }}

            
            if($novel->status == 0){
                $last--;
                $index++;
            }
        }
        if(isset($_POST['novelidx'])){
            $open = $_POST['novelidx'];
        }
        $pageskin['open'] = $open;
        $this->load->view('master/novels/list2page',$pageskin);
    }

    public function nick(){
        $row = $this->users_model->nickname($_POST['nick']);
        if(isset($row->useridx)){
            $result = array('result' => 0);
            die(json_encode($result));
        }
        $this->users_model->masterup4($_POST['nick'],$_POST['useridx']);
        $result = array('result' => 1);
        die(json_encode($result));
    }

    public function episodec(){
        $nowstatus = $_POST['status'];
        $novelidx = $_POST['novelidx'];
        $status = ($nowstatus==0)?1:0;
        $this->novel_model->editstatus($status,$novelidx);
    }

    public function novellistc(){
        $idx = $_POST['idx'];
        $status = $_POST['status'];
        $this->novellist_model->editstatus($idx,$status);
    }

    public function check(){
        if(password_verify($_POST['check'], $_POST['ck'])){
            $f1 = array('result' => 1);  
        } else {
            $f1 = array('result' => 0);
        }
        die(json_encode($f1));
    }

    public function cook(){
        if(password_verify($_POST['check'], $_POST['ck'])){
            $ps = 'forjds@bywoojoo';
            $pwd = password_hash($ps, PASSWORD_BCRYPT);
            $_SESSION['master']= $pwd;
            $result['result']=1;
        }
        redirect(base_url().'master');
    }

    public function _mastercheck(){
        $ps = 'forjds@bywoojoo';
        if(!isset($_SESSION['master']) or !password_verify($ps, $_SESSION['master'])){
            redirect(base_url().'other/wrongapproach');
        }
    }

    public function search(){
        $category = $_POST['category'];
        $idx = $_POST['idx'];

        switch ($category) {
            case 1:
                $result = $this->comment_model->idxselect($idx);
                $nick = $this->users_model->idxtonick($result->creator);
                $result->nickname = $nick->nickname;
                break;
            case 2:
                $result = $this->novel_model->mynovelidx($idx);
                $novellist = $this->novellist_model->selectidx($result->idx);
                $nick = $this->users_model->idxtonick($novellist->creator);
                $result->nickname = $nick->nickname;
                $result->subject = $novellist->subject;
                break;
            case 3:
                $result = $this->mail_model->idxselect($idx);
                break;
            case 4:
                $result = $this->notice_model->rowidx($idx);
                break;   
            default:
                $result = $this->novellist_model->selectidx($idx);
                if($result != null){
                    $img = $this->img_model->selectimg($idx,0);
                    $hit = $this->novel_model->sumhit($idx);
                    $result->img = 'default.png';
                    $result->hit = $hit;
                    $episode = $this->novel_model->novelidxcount($idx);
                    $result->episode = $episode;
                    $result->episodes = $this->novel_model->idxtonovelidxdesc($idx);
                if($img != null){
                    $result->img = $img->imgname;
                }
                }
                break;
        }
            die(json_encode($result));
    }


    public function statusc(){
        $this->users_model->masterup0($_POST['status'],$_POST['useridx']);
    }
    public function identifierc(){
        $this->users_model->masterup1($_POST['identifier'],$_POST['useridx']);
    }
    public function passwordc(){
        $pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $this->users_model->masterup2($pwd,$_POST['useridx']);
    }
    public function usernamec(){
        $this->users_model->masterup3($_POST['username'],$_POST['useridx']);
    }
    public function userpoint(){
        $this->users_model->masterpoint($_POST['mypoint'],$_POST['useridx']);
    }


    public function hereuser($idx){
        $user = $this->users_model->useridxselect($idx);
        $user->address = explode('/', $user->address);
        $this->load->view('master/search/hereuser', $user);
    }

    public function novellist(){
        $book = $_POST;
        $category = array('판타지', '무협', '로맨스', '드라마', '라이트 노벨', '패러디', '기타');
        $book['category'] = $category[$book['category']];
        $nick = $this->users_model->idxtonick($book['creator']);
        $book['nick'] = $nick->nickname;
        $this->load->view('master/search/novellist', $book);
    }

    public function comment(){
        $comment = $_POST;
        if($comment['category']==0) $comment['category']='소설';
        if($comment['category']==1) $comment['category']='공지';

        $this->load->view('master/search/comment', $comment);
    }

    public function novel(){
        $novel = $_POST;
        $this->load->view('master/search/novel', $novel);
    }

    public function mail(){
        $mail = $_POST;
        $tonick = $this->users_model->idxtonick($mail['touseridx']);
        $fromnick = $this->users_model->idxtonick($mail['fromuseridx']);
        $mail['tonick'] = $tonick->nickname;
        $mail['fromnick'] = $fromnick->nickname;
        $this->load->view('master/search/mail', $mail);
    }

    public function notice(){
        $notice = $_POST;
        $novellist = $this->novellist_model->selectidx($notice['foridx']);
        $tonick = $this->users_model->idxtonick($novellist->creator);
        $notice['subject'] = $novellist->subject;
        $notice['nickname'] = $tonick->nickname;
        $this->load->view('master/search/notice', $notice);
    }

    function editnovel(){
        $episode = $this->novel_model->novelidxselect($_POST['novelidx']);
        $novel = $this->novellist_model->selectidx($episode->idx);

        $this->novel_model->editstatus($_POST['status'],$_POST['novelidx']);


        if(isset($_POST['penalty'])){
            $this->_penalty($novel->creator,'소설 : "<a href="'.base_url().'novel/novel?novelidx='.$novel->idx.'">'.$novel->subject.'</a>"
                의 소설 타이틀 : "<a href="'.base_url().'novel/viewer?index='.$episode->novelidx.'">'.$episode->title.'</a>"');
        }
        $this->_goback();

    }

    function editnotice(){
        $notice = $this->notice_model->rowidx($_POST['noticeidx']);
        $novel = $this->novellist_model->selectidx($notice->foridx);
        if(isset($_POST['penalty'])){
            $this->_penalty($novel->creator,'소설 : "<a href="'.base_url().'novel/novel?novelidx='.$novel->idx.'">'.$novel->subject.'</a>"
                의 공지 타이틀 : "<a href="'.base_url().'notice/viewer?index='.$notice->noticeidx.'">'.$notice->title.'</a>"');
        }
        if(isset($_POST['option'])){
            $this->notice_model->delete($notice->noticeidx);
            $this->report_model->fordelete($notice->noticeidx,1);
        }
        $this->_goback();
    }

    function edituser(){
        $user = $this->users_model->useridxselect($_POST['useridx']);
        $content = array('RiaBook계정이 정지되었습니다.', 'RiaBook계정이 활동가능 상태가 되었습니다.',
         'RiaBook계정이 경고 1회 상태가 되었습니다.<br>경고 3회 누적시 계정이 정지되오니 사이트 이용에 유의 바랍니다.',
        'RiaBook계정이 경고 2회 상태가 되었습니다.<br>경고 3회 누적시 계정이 정지되오니 사이트 이용에 유의 바랍니다.');
        $content1 = array('RiaBook계정이 정지되었습니다.', 'RiaBook계정이 활동가능 상태가 되었습니다.',
         'RiaBook계정이 경고 1회 상태가 되었습니다.
경고 3회 누적시 계정이 정지되오니 사이트 이용에 유의 바랍니다.',
        'RiaBook계정이 경고 2회 상태가 되었습니다.
경고 3회 누적시 계정이 정지되오니 사이트 이용에 유의 바랍니다.');

        if(isset($_POST['option'])){
            if($_POST['option']==0){
                $subject = 'RiaBook계정의 상태가 변경되었습니다.';
                $this->_submail($_POST['useridx'],$subject,$content[$_POST['status']]);

            } else if($_POST['option']==1){
                $this->_subsms($_POST['useridx'],$content1[$_POST['status']]);
            }
        }

        if($_POST['password'] != null){
            $pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $this->users_model->passwordidx($pwd,$_POST['useridx']);
        }

        $this->users_model->penalty($_POST['useridx'],$_POST['status']);

        $this->_goback();
    }

    function editnovellist(){
        $novel = $this->novellist_model->selectidx($_POST['idx']);
        if(isset($_POST['penalty'])){
            $this->_penalty($novel->creator,'소설 : "<a href="'.base_url().'novel/novel?novelidx='.$novel->idx.'">'.$novel->subject.'</a>"');
        }
        $this->novellist_model->editstatus($novel->idx,$_POST['status']);
        $this->_goback();
    }

    function editcomment(){
        


        $comment = $this->comment_model->idxselect($_POST['cidx']);


        if($comment->category == 0){
            $episode = $this->novel_model->novelidxselect($comment->foridx);
            $novel = $this->novellist_model->selectidx($episode->idx); 
            
            if(isset($_POST['penalty'])){
                $this->_penalty($novel->creator,'소설 : "<a href="'.base_url().'novel/novel?novelidx='.$novel->idx.'">'.$novel->subject.'</a>"
                    의 소설 타이틀 : "<a href="'.base_url().'novel/viewer?index='.$episode->novelidx.'">'.$episode->title.'</a>"
                    의 댓글 "'.$comment->content.'"');
            }
        } else if($comment->category == 1){
            $notice = $this->notice_model->rowidx($comment->foridx);
            if($notice->foridx == 0){
                if(isset($_POST['penalty'])){
                    $this->_penalty($comment->creator,'공지 : "<a href="'.base_url().'notice/view?view='.$notice->noticeidx.'">'.$notice->subject.'</a>"
                    의 댓글 "'.$comment->content.'"');
                }
            } else {
                $novel = $this->novellist_model->selectidx($notice->foridx);
                if(isset($_POST['penalty'])){
                    $this->_penalty($novel->creator,'소설 : "<a href="'.base_url().'novel/novel?novelidx='.$novel->idx.'">'.$novel->subject.'</a>"
                    의 공지 타이틀 : "<a href="'.base_url().'notice/viewer?index='.$notice->noticeidx.'">'.$notice->title.'</a>"
                    의 댓글 "'.$comment->content.'"');
                }
            }
            
        }
        if(isset($_POST['option'])){
            $recommnet = $this->comment_model->selectrecomment($_POST['cidx']);
            if(isset($recommnet[0])){
                $this->comment_model->removecomment($_POST['cidx']);
                echo '1';
            } else {
                $this->comment_model->deletecomment($_POST['cidx']);
                echo '2';
            }
            $this->report_model->fordelete($_POST['cidx'],4);
            $this->report_model->fordelete($_POST['cidx'],3);
        }
        $this->_goback();
    }

    function editmail(){
        $mail = $this->mail_model->idxselect($_POST['mailidx']);
        $touser = $this->users_model->useridxselect($mail->touseridx);

        if(isset($_POST['penalty'])){
            if($_POST['penalty'] != 2){
                $this->_penalty($mail->fromuseridx,'유저 "'.$touser->nickname.'"님께 보낸 쪽지 : "'.$mail->subject.'"');
            } else if($_POST['penalty']==2){
                $touseridx = $mail->fromuseridx;
                $fromuseridx = $_SESSION['useridx'];
                $subject = '부적절한 내용에 대한 경고메일입니다.';
                $content = '<p>유저 "'.$touser->nickname.'"님께 보낸 쪽지 "'.$mail->subject.'"에 부적절한 내용이 발견되었습니다.</p><p>해당 메일은 현재 삭제 되었으며 쪽지 이용에 주의 부탁드립니다.</p><p><font color="#cec6ce"><font size="3px">ps.자세한 사항은 문의사항을 이용 바랍니다.</font></font></p>';
                $subdate = date('Y-m-d H:i:s');
                $this->mail_model->add($touseridx,$fromuseridx,$subject,$content,$subdate);
            }
        }
        $this->mail_model->delete($_POST['mailidx']);
        $this->report_model->fordelete($_POST['mailidx'],2);
        $this->_goback();
    }

    public function _goback(){
        echo '<script>';
        echo 'history.back()';
        echo '</script>';
    }

    public function _penalty($useridx,$where){
        if($_POST['penalty'] != 'on'){
            $user = $this->users_model->useridxselect($useridx);

            if($_POST['penalty']==0){
                $status = $user->status + 1;
                if($status > 3){
                    $status = 0;
                }
                if($status == 2){
                    $flag = 1;
                } else if($status == 3){
                    $flag = 2;
                }
                if(isset($flag)){
                    $touseridx = $useridx;
                    $fromuseridx = $_SESSION['useridx'];
                    $subject = '부적절한 내용에 대한 경고메일입니다.';
                    $content = '<p>'.$where.'에 부적절한 내용이 발견되었습니다.</p><p>현재 '.$flag.'회 경고 조치 되셨으며 경고 3회 누적 시</p><p>해당 아이디는 정지     됩니다.</p><p> 이에 유념하여 즐거운 RiaBook이용 되시길 바랍니다.</p><p><font color="#cec6ce"><font size="3px">ps.자세한 사항은 문의사항을 이용        바랍니다.</font></font></p>';
                    $subdate = date('Y-m-d H:i:s');
                    $this->mail_model->add($touseridx,$fromuseridx,$subject,$content,$subdate);
                }
                $this->users_model->penalty($user->useridx,$status);
            } else if ($_POST['penalty']==1){
                $this->users_model->penalty($user->useridx,0);
            } else if($_POST['penalty']==2){
                $touseridx = $useridx;
                $fromuseridx = $_SESSION['useridx'];
                $subject = '부적절한 내용에 대한 경고메일입니다.';
                $subdate = date('Y-m-d H:i:s');
                $content = '<p>'.$where.'에 부적절한 내용이 발견되었습니다.</p><p>다른 사용자를 위한 빠른 조치 부탁드립니다.</p><p><font color="#cec6ce"><font   size="3px">ps.자세한 사항은 문의사항을 이용 바랍니다.</font></font></p>';
                $this->mail_model->add($touseridx,$fromuseridx,$subject,$content,$subdate);
            }
            $this->users_model->penalty(1,1);
        }
    }


    public function _submail($useridx,$subject,$content){
        $user = $this->users_model->useridxselect($useridx);
        
        include './static/lib/PHPMailer.php';
        include './static/lib/SMTP.php';
        
        $mail = new PHPMailer();
        
        $mail->isSMTP();
        
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        
        $mail->Host = 'smtp.naver.com';
        
        $mail->Port = 465;
        
        $mail->SMTPSecure = 'ssl';
        
        $mail->SMTPAuth = true;
        
        $mail->Username = 'dldnwn59';
        
        $mail->Password = 'VJ1W9UJ6VJEG';
        
        $mail->CharSet = 'UTF-8';
        
        
        $mail->setFrom('dldnwn59@naver.com', 'RiaBook');
        
        
        $mail->addReplyTo('dldnwn59@naver.com', '이우주');
        
        
        $mail->addAddress($user->email, $user->nickname.' 님');
        
        
        $mail->Subject = $subject;
        
        
        $mail->msgHTML($content);
        
        
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

    }

       //sms인증
    function _subsms($useridx,$content){
        $user = $this->users_model->useridxselect($useridx);

        /****************** 인증정보 시작 ******************/
        $sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
        $sms['user_id'] = "dldnwn59"; // SMS 아이디
        $sms['key'] = "13eeid5cbd6w3ejyq8dpbauyk58nj55s";//인증키
        /****************** 인증정보 끝 ********************/
        
        /****************** 전송정보 설정시작 ****************/
        $_POST['msg'] = $content; // 메세지 내용 : euc-kr로 치환이 가능한 문자열만 사용하실 수 있습니다. (이모지 사용불가능)
        $_POST['receiver'] = $user->phonenumber; // 수신번호
        $_POST['destination'] = '01099135452|이우주'; // 수신인 %고객명% 치환
        $_POST['sender'] ="01099135452"; // 발신번호
        $_POST['rdate'] = ''; // 예약일자 - 20161004 : 2016-10-04일기준
        $_POST['rtime'] = ''; // 예약시간 - 1930 : 오후 7시30분
        $_POST['testmode_yn'] = 'Y'; // Y 인경우 실제문자 전송X , 자동취소(환불) 처리
        $_POST['subject'] = 'RiaBook 문자 입니다.'; //  LMS, MMS 제목 (미입력시 본문중 44Byte 또는 엔터 구분자 첫라인)
        // $_POST['image'] = '/tmp/pic_57f358af08cf7_sms_.jpg'; // MMS 이미지 파일 위치 (저장된 경로)
        $_POST['msg_type'] = 'SMS'; //  SMS, LMS, MMS등 메세지 타입을 지정
        // ※ msg_type 미지정시 글자수/그림유무가 판단되어 자동변환됩니다. 단, 개행문자/특수문자등이 2Byte로 처리되어 SMS 가 LMS로 처리될 가능성이 존재하므로 반드시 msg_type을       지정하여 사용하시기 바랍니다.
        /****************** 전송정보 설정끝 ***************/
        
        $sms['msg'] = stripslashes($_POST['msg']);
        $sms['receiver'] = $_POST['receiver'];
        $sms['destination'] = $_POST['destination'];
        $sms['sender'] = $_POST['sender'];
        $sms['rdate'] = $_POST['rdate'];
        $sms['rtime'] = $_POST['rtime'];
        $sms['testmode_yn'] = empty($_POST['testmode_yn']) ? '' : $_POST['testmode_yn'];
        $sms['title'] = $_POST['subject'];
        $sms['msg_type'] = $_POST['msg_type'];
        
        /*****/
        $host_info = explode("/", $sms_url);
        $port = $host_info[0] == 'https:' ? 443 : 80;
        
        $oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_PORT, $port);
        curl_setopt($oCurl, CURLOPT_URL, $sms_url);
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $ret = curl_exec($oCurl);
        curl_close($oCurl);
        $json = json_decode($ret);
        
        $sendsuccess = 0;
        if($json->result_code == 1){
            $sendsuccess = 1;
        }
            $rs = array("success"=>$sendsuccess);
            return json_encode($rs);
    }


}