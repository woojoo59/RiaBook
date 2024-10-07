	<style type="text/css">
		#profile{
			width: 10vw;
			height: 10vw;
			margin-right: 2vw;

		}
		.icon{
			width: 2vw;
			height: 2vw;
		}
		tr{
			border-bottom: 1px solid #eef0f2;
			width: 100%;
			display: flex;
			justify-content: center;
    		align-items: center;
    		height: 10vw;
		}
		.icons{
			display: flex;
		}
		.ml{
			margin-left: 1vw;
		}
		.td2div{
			width: 100%;
			height: 100%;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.td1{
			display: flex;
    		justify-content: center;
    		align-items: center;
		}
		.td3div{
			display: flex;
			flex-direction: column;
			width: 12vw;
		}
		.mr{
			margin-right: 0.5vw;
		}

		.df{
			display: flex;
		}
		.btndiv{
			width: 100%;
			height: 100%;
			display: flex;
			justify-content: center;
    		align-items: center;
		}
		td>a{
			color: black;
			height: 100%;
		}
		.td2{
			width: 100%;
			height: 100%;
		}
			.tag{
			background-color: #eef0f2;
			padding: 0.4vw;
			border-radius: 1vw;
			margin-right: 1vw;
		}
		.continueselect{
			width: 4vw;
			height: 1.5vw;
			text-align: center;
			border-radius:0.5vw;
		}
		.continubtn{
			width: 3.5vw;
			height: 1.7vw;
			background-color:white;
			border: 1px solid #eef0f2;
			border-radius:0.5vw;
		}
		.continubtn:hover{
			background-color:#eef0f2;
		}
		.mrs{
			margin-right: 0.2vw;
		}
	</style>
	<tr>
		<td class="td1">
			<a href="novel/novel?novelidx=<?=$idx?>">
				<img id="profile" src="/static/upload/<?=$img?>">
			</a>
		</td>
		<td class="td2">
			<a href="<?=base_url()?>novel/novel?novelidx=<?=$idx?>">
			<div class="td2div">
				<h2><?= $subject?></h1>
				<p><?=$creator?></p>
				<div class="icons">
					<?php
						foreach ($tag as $tags) {
					?>
						<div class="tag"># <?= $tags ?></div>
					<?php		
						}
					?>
				</div>
				<p>카테고리 : <?=$category?></p>
			</div>
			</a>
		</td>
		<td class="td3">
			<div class="td3div">
				<div class="continue">
					<img class="icon mrs" src="/static/img/novel.png">
					<form method="get" action="<?=base_url()?>novel/viewer">
						<select name="index" id="c<?=$idx?>" class="continueselect">
							<?php
							if($novelindex==0){
								?>
								<option disabled selected>0</option>
								<?php
							}

							for($i=$novelindex; $i>=1; $i--){
							?>
	
								<option value="<?= $index[$i] ?>" <?php if($index[$i]==$lastviewer){echo 'selected';} ?>><?=$i?></option>
							<?php
							}
							?>
							
						</select>
						<input class="continubtn" type="submit" value="이어보기" class="continuesubmit" <?php if($lastviewer == 0){echo 'disabled title="연재된 에피소드가 없습니다."';} ?>>
						<button type="button" id="removelist<?=$idx?>" class="btn-close" aria-label="Close"></button>
					</form>	
				</div>
				<p>업데이트 : <?= $created ?></p>
			</div>
		</td>
	</tr>
<script type="text/javascript">
	$('#removelist<?=$idx?>').on('click',()=>{
		$.post('<?=base_url()?>mypage/removelist/<?=$listoption?>',{'idx':<?=$idx?>},function(data){
			location.reload();
        })
	})
	window.onload = function() {
    if (performance.navigation.type === 2) {
        // 뒤로가기나 앞으로가기로 접근한 경우
        location.reload(true);  // 페이지를 강제로 새로고침
    }
};
</script>