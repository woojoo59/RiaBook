<form action="<?=base_url()?>master/editnovellist" method="post">
<div class="center">
	<img class="profileimg" src="/static/upload/<?=$img?>" alt="">
</div>
<div class="rdiv">
	<div class="rdiv1">제목 : </div><div class="rdiv2"><?=$subject?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">작가 : </div><div class="rdiv2"><?=$nick?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">상태 : </div><div class="rdiv2">
		<select name="status" id="">
			<option value="0" <?php if($status == 0){echo 'selected';} ?> >공개</option>
			<option value="1" <?php if($status == 1){echo 'selected';} ?> >비공개</option>
		</select>
	</div>
</div>
<div class="rdiv">
	<div class="rdiv1">연재일 : </div><div class="rdiv2"><?=$created?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">카테고리 : </div><div class="rdiv2"><?=$category?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">태그 : </div><div class="rdiv2"><?=$tag?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">선작 수 : </div><div class="rdiv2"><?=$prefercnt?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">추천 수 : </div><div class="rdiv2"><?=$recommendscnt?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">조회 수 : </div><div class="rdiv2"><?=$hit[0]?></div>
</div>
<div class="rdiv">
	<div class="rdiv1">총 에피소드 수 : </div><div class="rdiv-1"><?=$episode?></div><div class="rdiv-1">
		<select id="moveepisode">
			<option disabled selected>바로 보기</option>
			<?php $i=$episode;foreach($episodes as $e){ ?>
				<option value="<?=$e['novelidx']?>">Ep. <?=$i?> / idx. <?=$e['novelidx']?></option>
			<?php $i--;} ?>
		</select>
	</div>
</div>
<div class="rdiv">
	<div class="rdiv1">소개 : </div><div class="rdiv2"><?=$introduce?></div>
</div>
<div class="rdiv"><div class="rdiv1"></div><div class="rdiv2">
<div class="form-check">
  <input class="form-check-input" type="radio" name="penalty" value="2" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    해당 유저 경고 쪽지
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="penalty" value="0" id="flexRadioDefault2">
  <label class="form-check-label" for="flexRadioDefault2">
    해당 유저 경고 +1
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="penalty" value="1" id="flexRadioDefault3">
  <label class="form-check-label" for="flexRadioDefault3">
    해당 유저 정지
  </label>
</div>
<input type="radio" name="penalty" class="dn" id="dnradio" checked>
	</div></div>
<div class="botdiv"><button id="edit" class="repotbtn">수정</button></div>
<input type="hidden" name="idx" value="<?=$idx?>">
</form>
<script type="text/javascript">
		$('#moveepisode').on('change',()=>{
		$('#search').val($('#moveepisode').val());
		$('#category').val(2);
		$('#searchbtn').trigger('click');
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