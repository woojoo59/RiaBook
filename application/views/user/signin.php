<style>
    .duo{
        height: 100%;
        margin-left: 1vw;
        min-width: 5vw;
    }
    .wvw74{
        width: 34vw;
    }
    .mbv-1{
        display: flex;
        justify-content: space-between;
    }
    .mbv0{
        display: flex;
        justify-content: space-between;
    }
    .row_center{
        display: flex;
        justify-content: center;
    }
    .between{
        display: flex;
        justify-content: space-between;
    }
    .div_signin{
        width: 40vw;
    }
    select,option{
        text-align: center;
        width: 40%;
        font-size: 1vw;
    }
    .vw_3{
        display: flex;
        margin-left: 1vw;
        margin-right: 1vw;
        align-items: flex-end;
    }
    .signin_btn{
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 2vw;
    }
    #signinbtn{
        width: 10vw;
        height: 4vw;`
    }
    #mail{
        border-radius: 4px;
        border: 2px solid  #eef0f2;
    }
    .checkedduo{
        height:2vw;
    }
    .inputintroduce{
        font-size: 10px;
        color: grey;
    }
    #mailid{
        width: 10vw;
    }
    .mailform{
        display: flex;
    }
    #mailurl{
        width: 20vw;
        margin-right: 1vw;
    }
    .mb05{
        margin-bottom: 0.5vw;
    }
</style>
<div class="div_signin">
    <script src="//d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>
    <form id="createuser" method="post" action="<?=base_url()?>users/signin">
        <div id="input_id" class="mbv0">
            <div class="form-floating">
                <input type="text" name="identifier" class="form-control wvw74" id="identifier" placeholder="아이디">
                <label for="identifier">아이디</label>
            </div>
            <div>
            <button type="button" id="idck" class="btn btn-outline-primary duo">중복확인</button>
            </div>
        </div>
        <div class="checkedduo">
            <span id="ckid" class="inputintroduce">아이디는 6~16글자 영문과 숫자만 입력 가능합니다.</span>
        </div>
        <div class="form-floating mbv-1">
            <input type="password" name="password" class="form-control mb05" id="password" placeholder="비밀번호">
            <label for="password">비밀번호</label>
        </div>
        <div class="form-floating mbv-1">
            <input type="password" name="passwordck" class="form-control" id="passwordck" placeholder="비밀번호 확인">
            <label for="passwordck">비밀번호 확인</label>
        </div>
        <div class="checkedduo">
            <span id="checkpassword" class="inputintroduce">비밀번호는 8~16글자, ! or @를 포함해야 하며 영문과 숫자만 입력가능합니다.</span>
        </div>
        <div class="mbv0">
            <div class="form-floating">
                <input type="text" name="nickname" class="form-control wvw74" id="nickname" placeholder="닉네임">
                <label for="nickname">닉네임</label>
            </div>
            <div>
            <button type="button" id="nickck" class="btn btn-outline-primary duo">중복확인</button>
            </div>
        </div>
        <div class="checkedduo">
            <span id="cknick" class="inputintroduce">닉네임은 2~20글자, 한글, 영문, 숫자만 입력 가능 합니다.</span>
        </div>
        <div class="form-floating mbv-1">
            <input type="text" name="username" class="form-control" id="username" placeholder="이름">
            <label for="username">이름</label>
        </div>
        <div class="checkedduo">
            <span id="checkid" class="inputintroduce"></span>
        </div>
        <div class="mbv-1">
            <div class="form-floating">
                <input type="text" name="phonenumber" class="form-control wvw74" id="phonenumber" placeholder="아이디">
                <label for="phonenumber">휴대폰 번호</label>
            </div>
            <div>
            <button type="button" id="smscall" class="btn btn-outline-primary duo">SMS인증</button>
            </div>
        </div>
        <div class="checkedduo">
            <span id="cksms" class="inputintroduce">"-"를 뺀 숫자만 입력해주세요 ex)01012345678</span>
        </div>
        <div class="mbv-1">
            <div class="form-floating">
                <input type="password" class="form-control wvw74" id="phonenumberck" placeholder="아이디" readonly>
                <label for="phonenumber">인증번호</label>
            </div>
            <div>
            <button type="button" id="smsck" class="btn btn-outline-primary duo">확인</button>
            </div>
        </div>
        <div class="checkedduo">
            <span class="inputintroduce"></span>
        </div>
        <div class="form-floating mailform mb05">
            <input type="text" name="mail" class="form-control" id="mailid" placeholder="이름">
            <label for="mailid">이메일</label>
            <div class="vw_3">
            @
            </div>
            <input type="text" class="form-control" name="mailurl" id="mailurl" readonly>
            <select id="mail">
                <option value="naver.com">
                    naver.com
                </option>
                <option value="kakao.com">
                    kakao.com
                </option>
                <option value="daum.net">
                    daum.net
                </option>
                <option value="gmail.com">
                    gmail.com
                </option>
                <option value="">
                    직접입력
                </option>
            </select>
            <div>
            <button type="button" id="mailcall" class="btn btn-outline-primary duo">인증번호 전송</button>
            </div>
        </div>
        <div class="mbv-1">
            <div class="form-floating">
                <input type="password" class="form-control wvw74" id="emailck" placeholder="아이디" readonly>
                <label for="phonenumber">인증번호</label>
            </div>
            <div>
            <button type="button" id="mailck" class="btn btn-outline-primary duo">확인</button>
            </div>
        </div>
        <div class="checkedduo">
            <span class="inputintroduce" id="ckmail"></span>
        </div>
        <input type="hidden" name="h1" id="h1">
        <input type="hidden" name="h2" id="h2">
        <input type="hidden" name="h4" id="h4">
    </form>
    <div id="address">
        <!-- 주소와 우편번호를 입력할 <input>들을 생성하고 적당한 name과 class를 부여한다 -->
        <div id="input_id" class="between">
            <div class="form-floating">
                <input type="text" name="ad1" id="ad1" class="postcodify_postcode5 form-control codify" value="" placeholder="주소번호" readonly>
                <label for="ad1">주소번호</label>
            </div>
            <!-- <div>
                <button type="button" id="postcodify_search_button" class="btn btn-outline-primary duo">주소찾기</button>
            </div> -->
        </div>
        <div class="form-floating between">
            <input type="text" name="ad2" id="ad2" class="postcodify_address form-control" value="" placeholder="주소" readonly>
            <label for="ad2">도로명 주소</label>
        </div>
        <input type="hidden" id="ad3" class="postcodify_extra_info">
        <div class="form-floating between">
            <input type="text" name="ad4" id="ad4" class="postcodify_details form-control" value="" placeholder="주소">
            <label for="ad4">상세 주소</label>
        </div>

        <!-- jQuery와 Postcodify를 로딩한다 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="//d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>

        <!-- "검색" 단추를 누르면 팝업 레이어가 열리도록 설정한다 -->
        <script> $(function() { 
            $("#ad2").postcodifyPopUp();
            $("#ad1").postcodifyPopUp(); });

            let codifyaddress = ''
            $('#ad4').on('focus',()=>{
                
                if(codifyaddress != $('#ad2').val()){
                    $('#ad2').val($('#ad2').val()+' '+$('#ad3').val());
                    codifyaddress = $('#ad2').val();
                }
            })                
         </script>
    </div>
    <div class="signin_btn">
        <button type="button" class="btn btn-outline-primary" id="signinbtn">회원 가입</button>
    </div>
</div>
<script type="text/javascript">
    // 폼
    const createuser    = $('#createuser');

    // 인풋태그
    const identifier    = $('#identifier');
    const password      = $('#password');
    const passwordck    = $('#passwordck');
    const nickname      = $('#nickname');
    const username      = $('#username');
    const phonenumber   = $('#phonenumber');
    const mailid        = $('#mailid');
    const mailurl       = $('#mailurl');
    const mail          = $('#mail');
    const ad1           = $('#ad1');
    const ad2           = $('#ad2');
    const ad3           = $('#ad3');
    const ad4           = $('#ad4');
    const phonenumberck = $('#phonenumberck');
    const emailck       = $('#emailck');
    const h1           = $('#h1');
    const h2           = $('#h2');
    const h4           = $('#h4');

    // 버튼
    const idck          = $('#idck');
    const nickck        = $('#nickck');
    const smsck         = $('#smsck');
    const mailck        = $('#mailck');
    const signinbtn     = $('#signinbtn');
    const mailcall      = $('#mailcall');
    const smscall       = $('#smscall');


    // 스판
    const ckid          = $('#ckid');
    const cknick        = $('#cknick');
    const cksms         = $('#cksms');
    const ckmail        = $('#ckmail');
    const checkpassword = $('#checkpassword');

    //확인
    let checkid = 0;
    let checknickname = 0;
    let checknumber = 0;
    let checkmail = 0;
    let okmail = 100000
    let okphone = 100000
    

    //아이디 중복확인
    idck.on('click',()=>{
        if(identifier.val().length <6 || identifier.val().length >16 ){
            alert('아이디는 6~16글자입니다.');
            identifier.focus();
            return false;
        }
        let idpattern = /[^A-Za-z0-9]/;
        if(idpattern.test(identifier.val())){
            alert('아이디는 영어와 숫자만 입력가능합니다.')
            identifier.focus();
            return false;
        }

        $.post('../users/duplicate',{'identifier':identifier.val()},function(data){
            let obj = JSON.parse(data);
            if(obj.result == 'no'){
                alert('이미 사용중인 아이디입니다.');
                identifier.focus();
            } else if(obj.result == 'ok'){
                ckid.html('사용가능한 아이디입니다.');
                checkid = 1
            }
        })
    })
    identifier.on('change',()=>{
        ckid.html('아이디는 6~16글자 영문과 숫자만 입력 가능합니다.');
        checkid = 0   
    })
    //닉네임 중복확인
    nickck.on('click',()=>{
        if(nickname.val().length <2 || nickname.val().length >20 ){
            alert('닉네임은 2~20글자입니다.')
            nickname.focus();
            return false;
        }
        let namepattern = /[^A-Za-z0-9가-힣]/;
        if(namepattern.test(nickname.val())){
            alert('닉네임은 한글과 영어, 숫자만 입력가능합니다.')
            nickname.focus();
            return false;
        }




        $.post('../users/duplicate',{'nickname':nickname.val()},function(data){
            let obj = JSON.parse(data);
            if(obj.result == 'no'){
                alert('이미 사용중인 닉네임입니다.');
                nickname.focus();
            } else if(obj.result == 'ok'){
                cknick.html('사용가능한 닉네임입니다.');
                checknickname = 1;
            }
        })
    })
    nickname.on('change',()=>{
        cknick.html('닉네임은 2~20글자, 한글, 영문, 숫자만 입력 가능 합니다.');
        checknickname = 0;
    })

    //메일url 선택 및 직접입력
    mailurl.val(mail.val());
    mail.on('change',()=>{
        mailurl.val(mail.val());
        mailurl.attr('readonly',true);
        if(mail.val()==''){
            mailurl.removeAttr('readonly',true);
        }
    })
    //메일 인증번호 발송
    mailcall.on('click',()=>{
        if(mailid.val() == ''){
            alert('이메일을 입력해주세요.');
            return false;
        }
        $.post('../users/mail',{'mailid':mailid.val(),'mailurl':mailurl.val()},function(data){
            let obj = JSON.parse(data);
            okmail = obj.result;
            ckmail.html('메일이 발송되었습니다.');
            emailck.removeAttr('readonly',true);
        })
    })
    //메일 인증번호 확인
    mailck.on('click',()=>{
        $.post('../users/pwdhash',{'number':emailck.val(),'hash':okmail},function(data){
            let obj = JSON.parse(data);
            if(obj.result=='ok'){
                checkmail = 1;
                mailid.attr('readonly',true);
                mailurl.attr('readonly',true);
                emailck.attr('readonly',true);
                mail.attr('disabled',true);
                mailcall.attr('disabled',true);
                mailck.attr('disabled',true);
                ckmail.html('인증 완료되었습니다.');
            }else {
                alert('인증번호가 다릅니다.');
            }
        })

    })

    //sms 인증번호 발송
    smscall.on('click',()=>{
        if(phonenumber.val().length != 11){
            alert('휴대폰 번호는 01012345678 형식으로 입력해주세요.')
            return false;
        }
        let pattern = /[^0-9]/;
        if(pattern.test(phonenumber.val())){
            alert('휴대폰 번호는 01012345678 형식으로 입력해주세요.')
            return false
        }
        $.post('<?=base_url()?>/users/sms',{'phonenumber':phonenumber.val()},function(data){
            let obj = JSON.parse(data);
            okphone = obj.result;
            if(okphone == 'no'){
                alert('이미 등록된 번호입니다.')
                return false;
            }
            cksms.html('문자가 발송되었습니다.');
            phonenumberck.removeAttr('readonly',true)
        })
    })
    //sms 인증번호 확인
    smsck.on('click',()=>{
        $.post('<?=base_url()?>/users/pwdhash',{'number':phonenumberck.val(),'hash':okphone},function(data){
            let obj = JSON.parse(data);
            if(obj.result=='ok'){
                checknumber = 1;
                phonenumber.attr('readonly',true)
                phonenumberck.attr('readonly',true)
                smscall.attr('disabled',true)
                smsck.attr('disabled',true)
                cksms.html('인증 완료되었습니다.');
            }else {
                alert('인증번호가 다릅니다.');
            }
        })
    })
    //회원가입 버튼
    signinbtn.on('click', ()=>{
        if(checkid != 1){
            alert('아이디 중복확인이 필요합니다.');
            return false;
        }
        if(checknickname != 1){
            alert('닉네임 중복확인이 필요합니다.');
            return false;
        }
        if(checkmail != 1){
            alert('이메일 인증이 필요합니다.');
            return false;
        }
        if(checknumber != 1){
            alert('휴대폰 인증이 필요합니다.');
            return false;
        }
        if (password.val().length < 8 || password.val().length > 16) {
            alert('비밀번호는 8~16글자입니다.');
            return false;
        }
        if(username.val() == ''){
            alert('이름을 입력해주세요.');
            return false;
        }
        let patterns = /[^가-힣]/;
        if(patterns.test(username.val())){
            alert('올바른 이름을 입력해주세요.');
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
            alert("비밀번호에 !, @의 특수문자를 최소 1개 입력해주세요.")
            password.focus();
            return false;
        }
        if(password.val()!=passwordck.val()){
            alert("두 비밀번호의 값이 다릅니다. 다시 확인해주세요.")
            return false;
        }
        if(ad1.val() == ''){
            alert('주소를 입력해주세요.');
            return false;
        }
        if(ad4.val()==''){
            alert('상세주소를 입력해주세요.');
            return false;
        }
        let ad4pattern = /[^A-Za-z0-9가-힣\-]/;
        if(ad4pattern.test($('#ad4').val())){
            alert('상세주소는 한글과 영어, 숫자,"-"만 입력가능합니다.');
            return false;
        }
        h1.val(ad1.val());
        h2.val(ad2.val());
        h4.val(ad4.val());
        history.replaceState(null, null, '<?=base_url()?>');
        createuser.submit();
    })
</script>