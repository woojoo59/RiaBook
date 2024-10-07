
	<tr>
		<td class="td1">
			<a href="<?=base_url()?>novel/novel?novelidx=<?=$idx?>">
				<img id="profile" src="/static/upload/<?=$img?>">
			</a>
		</td>
		<td class="td2">
			<a href="<?=base_url()?>novel/novel?novelidx=<?=$idx?>">
			<div class="td2div">
				<h2><?= $subject?></h1>
				<p style="overflow: hidden; height: 2.5vw;"><?= $introduce?></p>
				<div class="icons">
					<div>
						<img class="icon " src="/static/img/hit.png"> : <?= ($hit=='')?0:$hit ?>
					</div>
					<div>
						<img class="icon ml" src="/static/img/novel.png"> : <?= $save ?>
					</div>
					<div>
						<img class="icon ml" src="/static/img/commend.png"> : <?= $recommendscnt ?>
					</div>
				</div>
				<p>업데이트 : <?= $created ?></p>
			</div>
			</a>
		</td>
		<?php $server = $_SERVER[ "PHP_SELF" ]; 
		if(substr($server,-6,6)=='mypage'){
		?>
		<td class="td3">
			<div class="td3div">
				<div class="td3top">
					<a class="td31 df tdbtns" href="<?=base_url()?>novel/novelwrite?index=<?= $idx ?>">
						<img class="icon mr" src="/static/img/read.png"><div class="btndiv">연재</div>
					</a>
					<a class="td32 df tdbtns" href="<?=base_url()?>mypage/mynovel?index=<?= $idx ?>">
						<img class="icon mr" src="<?=base_url()?>static/img/icons8-설정-50.png" alt="">
						<div class="btndiv">소설 관리</div>
					</a>
				</div>
				<div class="td3bot">
					<select class="td33 movenovel">
						<option disabled selected>회차 수정</option>
						<?php
						foreach($notices as $notice){
						?>
						<option value="<?=$notice->noticeidx?>0">공지/<?=$notice->title?></option>
						<?php	
						}
						$i=$save; 
						foreach ($novels as $novel) {
						?>
						<option value="<?=$novel->novelidx?>1"><?=$novel->status?>/Ep.<?=$i?></option>
						<?php
						if($novel->status=='공개'){$i--;}	
						} ?>
					</select>
					<a class="td34 tdbtns df" href="<?=base_url()?>novel/deletecheck/<?=$idx?>">
						<img class="icon mr" src="<?=base_url()?>static/img/delete.png" alt="">
						<div class="btndiv">소설 삭제</div>
					</a>
				</div>
				<?php if($status=='공개'){ ?>
					<div class="recommenbtndiv">
						<a class="td32 tdbtns recommenbtn" href="<?=base_url()?>mypage/recommendmynovel/<?= $idx ?>">
							<div class="btndiv">★ 추천 리스트 등록 ★</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</td>
	<?php } ?>
	</tr>
