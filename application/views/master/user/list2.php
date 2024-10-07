<div id="novel<?=$idx?>" class="rmain df">
	<div class="pdh5vw divi"><img class="profile" src="/static/upload/default.png" alt=""></div>
	<div class='pdh5vw divii'>
		<div class="one"><?=$subject?></div>
		<div>마지막 연재 일시 : <?=$created?></div>
		<div class="two df">
			<div class="category mr1">카테고리 : <?=$categoryn?></div>
			<div class="status mr1">상태 : <?php if($status == 0){echo '공개';}else{echo '비공개';} ?></div>
		</div>
		<div class="three df">
			<div class="ep mr1">총 <?=$epicnt?> 회차</div>
			<div class="hit mr1">총 <?=$hit?> 조회</div>
			<div class="recommend mr1">총 <?=$recommendscnt?> 추천</div>
			<div class="prefer mr1">총 <?=$prefercnt?> 선작</div>
		</div>
		<div class="four df"><div class="tag"><?=$tag?></div>
		</div>
		<div class="five"><?=$introduce?></div>
	</div>
</div>
<script type="text/javascript">
	$('#novel<?=$idx?>').on('click',()=>{
		senddata(<?=$idx?>)
	})
</script>