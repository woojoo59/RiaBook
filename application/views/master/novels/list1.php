<div id="list<?=$idx?>" class='tableline bb'>
	<div class="td1"><?=$creatorn?></div>
	<div class="td2"><?=$subject?></div>
	<div class="td5"><?=$cnt?></div>
	<div class="td3"><?=$categoryn?></div>
	<div id="td<?=$idx?>" class="td4"><?=$statusn?></div>
</div>
<div id="content<?=$idx?>" class="tablecontent dn">
	<div class="tablecontenttop"><button type="button" id="listclose" class="btn-close listclose"></button></div>
	<div class="imgdiv"><img class="profileimg" src="/static/upload/<?=$imgname?>" alt=""></div>
	<div class="rdiv"><div class="rdiv1">제목 : </div><div class="rdiv2"><?=$subject?></div></div>
	<div class="rdiv"><div class="rdiv1">작가 : </div><div class="rdiv2"><?=$creatorn?></div></div>
	<div class="rdiv"><div class="rdiv1">마지막 연재 일 : </div><div class="rdiv2"><?=$created?></div></div>
	<div class="rdiv"></div>
	<div class="rdiv">
		<div class="w7h5">총 에피소드 수 : </div>
		<div class="w5"><?=$cnt?></div>
		<div class="w5">총 추천 수 : </div>
		<div class="w5"><?=$recommendscnt?></div>
		<div class="w5">총 선작 수 : </div>
		<div class="w5"><?=$prefercnt?></div>
		<div class="w5">총 조회 수 : </div>
		<div class="w5"><?=$hit?></div>
	</div>
	<div class="rdiv"></div>
	<div class="rdiv"><div class="rdiv1">카테고리 : </div><div class="rdiv2"><?=$categoryn?></div></div>
	<div class="rdiv"><div class="rdiv1">상태 : </div><div class="rdiv2">
		<select class="statusc" id="status<?=$idx?>">
			<option value="0" <?php if($status==0)echo 'selected'; ?>>공개</option>
			<option value="1" <?php if($status==1)echo 'selected'; ?>>비공개</option>
		</select>
	</div></div>
	<div class="rdiv"><div class="rdiv1">태그 : </div><div class="rdiv2"><?=$tag?></div></div>
	<div class="rdiv"><div class="rdiv1">소개 : </div><div class="rdiv2"><?=$introduce?></div></div>
</div>
<script type="text/javascript">
	$('.listclose').on('click',()=>{
		if(flag == 0){
			$('.tableline').attr('class','tableline bb');
			$('.tablecontent').attr('class', 'tablecontent dn');
		}
	})
	$('#list<?=$idx?>').on('click',()=>{
		if(flag == 0){
			$('.tableline').attr('class','tableline bb');
			$('.tablecontent').attr('class', 'tablecontent dn');
			$('#list<?=$idx?>').attr('class', 'tableline dn');
			$('#content<?=$idx?>').attr('class','tablecontent bb');
			$('.midr').load('<?=base_url()?>master/novelslist/0',{'idx':<?=$idx?>});
		}
	})
	$('#status<?=$idx?>').on('change',()=>{
		if(flag == 0){
			$.post('<?=base_url()?>master/novellistc',{'status': $('#status<?=$idx?>').val() ,'idx': '<?=$idx?>' })
			flag = 1;
			$('#saymain').html('해당 소설의 상태가 변경되었습니다.');
			dn10()
			$('#status<?=$idx?>').attr('disabled',true);
			if($('#status<?=$idx?>').val() == 0){
				$('#td<?=$idx?>').html('공개');
			} else {
				$('#td<?=$idx?>').html('비공개');
			}	
		}
	})
</script>
