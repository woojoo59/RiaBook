<style type="text/css">
	.form-select{
		width: 30vw;
	}
	.mailtop{
		display:flex;
		justify-content: space-between;
	}
	.mailtable{
		margin-top:0;
		margin-bottom: 0.5vw;
	}
	.mailtr{
		height: 3vw;
		margin: 0;
		padding: 0;
		border:none;
	}
	.mailuser{
		width: 10vw;
		display:flex;
		justify-content:center;
		height: 3vw;
		align-items: center;
	}
	.mailsubject{
		width: 40vw;
		display:flex;
		padding-left: 1vw;
		justify-content:flex-start;
		height: 3vw;
		align-items: center;
	}
	.maildate{
		width: 10vw;
		display:flex;
		justify-content:center;
		height: 3vw;
		align-items: center;
	}
	.mailstatus{
		width: 5vw;
		display:flex;
		justify-content:center;
		height: 3vw;
		align-items: center;
		padding:0.4vw;
	}
	.mailexit{
		width: 5vw;
		display:flex;
		justify-content:center;
		height: 3vw;
		align-items: center;
	}
	.rbord{
		border-right: 1px solid #eef0f2;
	}
	td{
		border-bottom:1px solid #eef0f2;
	}
	.tdhead{
		background-color: #F5FFFA;
	}
	.mailtop2{
		margin-top:0.2vw;
		margin-bottom:0.2vw;
		margin-left: 6vw;
	}
	.mailpage{
		display: flex;
		justify-content:center;
	}
</style>
<div class="mailtop">
	<select id="mailoption" class="form-select" aria-label="Default select example">
		<option value="0" <?php if($option==0){echo 'selected';} ?> >받은 쪽지함</option>
		<option value="1" <?php if($option==1){echo 'selected';} ?> >받은 쪽지함 - 안 읽음</option>
		<option value="2" <?php if($option==2){echo 'selected';} ?> >받은 쪽지함 - 읽음</option>
		<option value="3" <?php if($option==3){echo 'selected';} ?> >보낸 쪽지함</option>
	</select>
	<button id="mailwrite" class="btn btn-outline-info mailbtn">쪽지 작성</button>
</div>
<div class="mailtop2">
	총 <?=$maxcnt?>개
</div>
<div>
	<table class="mailtable">
		<tr class='mailtr'>
			<td class="tdhead mailstatus rbord">상태</td>
			<td class="tdhead mailsubject rbord">제목</td>
			<td class="tdhead maildate rbord">날짜</td>
			<td class="tdhead mailuser"><?php if($option==3){echo 'to';} else{echo 'from';} ?></td>
			<td class="tdhead mailexit"></td>
		</tr>
		<?php if($maxcnt==0){ ?>
		<tr class='mailtr'>
			<td class="mailstatus"></td>
			<td class="mailsubject">메일이 없습니다.</td>
			<td class="maildate"></td>
			<td class="mailuser"></td>
			<td class="mailexit"></td>
		</tr>
		<?php } ?>
