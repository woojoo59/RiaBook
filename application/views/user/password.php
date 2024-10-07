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
    #loginbtn{
        margin-left: 10%;
        width: 80%;
        font-size: 1.5vw;
    }
    .mf{
        margin-left: 10%;
        width: 80%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 4vw;
    }
    #top{
        display: flex;
        height: 5vw;
        align-items: center;
        justify-content: space-between;
    }
    .top{
        width: 15vw;
        text-align: center;
        border-bottom: 1px solid #eef0f2;
        font-size: 1vw;
        padding-bottom: 1vw
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
</style>
<div id="login_main">
    <div class="dfcc">
        <img src="/static/img/Ria.png" class="logintitle">
    </div>
    <h3 class="dfcc h3font">Change Password</h3>
    <form action="<?=base_url()?>users/password" method="post" id="loginform">
    <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingidentifier" placeholder="아이디">
        <label for="floatingidentifier">비밀번호</label>
    </div>
    <div class="form-floating">
        <input type="password" name="passwordck" class="form-control" id="floatingPassword" placeholder="비밀번호">
        <label for="floatingPassword">비밀번호 확인</label>
    </div>
    <input type="hidden" name="phone" value="<?=$phone?>">
    <button type="button" class="btn btn-primary" id="loginbtn">변경</button>
    </form>
</div>
<script type="text/javascript">
    const password = $('#floatingidentifier');
    const passwordck = $('#floatingPassword');
    const form = document.querySelector('#loginform');

    $('#loginbtn').on('click',()=>{
        if (password.val().length < 8 || password.val().length > 16) {
            alert('비밀번호는 8~16글자입니다.');
            return false;
        }
        if(password.val().indexOf('!')!=-1 || password.val().indexOf('@')!=-1){
            let pattern = /[^A-Za-z0-9!@]/;
            if(pattern.test(password.val())){
                alert("비밀번호엔 !, @과 영어, 숫자만 입력 가능합니다.")
                password.focus();
                return false
            }
        } else {
            alert("!, @의 특수문자를 최소 1개 입력해주세요.")
            password.focus();
            return false;
        }
        if(password.val()!=passwordck.val()){
            alert("두 비밀번호의 값이 다릅니다. 다시 확인해주세요.")
            return false;
        }
        history.replaceState(null, null, '<?=base_url()?>home/login');
        form.submit();
    })

    
</script>

