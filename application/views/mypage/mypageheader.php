<style type="text/css">
    .mypage{
        width: 80vw;
    }
    .nav{
        justify-content: space-between;
    }
    .nav-link{
        height: 3vw;
        width: 8vw;
        display: flex;
        justify-content:center;
        align-items: center;
    }

    .maypage>img{
        height: 100%;
    }
    .topr{
        display: flex;
        align-items:center;
    }
    #myinformation{
        width: 9vw;
    }

    table{
        margin-top: 0.5vw;
        width: 80vw;
    }
    .novelfoot{
        height: 100%;
        display: flex;
        align-items:center;
    }
    .topl{
        display: flex;
    }
    .continue{
        display: flex;
        align-items:center;
    }

    #profile{
        width: 10vw;
        height: 10vw;
        margin-right: 2vw;
        padding: 0.5vw;
    }
    .icon{
        width: 30px;
        height: 30px;
    }
    tr{
        border-bottom: 1px solid #eef0f2;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vw;
    }
    .icons{
        display: flex;
    }
    .ml{
        margin-left: 1vw;
    }
    .td2div{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .td1{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .mr{
        margin-right: 0.5vw;
    }
    .df{
        display: flex;
        height: 100%;
    }
    .btndiv{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    td>a{
        color: black;
        height: 100%;
    }
    .tdiv{
        display: flex;
    }
    .td3{
        width: 20vw;
    }
    .novels{
        width: 30vw;
    }
    .td1{
        width: 12vw;
        height: 10vw;
    }
    .td2{
        width: 48vw;
    }
    .td3div{
        width: 20vw;
    }
    .td31{
        width: 9vw;
        margin:0.1vw;
    }
    .td32{
        width: 9vw;
        margin:0.1vw;
    }
    .td33{
        width: 9vw;
        border:1px solid #0dcaf0;
        border-radius: 0.3vw;
        color:#0dcaf0;
        text-align: center;
        outline: #0dcaf0;
        margin:0.1vw;
    }

    .td34{
        width: 9vw;
        margin:0.1vw;
    }
    .td3top{
        display: flex;
    }
    .td3bot{
        display: flex;
    }
    .mymain{
        padding-top: 0.5vw;
        border-left: 1px solid  #eef0f2;
        border-right: 1px solid  #eef0f2;
    }
    .mailicon{
        height: 100%;
    }
    .toprbtn{
        height:100%;
    }
    .pointdiv{
        margin-right:3vw;
        font-size: 1vw;
    }
    .recommenbtndiv{
        margin-top:0.3vw;
        display: flex;
        justify-content:center;
    }
    .recommenbtn{
        width: 12vw;
        height: 2vw;
    }
    .tdbtns{
        color: #0dcaf0;
        border: 1px solid #0dcaf0;
        border-radius:0.3vw;
        padding:0.2vw;
        display: flex;
        align-items:center;
    }
    .tdbtns:hover{
        background-color: #0dcaf0;
        color:white;
    }
</style>
<div class="mypage">
    <div class="top">
        <ul class="nav nav-tabs">
            <div class="topl">
                <li class="nav-item">
                    <a class="nav-link <?php if($option=='mynovel'){echo 'active';} ?>" aria-current="page" href="<?=base_url()?>mypage">내 작품</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($option=='prefer'){echo 'active';} ?>" href="<?=base_url()?>mypage/prefer">선호작</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($option=='continue'){echo 'active';} ?>" href="<?=base_url()?>mypage/continue">이어보기</a>
                </li>
                <li class="nav-item" title="쪽지">
                    <a class="nav-link <?php if($option=='mail'){echo 'active';} ?>" href="<?=base_url()?>mypage/mail">
                        <img class="mailicon" src="../../static/img/free-icon-mail-8699939.png">
                    </a>
                </li>
                <li class="nav-item" title="쪽지">
                    <a class="nav-link" href="<?=base_url()?>novel">새 작품 등록</a>
                </li>
            </div>
            <div class="topr">
                <div class="pointdiv" title="해당 포인트를 사용하여 소설을 추천 리스트에 등록할 수 있습니다.">
                    My Point : <i><?=number_format($mypoint)?></i> Ria
                </div>
                <a href="" title="뷰어 환결 설정" data-bs-toggle="modal" data-bs-target="#Modal"><img src="<?=base_url()?>static/img/icons8-설정-50.png" alt=""></a>
                <button class="toprbtn btn btn-outline-primary" id="myinformation" data-bs-toggle="modal" data-bs-target="#exampleModal">회원 정보</button>
            </div>
        </ul>
    </div>
    
    <div class="mymain">