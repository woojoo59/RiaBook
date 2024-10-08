<div id="list<?=$useridx?>" class="tline bb">
	<div id="listid<?=$useridx?>" class="tds"><?=$identifier?></div>
	<div id="listnick<?=$useridx?>" class="tds"><?=$nickname?></div>
	<div id="listname<?=$useridx?>" class="tds"><?=$username?></div>
	<div id="userstatus<?=$useridx?>" class="tds"><?=$statusn?></div>
</div>
<div id="listcontent<?=$useridx?>" class="listcontent dn">
	<div class="listcontenthead"><button type="button" class="btn-close xcontent" aria-label="Close"></button></div>
	<div class="rdiv"><div class="rdiv1 comma">회원정보</div><div class="rdiv2"></div></div>
	<div class="rdiv"><div class="rdiv1">상태 : </div><div class="rdiv-2">
		<select id="status<?=$useridx?>">
			<option value="0" <?php if($status==0){echo 'selected';} ?>>정지</option>
			<option value="1" <?php if($status==1){echo 'selected';} ?>>활동</option>
			<option value="2" <?php if($status==2){echo 'selected';} ?>>경고 1회</option>
			<option value="3" <?php if($status==3){echo 'selected';} ?>>경고 2회</option>
		</select>
	</div><div class="rdiv-3"><button id="statusbtn<?=$useridx?>" class="userbtn">확인</button></div></div>
	<div class="rdiv"><div class="rdiv1">포인트 : </div><div class="rdiv-2">
		<input id="point<?=$useridx?>" type="number" value="<?=$mypoint?>">
	</div><div class="rdiv-3"><button id="pointbtn<?=$useridx?>" class="userbtn">확인</button></div></div>
	<div class="rdiv"><div class="rdiv1">아이디 : </div><div class="rdiv-2">
		<input id="identifier<?=$useridx?>" type="text" value="<?=$identifier?>">
	</div><div class="rdiv-3"><button id="identifierbtn<?=$useridx?>" class="userbtn">확인</button></div></div>
	<div class="rdiv"><div class="rdiv1">패스워드 : </div><div class="rdiv-2">
		<input id="password<?=$useridx?>" type="text">
	</div><div class="rdiv-3"><button id="passwordbtn<?=$useridx?>" class="userbtn">확인</button></div></div>
	<div class="rdiv"><div class="rdiv1">닉네임 : </div><div class="rdiv-2">
		<input id="nick<?=$useridx?>" type="text" value='<?=$nickname?>' >
	</div><div class="rdiv-3"><button id="nickbtn<?=$useridx?>" class="userbtn">확인</button></div></div>
	<div class="rdiv"><div class="rdiv1">연락처 : </div><div class="rdiv2"><?=$phonenumber?></div></div>
	<div class="rdiv"><div class="rdiv1">이름 : </div><div class="rdiv-2">
		<input id="username<?=$useridx?>" type="text" value="<?=$username?>">
	</div><div class="rdiv-3"><button id="usernamebtn<?=$useridx?>" class="userbtn">확인</button></div></div>
	<div class="rdiv"><div class="rdiv1">이메일 : </div><div class="rdiv2"><?=$email?></div></div>
	<div class="rdiv"><div class="rdiv1">가입일 : </div><div class="rdiv2"><?=$created?></div></div>
	<div class="rdiv"><div class="rdiv1"></div><div class="rdiv2"></div></div>
	<div class="rdiv"><div class="rdiv1"></div><div class="rdiv2"></div></div>
	<div class="rdiv"><div class="rdiv1 comma">세팅</div><div class="rdiv2"></div></div>
	<div class="rdiv"><div class="rdiv1">폰트 사이즈 : </div><div class="rdiv2"><?=$setting[0]?></div></div>
	<div class="rdiv"><div class="rdiv1">줄 여백 : </div><div class="rdiv2"><?=$setting[1]?></div></div>
	<div class="rdiv"><div class="rdiv1">폰트 컬러 : </div><div class="rdiv2"><?=$setting[2]?></div></div>
	<div class="rdiv"><div class="rdiv1">배경 컬러 : </div><div class="rdiv2"><?=$setting[3]?></div></div>
	<div class="rdiv"><div class="rdiv1"></div><div class="rdiv2"></div></div>
	<div class="rdiv"><div class="rdiv1"></div><div class="rdiv2"></div></div>
	<div class="rdiv"><div class="rdiv1 comma">주소</div><div class="rdiv2"></div></div>
	<div class="rdiv"><div class="rdiv1">우편 번호 : </div><div class="rdiv2"><?=$address[0]?></div></div>
	<div class="rdiv"><div class="rdiv1">주소 : </div><div class="rdiv2"><?=$address[1]?></div></div>
	<div class="rdiv"><div class="rdiv1">상세주소 : </div><div class="rdiv2"><?=$address[2]?></div></div>
