<style>
    #login_main{
        width: 30vw;
        border: 1px solid  #eef0f2;
        border-radius: 1vw;
    }
    .dfcc{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .logintitle{
        width: 10vw;
        height: 10vw;
        margin-bottom: 4vw;
        margin-top: 4vw;
    }
    .form-floating{
        margin-left: 10%;
        margin-bottom: 1vw;
    }
    .form-control{
        width: 90%;
    }
    .h3font{
        font-style: italic;
        color: grey;
        margin-bottom: 1vw;
    }
    .form-check{
        margin-left: 10%;
    }
    .dfb{
        width: 90%;
        display: flex;
    }
    .mf{
        margin-left: 10%;
        width: 80%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 4vw;
    }
    .check{
        color: blue;
        border-bottom: 1px solid blue;
    }
    .df{
        display: flex;
        margin-left: 1vw;
    }
    .mvw3{
        min-width: 4vw;
        margin-left: 1vw;
        margin-right: 1vw;
    }
    .top:hover{
        cursor: pointer;
    }
    .btnsdiv{
        display:flex;
        justify-content:center;
        align-items:center;
        width: 30vw;
    }
    .btns{
        width: 5vw;
        font-size: 1.3vw;
        margin: 0.5vw;
        border-radius:0.5vw;
        outline: none;
        border:1px solid skyblue;
        background-color: white;
    }
    .btns:hover{
        background-color: skyblue;
    }
</style>
<div id="login_main">
    <div class="dfcc">
        <img src="/static/img/Ria.png" class="logintitle">
    </div>
    <?php if($option == 0){ ?>
        <h3 class="dfcc h3font">삭제를 위해 비밀번호를 확인하겠습니다.</h3>
    <?php } else if($option == 1) { ?>
        <h3 class="dfcc h3font">두 비밀번호가 다릅니다.</h3>
    <?php } else if($option == 2) { ?>
        <h3 class="dfcc h3font">비밀번호가 틀렸습니다.</h3>
    <?php } ?>
    <form action="<?=base_url()?>novel/deletenovellist/<?=$idx?>" method="post" id="loginform">
    <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingidentifier" placeholder="아이디">
        <label for="floatingidentifier">비밀번호</label>
    </div>
    <div class="form-floating">
        <input type="password" name="passwordck" class="form-control" id="floatingPassword" placeholder="비밀번호">
        <label for="floatingPassword">비밀번호 확인</label>
    </div>
    <div class="btnsdiv">
        <button type="button" class="btns" id="backbtn">취소</button>
        <button type="button" class="btns" id="loginbtn">확인</button>
    </div>
    </form>
</div>
<script type="text/javascript">
    
    $('#loginbtn').on('click',()=>{
        history.replaceState(null, null, '<?=base_url()?>mypage');
        $('#loginform').submit();
    })
    $('#backbtn').on('click',()=>{
        history.go(-1);
    })
</script>

