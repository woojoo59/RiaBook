<style type="text/css">
	.imgdiv{
		padding: 1vw;
		display:flex;
		justify-content:center;
		align-items: center;
	}
	.profileimg{
		width: 10vw;
		height: 12vw;
		border-radius: 0.3vw;
	}
	.rdiv{
		display: flex;
		padding: 0.5vw;
	}
	.w5{
		width: 5vw;
	}
	.w7{
		width: 8vw;
	}
	.rdiv1{
		width: 8vw;
		display:flex;
		justify-content: flex-end;
		padding-right: 0.5vw;
	}
</style>
	<div class="imgdiv"><img class="profileimg" src="/static/upload/<?=$imgname?>" alt=""></div>
	<div class="rdiv"><div class="rdiv1">제목 : </div><div class="rdiv2"><?=$subject?></div></div>
	<div class="rdiv"><div class="rdiv1">작가 : </div><div class="rdiv2"><?=$creatorn?></div></div>
	<div class="rdiv"><div class="rdiv1">마지막 연재 일 : </div><div class="rdiv2"><?=$created?></div></div>
	<div class="rdiv"><div class="rdiv1">카테고리 : </div><div class="rdiv2"><?=$categoryn?></div></div>
	<div class="rdiv"><div class="rdiv1">상태 : </div><div class="rdiv2"><?php if($status==0){echo '공개';}else{echo '비공개';} ?></div></div>
	<div class="rdiv"><div class="rdiv1">태그 : </div><div class="rdiv2"><?=$tag?></div></div>
	<div class="rdiv"><div class="rdiv1">소개 : </div><div class="rdiv2"><?=$introduce?></div></div>
	<div class="rdiv"></div>
		<div class="rdiv">
		<div class="w7">총 에피소드 수 : </div>
		<div class="w5"><?=$cnt?></div>
		<div class="w5">총 추천 수 : </div>
		<div class="w5"><?=$recommendscnt?></div>
		<div class="w5">총 선작 수 : </div>
		<div class="w5"><?=$prefercnt?></div>
		<div class="w5">총 조회 수 : </div>
		<div class="w5"><?=$hit?></div>
	</div>