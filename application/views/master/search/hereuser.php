<form id="hereuser" action="<?=base_url()?>master/edituser" method="post">
<div class="rdiv"><div class="rdiv1">이름 : 		</div><div class="rdiv2"><?=$username?></div></div>
<div class="rdiv"><div class="rdiv1">닉네임 : 	</div><div class="rdiv2"><?=$nickname?></div></div>
<div class="rdiv"><div class="rdiv1">아이디 : 	</div><div class="rdiv2"><?=$identifier?></div></div>
<div class="rdiv"><div class="rdiv1">비밀번호 :	</div><div class="rdiv2"><input id="password" type="password" name="password" placeholder="변경시에만 입력"></div></div>
<div class="rdiv"><div class="rdiv1">상태 : 		</div><div class="rdiv2">
	<select name="status" id="">
		<option value="0" <?php if($status == 0){echo 'selected';} ?> >정지</option>
		<option value="1" <?php if($status == 1){echo 'selected';} ?> >활동</option>
		<option value="2" <?php if($status == 2){echo 'selected';} ?> >경고 1회</option>
		<option value="3" <?php if($status == 3){echo 'selected';} ?> >경고 2회</option>
	</select>
</div></div>
<div class="rdiv"><div class="rdiv1">연락처 : 	</div><div class="rdiv2"><?=$phonenumber?></div></div>
<div class="rdiv"><div class="rdiv1">우편번호 : 	</div><div class="rdiv2"><?=$address[0]?></div></div>
<div class="rdiv"><div class="rdiv1">주소 : 		</div><div class="rdiv2"><?=$address[1]?></div></div>
<div class="rdiv"><div class="rdiv1">상세주소 :	</div><div class="rdiv2"><?=$address[2]?></div></div>
<div class="rdiv"><div class="rdiv1">이메일 : 	</div><div class="rdiv2"><?=$email?></div></div>
	<div class="rdiv"><div class="rdiv1"></div><div class="rdiv2">
<div class="form-check">
  <input class="form-check-input" type="radio" name="option" value="0" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    해당 유저에게 메일로 알림
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="option" value="1" id="flexRadioDefault2">
  <label class="form-check-label" for="flexRadioDefault2">
    해당 유저에게 문자로 알림
  </label>
</div>
	</div></div>
<div class="botdiv"><button id="edit" class="repotbtn" data-bs-toggle="modal" data-bs-target="#exampleModal">수정</button></div>
<input type="hidden" name="useridx" value="<?=$useridx?>">
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body alertbody">
        해당 유저의 정보를 정말로 변경하시겠습니까?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
        <button type="button" id="heresubmit" class="btn btn-primary">확인</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('#edit').on('click',()=>{
		event.preventDefault();
	})

	$('#heresubmit').on('click',()=>{
		$('#hereuser').submit();
	})

    $('#flexRadioDefault1').on('click',()=>{
    dnradio()
  })
  $('#flexRadioDefault2').on('click',()=>{
    dnradio()
  })
  $('#flexRadioDefault3').on('click',()=>{
    dnradio()
  })
  function dnradio(){
    if(defaultradio == $('input[type=radio][name=penalty]:checked').val()){
      $('#dnradio').trigger('click');
    }
    defaultradio = $('input[type=radio][name=penalty]:checked').val()
  }
</script>