</div>
<script type="text/javascript">
	$('#list<?=$useridx?>').on('click',()=>{
		$('.tline').attr('class','tline bb');
		$('.listcontent').attr('class','listcontent dn');
		$('#list<?=$useridx?>').attr('class', 'tline dn');
		$('#listcontent<?=$useridx?>').attr('class', 'listcontent bb');
		$('.midr').css('height',$('midl').css('height'))
		$('.midr').height($('.midl').height());
		$('.midr').load('<?=base_url()?>master/usersnovellist',{'useridx':<?=$useridx?>});
	})
	$('#statusbtn<?=$useridx?>').on('click',()=>{
		if(flag == 0){
			$.post('<?=base_url()?>master/statusc',{'status': $('#status<?=$useridx?>').val() ,'useridx': '<?=$useridx?>' })
			flag = 1;
			$('#saymain').html('해당 유저의 상태가 변경되었습니다.');
			let cos = '정지';
			switch ($('#status<?=$useridx?>').val()) {
				case '1':
					cos = '활동';
					break;
				case '2':
					cos = '경고 1회';
					break;
				case '3':
					cos = '경고 2회';
					break;
				default:
					cos = '정지';
					break;
			}
			$('#userstatus<?=$useridx?>').html(cos)
			dn10()
		}    
	})
	$('#identifierbtn<?=$useridx?>').on('click',()=>{
		if(flag == 0){
			$.post('<?=base_url()?>users/duplicate',{'identifier':$('#identifier<?=$useridx?>').val()},function(data){
            	let obj = JSON.parse(data);
            	if(obj.result == 'no'){
            	    flag = 1;
					$('#saymain').html('중복된 아이디입니다.');
					dn10();
            	} else if(obj.result == 'ok'){
            	    $.post('<?=base_url()?>master/identifierc',{'identifier': $('#identifier<?=$useridx?>').val() ,'useridx': '<?=$useridx?>' })
					flag = 1;
					$('#saymain').html('해당 유저의 아이디가 변경되었습니다.');
					$('#listid<?=$useridx?>').html($('#identifier<?=$useridx?>').val());
					dn10();
            	}
        	})
		}
	})
	$('#passwordbtn<?=$useridx?>').on('click',()=>{
		if(flag == 0){
			$.post('<?=base_url()?>master/passwordc',{'password': $('#password<?=$useridx?>').val() ,'useridx': '<?=$useridx?>' })    
			flag = 1;
			$('#saymain').html('해당 유저의 비밀번호가 변경되었습니다.')
			dn10()
		}
	})
	$('#usernamebtn<?=$useridx?>').on('click',()=>{
		if(flag == 0){
			$.post('<?=base_url()?>master/usernamec',{'username': $('#username<?=$useridx?>').val() ,'useridx': '<?=$useridx?>' })
			flag = 1;
			$('#saymain').html('해당 유저의 이름이 변경되었습니다.');
			$('#listname<?=$useridx?>').html($('#username<?=$useridx?>').val());
			dn10();
		}
	})
	$('#pointbtn<?=$useridx?>').on('click',()=>{
		if(flag==0){
			$.post('<?=base_url()?>master/userpoint',{'mypoint' : $('#point<?=$useridx?>').val(), 'useridx' : '<?=$useridx?>'})
			flag = 1;
			$('#saymain').html('해당 유저의 포인트가 변경되었습니다.')
			dn10()
		}
	})
	$('#nickbtn<?=$useridx?>').on('click',()=>{
		if(flag==0){
			$.post('<?=base_url()?>master/nick',{'nick':$('#nick<?=$useridx?>').val(), 'useridx' : '<?=$useridx?>'},function(data){
            	let obj = JSON.parse(data);
            	flag = 1;
            	if(obj.result == 0){
            		$('#saymain').html('중복된 닉네임입니다.');
            	}else {
            		$('#saymain').html('해당 유저의 닉네임이 변경되었습니다.');
            		$('#listnick<?=$useridx?>').html($('#nick<?=$useridx?>').val());
            	}
            	dn10();
        	})
		}
	})
</script>